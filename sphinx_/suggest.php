<?php

define ( "FREQ_THRESHOLD", 1 );
define ( "SUGGEST_DEBUG", 0 );
define ( "LENGTH_THRESHOLD", 2 );
define ( "LEVENSHTEIN_THRESHOLD", 2 );
define ( "TOP_COUNT", 10 );

/// build a list of trigrams for a given keywords
function BuildTrigrams ( $keyword )
{
	$t = "__" . $keyword . "__";

	$trigrams = "";
	for ( $i=0; $i<mb_strlen($t, 'UTF-8')-2; $i++ )
		$trigrams .= mb_substr ( $t, $i, 3, 'UTF-8' ) . " ";

	return $trigrams;
}


/// create SQL dump of the dictionary from Sphinx stopwords file
/// expects open files as parameters
function BuildDictionarySQL ( $out, $in )
{
	fwrite ( $out, "DROP TABLE IF EXISTS suggest;

SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
SET time_zone = \"+00:00\";

CREATE TABLE `suggest` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `trigrams` varchar(255) NOT NULL,
  `freq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `suggest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keyword` (`keyword`);

ALTER TABLE `suggest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

" );

	$n = 0;
	$m = 0;
	while ( $line = fgets ( $in, 1024 ) )
	{
		list ( $keyword, $freq ) = explode ( " ", trim ( $line ) );

		if ( $freq<FREQ_THRESHOLD || mb_strstr ( $keyword, "_", 'UTF-8' )!==false || mb_strstr ( $keyword, "'", 'UTF-8' )!==false )
			continue;

		if (3 > mb_strlen($keyword, 'UTF-8')) {
			continue;
		}

		$trigrams = BuildTrigrams ( $keyword );

		if ( !$m )
			print "INSERT INTO suggest VALUES\n";
		else
			print ",\n";

		$n++;
		fwrite ( $out, "( $n, '$keyword', '$trigrams', $freq )" );

		$m++;
		if ( ( $m % 10000 )==0 )
		{
			print ";\n";
			$m = 0;
		}
	}

	if ( $m )
		fwrite ( $out, ";" );
}


/// search for suggestions
function MakeSuggestion ( $keyword )
{
	$trigrams = BuildTrigrams ( $keyword );
	$query = "\"$trigrams\"/1";
	$len = strlen($keyword);

	$delta = LENGTH_THRESHOLD;
	$cl = new SphinxClient ();
	$cl->SetMatchMode ( SPH_MATCH_EXTENDED2 );
	$cl->SetRankingMode ( SPH_RANK_WORDCOUNT );
	$cl->SetFilterRange ( "len", $len-$delta, $len+$delta );
	$cl->SetSelect ( "*, @weight+$delta-abs(len-$len) AS myrank" );
	$cl->SetSortMode ( SPH_SORT_EXTENDED, "myrank DESC, freq DESC" );
  	$cl->SetArrayResult ( true );

  	// pull top-N best trigram matches and run them through Levenshtein
	$res = $cl->Query ( $query, "suggest", 0, TOP_COUNT );

	if ( !$res || !$res["matches"] )
		return false;

	if ( SUGGEST_DEBUG )
	{
		print "--- DEBUG START ---\n";

		foreach ( $res["matches"] as $match )
		{
			$w = $match["keyword"];
			$myrank = @$match["attrs"]["myrank"];
			if ( $myrank )
				$myrank = ", myrank=$myrank";
			$levdist = levenshtein ( $keyword, $w );

			print "id=$match[id], weight=$match[weight], freq={$match[attrs][freq]}{$myrank}, word=$w, levdist=$levdist\n";
		}

		print "--- DEBUG END ---\n";
	}

	// further restrict trigram matches with a sane Levenshtein distance limit
	foreach ( $res["matches"] as $match )
	{
		$suggested = $match["attrs"]["keyword"];
		if ( levenshtein ( $keyword, $suggested )<=LEVENSHTEIN_THRESHOLD )
			return $suggested;
	}
	return $keyword;
}

/// main
if ( $_SERVER["argc"]<2 )
{
	die ( "usage:\n"
		. "php suggest.php --builddict\treads stopwords from stdin, prints SQL dump of the dictionary to stdout\n"
		. "php suggest.php --query WORD\tqueries Sphinx, prints suggestion\n" );
}

if ( $_SERVER["argv"][1]=="--builddict" )
{
	$in = fopen ( "php://stdin", "r" );
	$out = fopen ( "php://stdout", "w+" );
	BuildDictionarySQL ( $out, $in );
}

if ( $_SERVER["argv"][1]=="--query" )
{
	mysql_connect ( "localhost", "root", "" ) or die ( "mysql_connect() failed: ".mysql_error() );
	mysql_select_db ( "test" ) or die ( "mysql_select_db() failed: ".mysql_error() );

	$keyword = $_SERVER["argv"][2];
	printf ( "keyword: %s\nsuggestion: %s\n", $keyword, MakeSuggestion($keyword) );
}
