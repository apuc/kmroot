<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 25.10.2017
 * Time: 12:20
 */

namespace Kinomania\System\Data;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Db\Db;
use Kinomania\System\Debug\Debug;


class Afisha {
	
	use TRepository;
	use TDate;
	
	public function saveFilmsDB( $films ) {
		$values = [];
		foreach ( $films as $object ) {
			if ( $this->selectFilm( $object->ObjectID ) ) {
				return false;
			} else {
				$object->Frames   = $object->Frames ?: 'NULL';
				$object->Trailers = $object->Trailers ?: 'NULL';
				$values[]         = "('" . addslashes( $object->OriginalName ) . "', '{$object->Genre}',
		                   '{$object->Country}', '{$object->ViewCountDaily}',
		                   '{$object->AgeRestriction}', '{$object->Thumbnail}',
		                   '" . addslashes( $object->Cast ) . "', '" . addslashes( $object->Description ) . "',
		                   '" . addslashes( $object->Director ) . "', '{$object->CreatorName}',
		                   '{$object->CreatorObjectID}', '{$object->Year}',
		                   '{$object->Duration}', '{$object->HorizonalThumbnail}',
		                   '{$object->IsNonStop}',
		                   '{$object->Rating}', {$object->Trailers},
		                   {$object->Frames}, '{$object->ReleaseDate}',
		                   '{$object->ObjectID}', '{$object->ClassType}',
		                   '{$object->Name}')";
				$this->insertDB( $values );
				$values = [];
			}
		}
	}
	
	public function insertDB( $values ) {
		
		$ar = new Db();
		$keys = '`OriginalName`, `Genre`, `Country`,
			`ViewCountDaily`, `AgeRestriction` ,
			`Thumbnail`, `Cast`, `Description`,
			`Director`, `CreatorName`,
			`CreatorObjectID`, `Year`,
			`Duration`, `HorizonalThumbnail`,
			`IsNonStop`,
			`Rating`, `Trailers`,
			`Frames`, `ReleaseDate`,
			`ObjectID`, `ClassType`,
			`Name`';
		$values = implode( ',',$values );
		$ar->insert_v( $keys, 'afisha', $values );
		
		/*$query = " INSERT INTO `afisha` (`OriginalName`, `Genre`, `Country`,
 										`ViewCountDaily`, `AgeRestriction`,
 										`Thumbnail`, `Cast`, `Description`,
		                   				`Director`, `CreatorName`,
		                   				`CreatorObjectID`, `Year`,
		                   				`Duration`, `HorizonalThumbnail`,
		                   				`IsNonStop`,
		                   				`Rating`, `Trailers`,
		                   				`Frames`, `ReleaseDate`,
		                   				`ObjectID`, `ClassType`,
		                   				`Name`) VALUES " . implode( ',',$values );
		$this->mysql()->query( $query );*/
	}
	
	public function selectFilm( $id ) {
		$ar = new Db();
		if ( $id ) {
			$row = $ar->
						find('`afisha`', '*')->
						where(['`ObjectID`' => $id])->
						one();
			return $row;
		}
		return false;
//			$query  = ( "  SELECT * FROM `afisha` WHERE `ObjectID` = '$id'" );
//			$result = $this->mysql()->query( $query );
//			while( $row = $result->fetch_assoc() ) {
//				return $row;
//			}
	}
}