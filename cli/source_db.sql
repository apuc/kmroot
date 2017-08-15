SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `groupId` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('new','active','banned') NOT NULL,
  `hash` binary(64) NOT NULL,
  `hashChange` datetime NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `admin_access`
--

CREATE TABLE `admin_access` (
  `id` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `groupId` int(10) UNSIGNED NOT NULL,
  `route` varchar(255) NOT NULL,
  `method` enum('*','AJAX','GET','POST','OPTIONS','HEAD','PUT','DELETE','TRACE','CONNECT') NOT NULL,
  `access` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `admin_group`
--

CREATE TABLE `admin_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `userCount` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `admin_token`
--

CREATE TABLE `admin_token` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` binary(64) NOT NULL,
  `use` tinyint(3) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `groupId` int(10) UNSIGNED NOT NULL,
  `data` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `awards`
--

CREATE TABLE `awards` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `code` varchar(8) NOT NULL,
  `name_ru` varchar(64) NOT NULL,
  `name_en` varchar(40) NOT NULL,
  `type` enum('award','festival','hidden') NOT NULL,
  `description` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `awards_nomination`
--

CREATE TABLE `awards_nomination` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ru` varchar(200) NOT NULL,
  `name_en` varchar(200) NOT NULL,
  `awardId` tinyint(3) UNSIGNED NOT NULL,
  `type` enum('person_film','film') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `awards_set`
--

CREATE TABLE `awards_set` (
  `id` int(10) UNSIGNED NOT NULL,
  `awardId` tinyint(3) UNSIGNED NOT NULL,
  `year` year(4) NOT NULL,
  `nominationId` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `win` enum('false','true') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `awards_year`
--

CREATE TABLE `awards_year` (
  `id` int(10) UNSIGNED NOT NULL,
  `awardId` int(10) UNSIGNED NOT NULL,
  `year` year(4) NOT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent` int(10) UNSIGNED NOT NULL,
  `status` enum('hide','show') NOT NULL,
  `relatedId` int(10) UNSIGNED NOT NULL,
  `type` enum('news','film','person','trailer') NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `comment_stat`
--

CREATE TABLE `comment_stat` (
  `id` int(10) UNSIGNED NOT NULL,
  `commentId` int(10) UNSIGNED NOT NULL,
  `like` smallint(5) UNSIGNED NOT NULL,
  `dislike` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `comment_vote`
--

CREATE TABLE `comment_vote` (
  `id` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `commentId` int(10) UNSIGNED NOT NULL,
  `vote` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--

CREATE TABLE `company` (
  `id` int(10) UNSIGNED NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `status` enum('hide','show') NOT NULL,
  `type` enum('','Кастинг-агентство','Фонд','Производство','Прокат','Телеканал','Сеть кинотеатров') NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(128) NOT NULL,
  `site` varchar(64) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `text` text NOT NULL,
  `kinometro` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `count`
--

CREATE TABLE `count` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(16) NOT NULL,
  `count` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `design`
--

CREATE TABLE `design` (
  `id` int(11) NOT NULL,
  `status` enum('hide','show') NOT NULL,
  `name` varchar(128) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `html_header` text,
  `html_footer` text,
  `path_css` text,
  `includes` text,
  `right_banner` text,
  `center_banner` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `eav_storage`
--

CREATE TABLE `eav_storage` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` enum('ethnic','sport','language','music_instrument','dance','sing','university','department','studio','theatre') NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `film`
--

CREATE TABLE `film` (
  `id` int(10) UNSIGNED NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `status` enum('new','hide','show') NOT NULL,
  `name_origin` varchar(255) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `search` varchar(255) NOT NULL,
  `country` varchar(96) NOT NULL,
  `year` smallint(5) UNSIGNED NOT NULL,
  `genre` varchar(64) NOT NULL,
  `type` enum('','series','series_ru') NOT NULL,
  `arthouse` enum('no','yes') NOT NULL,
  `runtime` smallint(5) UNSIGNED NOT NULL,
  `premiere_world` date DEFAULT NULL,
  `premiere_ru` date DEFAULT NULL,
  `premiere_usa` date DEFAULT NULL,
  `limit_us` enum('','G','PG','PG-13','R','NC-17') NOT NULL,
  `limit_ru` enum('','0','6','12','16','18') NOT NULL,
  `budget` decimal(10,4) UNSIGNED NOT NULL,
  `season_count` smallint(5) UNSIGNED NOT NULL,
  `series_count` smallint(5) UNSIGNED NOT NULL,
  `year_finish` year(4) DEFAULT NULL,
  `review` int(10) UNSIGNED NOT NULL,
  `preview` text NOT NULL,
  `fact` text NOT NULL,
  `id_imdb` int(10) UNSIGNED NOT NULL,
  `id_kp` int(10) UNSIGNED NOT NULL,
  `id_kt` int(10) UNSIGNED NOT NULL,
  `id_rk` int(10) UNSIGNED NOT NULL,
  `note` text NOT NULL,
  `weight` int(10) UNSIGNED NOT NULL,
  `check` enum('','profile','parser') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `film_boxoffice`
--

CREATE TABLE `film_boxoffice` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('usa','russia','cis') NOT NULL,
  `position` tinyint(3) UNSIGNED NOT NULL,
  `previous` tinyint(3) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `name_origin` varchar(255) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `company_name` varchar(64) NOT NULL,
  `week` tinyint(3) UNSIGNED NOT NULL,
  `copy` mediumint(8) UNSIGNED NOT NULL,
  `gross` int(10) UNSIGNED NOT NULL,
  `gross_total` int(10) UNSIGNED NOT NULL,
  `gross_rub` int(10) UNSIGNED NOT NULL,
  `gross_total_rub` int(10) UNSIGNED NOT NULL,
  `views` int(10) UNSIGNED NOT NULL,
  `views_total` int(10) UNSIGNED NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `course` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `film_cast`
--

CREATE TABLE `film_cast` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `role_ru` varchar(255) NOT NULL,
  `role_en` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `voice` enum('no','yes') DEFAULT NULL,
  `self` enum('no','yes') DEFAULT NULL,
  `uncredited` enum('no','yes') DEFAULT NULL,
  `episodes` smallint(5) UNSIGNED NOT NULL,
  `year` varchar(11) NOT NULL,
  `source` enum('manual','imdb','kinoteatr','movie_credits','profile','kinopoisk') NOT NULL,
  `order` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `film_company_rel`
--

CREATE TABLE `film_company_rel` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `companyId` int(10) UNSIGNED NOT NULL,
  `type` enum('Производство','Прокат','По заказу','При поддержке','При участии','Совместно с') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `film_country`
--

CREATE TABLE `film_country` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `country` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `film_crew`
--

CREATE TABLE `film_crew` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `type` enum('Режиссер','Сценарист','Продюсер','Оператор','Композитор') NOT NULL,
  `description` varchar(255) NOT NULL,
  `episodes` smallint(5) UNSIGNED NOT NULL,
  `year` varchar(11) NOT NULL,
  `source` enum('manual','imdb','kinoteatr','movie_credits','profile','kinopoisk') NOT NULL,
  `order` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `film_frame`
--

CREATE TABLE `film_frame` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `order` smallint(5) UNSIGNED NOT NULL,
  `width` smallint(5) UNSIGNED NOT NULL,
  `height` smallint(5) UNSIGNED NOT NULL,
  `size` smallint(5) UNSIGNED NOT NULL,
  `photo_session` enum('no','yes') NOT NULL,
  `film_set` enum('no','yes') NOT NULL,
  `concept` enum('no','yes') NOT NULL,
  `screenshot` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `film_frame_person`
--

CREATE TABLE `film_frame_person` (
  `id` int(10) UNSIGNED NOT NULL,
  `frameId` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `film_genre`
--

CREATE TABLE `film_genre` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `genre` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `film_gross`
--

CREATE TABLE `film_gross` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `world` int(10) UNSIGNED NOT NULL,
  `ru` int(10) UNSIGNED NOT NULL,
  `usa` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `film_last_rate_update`
--

CREATE TABLE `film_last_rate_update` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `film_letter`
--

CREATE TABLE `film_letter` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `letter` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `film_poster`
--

CREATE TABLE `film_poster` (
  `id` int(10) UNSIGNED NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `width` smallint(5) UNSIGNED NOT NULL,
  `height` smallint(5) UNSIGNED NOT NULL,
  `size` smallint(5) UNSIGNED NOT NULL,
  `popular` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `film_review`
--

CREATE TABLE `film_review` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `status` enum('hide','show') NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `film_review_stat`
--

CREATE TABLE `film_review_stat` (
  `id` int(10) UNSIGNED NOT NULL,
  `reviewId` int(10) UNSIGNED NOT NULL,
  `vote` smallint(5) UNSIGNED NOT NULL,
  `comment` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `film_review_vote`
--

CREATE TABLE `film_review_vote` (
  `id` int(10) UNSIGNED NOT NULL,
  `reviewId` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `film_script`
--

CREATE TABLE `film_script` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `file` varchar(255) NOT NULL,
  `text` mediumtext NOT NULL,
  `language` enum('','ru','en') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `film_sound_dir`
--

CREATE TABLE `film_sound_dir` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `status` enum('hide','show') NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `path` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `year` year(4) NOT NULL,
  `popular` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `film_sound_track`
--

CREATE TABLE `film_sound_track` (
  `id` int(10) UNSIGNED NOT NULL,
  `dirId` int(10) UNSIGNED NOT NULL,
  `m` tinyint(3) UNSIGNED NOT NULL,
  `author` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `order` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `film_stat`
--

CREATE TABLE `film_stat` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `rate` float UNSIGNED NOT NULL,
  `rate_count` int(10) UNSIGNED NOT NULL,
  `imdb` float NOT NULL,
  `imdb_count` int(11) NOT NULL,
  `kp` float NOT NULL,
  `kp_count` int(11) NOT NULL,
  `poster` smallint(5) UNSIGNED NOT NULL,
  `frame` smallint(5) UNSIGNED NOT NULL,
  `wallpaper` smallint(5) UNSIGNED NOT NULL,
  `trailer` smallint(5) UNSIGNED NOT NULL,
  `soundtrack` smallint(5) UNSIGNED NOT NULL,
  `award` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `film_wallpaper`
--

CREATE TABLE `film_wallpaper` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `width` smallint(5) UNSIGNED NOT NULL,
  `height` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `film_wallpaper_person`
--

CREATE TABLE `film_wallpaper_person` (
  `id` int(10) UNSIGNED NOT NULL,
  `wallpaperId` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `log`
--

CREATE TABLE `log` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adminId` int(10) UNSIGNED NOT NULL,
  `route` varchar(32) NOT NULL,
  `handler` varchar(16) NOT NULL,
  `error` enum('false','true') NOT NULL,
  `comment` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `objId` int(10) UNSIGNED NOT NULL,
  `method` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `log_parser`
--

CREATE TABLE `log_parser` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parser` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('ok','error') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `moderate`
--

CREATE TABLE `moderate` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('film','person') NOT NULL,
  `relatedId` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int(10) UNSIGNED NOT NULL,
  `info` mediumtext NOT NULL,
  `source` varchar(255) NOT NULL,
  `file` enum('','jpg','jpeg','png','gif','txt','pdf','doc','docx','rar','zip') NOT NULL,
  `form` enum('extra','error') NOT NULL,
  `new` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `status` enum('hide','show') NOT NULL,
  `category` enum('Новости кино','Зарубежные сериалы','Российские сериалы','Бокс-офис','Рецензии','Ожидания','Был бы повод','Блог','Арткиномания','Интервью','BOOM','Short','Пресс-обзор','В десятку','Инсайд','Фестивали и премии','Сценарии','Подборки') NOT NULL,
  `center` enum('no','yes') NOT NULL,
  `popular` enum('no','yes') NOT NULL,
  `publish` datetime DEFAULT NULL,
  `authorId` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_html` varchar(512) NOT NULL,
  `title_short` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `text_short` text NOT NULL,
  `anons` text NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_file`
--

CREATE TABLE `news_file` (
  `id` int(10) UNSIGNED NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `hash` binary(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_gallery`
--

CREATE TABLE `news_gallery` (
  `id` int(10) UNSIGNED NOT NULL,
  `newsId` int(10) UNSIGNED NOT NULL,
  `trailerId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_gallery_image`
--

CREATE TABLE `news_gallery_image` (
  `id` int(10) UNSIGNED NOT NULL,
  `galleryId` int(11) NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `order` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_link`
--

CREATE TABLE `news_link` (
  `id` int(10) UNSIGNED NOT NULL,
  `newsId` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_stat`
--

CREATE TABLE `news_stat` (
  `id` int(10) UNSIGNED NOT NULL,
  `newsId` int(10) UNSIGNED NOT NULL,
  `comment` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_tag`
--

CREATE TABLE `news_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `newsId` int(10) UNSIGNED NOT NULL,
  `tagId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_tag_value`
--

CREATE TABLE `news_tag_value` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `parser_log`
--

CREATE TABLE `parser_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('person_imdb') NOT NULL,
  `error` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `person`
--

CREATE TABLE `person` (
  `id` int(10) UNSIGNED NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') CHARACTER SET utf8 NOT NULL,
  `status` enum('new','hide','show') CHARACTER SET utf8 NOT NULL,
  `name_origin` varchar(128) CHARACTER SET utf8 NOT NULL,
  `name_ru` varchar(128) CHARACTER SET utf8 NOT NULL,
  `search` varchar(512) CHARACTER SET utf8 NOT NULL,
  `sex` enum('','male','female') CHARACTER SET utf8 NOT NULL,
  `origin` enum('','ru','foreign') CHARACTER SET utf8 NOT NULL,
  `actor` enum('no','yes') CHARACTER SET utf8 NOT NULL,
  `director` enum('no','yes') CHARACTER SET utf8 NOT NULL,
  `screenwriter` enum('no','yes') CHARACTER SET utf8 NOT NULL,
  `producer` enum('no','yes') CHARACTER SET utf8 NOT NULL,
  `composer` enum('no','yes') CHARACTER SET utf8 NOT NULL,
  `operator` enum('no','yes') CHARACTER SET utf8 NOT NULL,
  `birthday` date DEFAULT NULL,
  `death` date DEFAULT NULL,
  `birthplace_en` varchar(255) CHARACTER SET utf8 NOT NULL,
  `birthplace_ru` varchar(255) CHARACTER SET utf8 NOT NULL,
  `height` tinyint(3) UNSIGNED NOT NULL,
  `education` text CHARACTER SET utf8 NOT NULL,
  `theater` text CHARACTER SET utf8 NOT NULL,
  `award` text CHARACTER SET utf8 NOT NULL,
  `info` text CHARACTER SET utf8 NOT NULL,
  `biography` text CHARACTER SET utf8 NOT NULL,
  `award_list` varchar(128) CHARACTER SET utf8 NOT NULL,
  `match` int(10) UNSIGNED NOT NULL,
  `id_imdb` int(10) UNSIGNED NOT NULL,
  `id_kp` int(10) UNSIGNED NOT NULL,
  `id_kt` int(10) UNSIGNED NOT NULL,
  `id_rk` int(10) UNSIGNED NOT NULL,
  `note` text CHARACTER SET utf8 NOT NULL,
  `weight` int(11) NOT NULL,
  `check` enum('','profile','parser') NOT NULL,
  `day` tinyint(3) UNSIGNED NOT NULL,
  `month` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `person_casting`
--

CREATE TABLE `person_casting` (
  `id` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `sex` enum('','male','female') NOT NULL,
  `birthday` date DEFAULT NULL,
  `height` tinyint(3) UNSIGNED NOT NULL,
  `weight` tinyint(3) UNSIGNED NOT NULL,
  `color_hair` enum('','Блондин','Брюнет','Лысый','Русый','Рыжий','Седой','Шатен') NOT NULL,
  `color_eyes` enum('','Голубой','Зелено-голубой','Зеленый','Каре-зеленый','Карий','Серо-голубой','Серо-зеленый','Серый','Черный') NOT NULL,
  `castingId` int(10) UNSIGNED NOT NULL,
  `personWeight` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `person_casting_dance`
--

CREATE TABLE `person_casting_dance` (
  `id` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `keyId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `person_casting_ethnic`
--

CREATE TABLE `person_casting_ethnic` (
  `id` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `keyId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `person_casting_language`
--

CREATE TABLE `person_casting_language` (
  `id` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `keyId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `person_casting_music_instrument`
--

CREATE TABLE `person_casting_music_instrument` (
  `id` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `keyId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `person_casting_sing`
--

CREATE TABLE `person_casting_sing` (
  `id` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `keyId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `person_casting_sport`
--

CREATE TABLE `person_casting_sport` (
  `id` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `keyId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `person_letter`
--

CREATE TABLE `person_letter` (
  `id` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `letter` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `person_photo`
--

CREATE TABLE `person_photo` (
  `id` int(10) UNSIGNED NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `order` smallint(5) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `width` smallint(5) UNSIGNED NOT NULL,
  `height` smallint(5) UNSIGNED NOT NULL,
  `size` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `person_review`
--

CREATE TABLE `person_review` (
  `id` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `status` enum('hide','show') NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `person_review_stat`
--

CREATE TABLE `person_review_stat` (
  `id` int(10) UNSIGNED NOT NULL,
  `reviewId` int(10) UNSIGNED NOT NULL,
  `vote` smallint(5) UNSIGNED NOT NULL,
  `comment` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `person_review_vote`
--

CREATE TABLE `person_review_vote` (
  `id` int(10) UNSIGNED NOT NULL,
  `reviewId` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `person_stat`
--

CREATE TABLE `person_stat` (
  `id` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `photo` smallint(5) UNSIGNED NOT NULL,
  `wallpaper` smallint(5) UNSIGNED NOT NULL,
  `frame` smallint(5) UNSIGNED NOT NULL,
  `news` smallint(5) UNSIGNED NOT NULL,
  `video` smallint(5) UNSIGNED NOT NULL,
  `award` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `person_wallpaper`
--

CREATE TABLE `person_wallpaper` (
  `id` int(10) UNSIGNED NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL,
  `width` int(10) UNSIGNED NOT NULL,
  `height` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `popular`
--

CREATE TABLE `popular` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('film_wallpaper','person_wallpaper_actors','person_wallpaper_actresses','person_photo','film_poster','film_new','casting_promo') NOT NULL,
  `list` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `suggest`
--

CREATE TABLE `suggest` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `trigrams` varchar(255) NOT NULL,
  `freq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `trailer`
--

CREATE TABLE `trailer` (
  `id` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `status` enum('hide','show') NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `date` timestamp NOT NULL,
  `popular` enum('no','yes') NOT NULL,
  `local` enum('no','yes') NOT NULL,
  `type` int(10) UNSIGNED NOT NULL,
  `m` tinyint(3) UNSIGNED NOT NULL,
  `hd480` varchar(255) NOT NULL,
  `hd720` varchar(255) NOT NULL,
  `hd1080` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `weight` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `trailer_person`
--

CREATE TABLE `trailer_person` (
  `id` int(10) UNSIGNED NOT NULL,
  `trailerId` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `trailer_stat`
--

CREATE TABLE `trailer_stat` (
  `id` int(10) UNSIGNED NOT NULL,
  `trailerId` int(10) UNSIGNED NOT NULL,
  `vote` smallint(5) UNSIGNED NOT NULL,
  `comment` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `trailer_type`
--

CREATE TABLE `trailer_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `tv_chanel`
--

CREATE TABLE `tv_chanel` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `tv_program`
--

CREATE TABLE `tv_program` (
  `id` int(10) UNSIGNED NOT NULL,
  `chanelId` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `tv_program_person`
--

CREATE TABLE `tv_program_person` (
  `id` int(10) UNSIGNED NOT NULL,
  `programId` int(10) UNSIGNED NOT NULL,
  `personId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `s` tinyint(3) UNSIGNED NOT NULL,
  `image` enum('','jpeg','png','gif') NOT NULL,
  `login` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('new','active','banned') NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `sex` enum('','male','female') NOT NULL,
  `city` varchar(128) NOT NULL,
  `about` text NOT NULL,
  `interest` text NOT NULL,
  `hash` binary(64) NOT NULL,
  `hashChange` datetime NOT NULL,
  `registration` datetime NOT NULL,
  `birthday` date DEFAULT NULL,
  `vk` varchar(64) NOT NULL,
  `fb` varchar(64) NOT NULL,
  `ok` varchar(64) NOT NULL,
  `twitter` varchar(64) NOT NULL,
  `googlePlus` varchar(64) NOT NULL,
  `liveJournal` varchar(64) NOT NULL,
  `tg` varchar(64) NOT NULL,
  `myMail` varchar(64) NOT NULL,
  `instagram` varchar(64) NOT NULL,
  `skype` varchar(32) NOT NULL,
  `icq` varchar(16) NOT NULL,
  `count_review` smallint(5) UNSIGNED NOT NULL,
  `count_feedback` smallint(5) UNSIGNED NOT NULL,
  `count_comment` smallint(5) UNSIGNED NOT NULL,
  `count_rate` smallint(5) UNSIGNED NOT NULL,
  `count_film` smallint(5) UNSIGNED NOT NULL,
  `count_person` smallint(5) UNSIGNED NOT NULL,
  `count_film_pub` smallint(5) UNSIGNED NOT NULL,
  `count_person_pub` smallint(5) UNSIGNED NOT NULL,
  `last` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_film_vote`
--

CREATE TABLE `user_film_vote` (
  `id` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `filmId` int(10) UNSIGNED NOT NULL,
  `rate` tinyint(3) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_folder`
--

CREATE TABLE `user_folder` (
  `id` int(10) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `type` enum('film','person') NOT NULL,
  `order` tinyint(3) UNSIGNED NOT NULL,
  `status` enum('public','private') NOT NULL,
  `name` varchar(128) NOT NULL,
  `default` enum('','Избранное','Смотреть в кино','Найти в интернете','Купить на DVD','Актеры','Актрисы','Режиссеры') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_folder_film`
--

CREATE TABLE `user_folder_film` (
  `id` int(10) UNSIGNED NOT NULL,
  `folderId` int(11) UNSIGNED NOT NULL,
  `order` smallint(5) UNSIGNED NOT NULL,
  `filmId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_folder_person`
--

CREATE TABLE `user_folder_person` (
  `id` int(10) UNSIGNED NOT NULL,
  `folderId` int(11) UNSIGNED NOT NULL,
  `order` tinyint(3) UNSIGNED NOT NULL,
  `personId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_temp_password`
--

CREATE TABLE `user_temp_password` (
  `id` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `row` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_token`
--

CREATE TABLE `user_token` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` binary(64) NOT NULL,
  `use` tinyint(3) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `groupId` int(10) UNSIGNED NOT NULL,
  `data` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `email` (`email`(24)) USING BTREE;

--
-- Индексы таблицы `admin_access`
--
ALTER TABLE `admin_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`,`route`(24)) USING BTREE,
  ADD KEY `groupId` (`groupId`,`route`(24)) USING BTREE;

--
-- Индексы таблицы `admin_group`
--
ALTER TABLE `admin_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `admin_token`
--
ALTER TABLE `admin_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `token` (`token`) USING BTREE,
  ADD KEY `userId` (`userId`),
  ADD KEY `groupId` (`groupId`);

--
-- Индексы таблицы `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`,`code`) USING BTREE;

--
-- Индексы таблицы `awards_nomination`
--
ALTER TABLE `awards_nomination`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `awards_set`
--
ALTER TABLE `awards_set`
  ADD PRIMARY KEY (`id`),
  ADD KEY `awardId` (`awardId`,`year`,`nominationId`) USING BTREE,
  ADD KEY `personId` (`personId`);

--
-- Индексы таблицы `awards_year`
--
ALTER TABLE `awards_year`
  ADD PRIMARY KEY (`id`),
  ADD KEY `awardId` (`awardId`),
  ADD KEY `year` (`year`) USING BTREE;

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relatedId` (`relatedId`,`type`,`date`) USING BTREE;

--
-- Индексы таблицы `comment_stat`
--
ALTER TABLE `comment_stat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentId` (`commentId`);

--
-- Индексы таблицы `comment_vote`
--
ALTER TABLE `comment_vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`,`commentId`),
  ADD KEY `commentId` (`commentId`);

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`,`name`(8)) USING BTREE;

--
-- Индексы таблицы `count`
--
ALTER TABLE `count`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`key`);

--
-- Индексы таблицы `design`
--
ALTER TABLE `design`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `eav_storage`
--
ALTER TABLE `eav_storage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`key`);
ALTER TABLE `eav_storage` ADD FULLTEXT KEY `value` (`value`);

--
-- Индексы таблицы `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_imdb` (`id_imdb`),
  ADD KEY `status` (`status`,`type`),
  ADD KEY `year` (`year`),
  ADD KEY `arthouse` (`status`,`arthouse`) USING BTREE,
  ADD KEY `type` (`type`,`year`),
  ADD KEY `premiere_usa` (`status`,`premiere_usa`) USING BTREE,
  ADD KEY `premiere_world` (`status`,`premiere_world`) USING BTREE,
  ADD KEY `id_kp` (`id_kp`),
  ADD KEY `id_kt` (`id_kt`),
  ADD KEY `id_rk` (`id_rk`),
  ADD KEY `premiere_ru` (`premiere_ru`,`status`) USING BTREE;

--
-- Индексы таблицы `film_boxoffice`
--
ALTER TABLE `film_boxoffice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`,`date_from`,`position`);

--
-- Индексы таблицы `film_cast`
--
ALTER TABLE `film_cast`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`),
  ADD KEY `filmId` (`filmId`,`order`) USING BTREE;

--
-- Индексы таблицы `film_company_rel`
--
ALTER TABLE `film_company_rel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId` (`filmId`),
  ADD KEY `companyId` (`companyId`,`type`) USING BTREE;

--
-- Индексы таблицы `film_country`
--
ALTER TABLE `film_country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId` (`filmId`),
  ADD KEY `country` (`country`);

--
-- Индексы таблицы `film_crew`
--
ALTER TABLE `film_crew`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId_2` (`filmId`,`type`,`order`),
  ADD KEY `personId` (`personId`,`type`);

--
-- Индексы таблицы `film_frame`
--
ALTER TABLE `film_frame`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId` (`filmId`);

--
-- Индексы таблицы `film_frame_person`
--
ALTER TABLE `film_frame_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frameId` (`frameId`);

--
-- Индексы таблицы `film_genre`
--
ALTER TABLE `film_genre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId` (`filmId`),
  ADD KEY `genre` (`genre`);

--
-- Индексы таблицы `film_gross`
--
ALTER TABLE `film_gross`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId` (`filmId`);

--
-- Индексы таблицы `film_last_rate_update`
--
ALTER TABLE `film_last_rate_update`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId` (`filmId`);

--
-- Индексы таблицы `film_letter`
--
ALTER TABLE `film_letter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId` (`filmId`);

--
-- Индексы таблицы `film_poster`
--
ALTER TABLE `film_poster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `popular` (`popular`),
  ADD KEY `filmId` (`filmId`),
  ADD KEY `width` (`width`);

--
-- Индексы таблицы `film_review`
--
ALTER TABLE `film_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId` (`filmId`,`userId`,`status`),
  ADD KEY `filmId_2` (`filmId`,`status`,`date`) USING BTREE,
  ADD KEY `status` (`status`);

--
-- Индексы таблицы `film_review_stat`
--
ALTER TABLE `film_review_stat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviewId` (`reviewId`);

--
-- Индексы таблицы `film_review_vote`
--
ALTER TABLE `film_review_vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`reviewId`,`userId`) USING BTREE;

--
-- Индексы таблицы `film_script`
--
ALTER TABLE `film_script`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId` (`filmId`),
  ADD KEY `language` (`language`);

--
-- Индексы таблицы `film_sound_dir`
--
ALTER TABLE `film_sound_dir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId` (`filmId`,`status`) USING BTREE;

--
-- Индексы таблицы `film_sound_track`
--
ALTER TABLE `film_sound_track`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `film_stat`
--
ALTER TABLE `film_stat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId` (`filmId`,`rate_count`) USING BTREE;

--
-- Индексы таблицы `film_wallpaper`
--
ALTER TABLE `film_wallpaper`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filmId` (`filmId`);

--
-- Индексы таблицы `film_wallpaper_person`
--
ALTER TABLE `film_wallpaper_person`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adminId` (`adminId`,`id`) USING BTREE,
  ADD KEY `date` (`date`,`adminId`) USING BTREE,
  ADD KEY `objId` (`objId`);

--
-- Индексы таблицы `log_parser`
--
ALTER TABLE `log_parser`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `moderate`
--
ALTER TABLE `moderate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `new` (`new`,`date`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `center` (`status`,`center`,`publish`) USING BTREE,
  ADD KEY `status` (`status`,`category`,`publish`),
  ADD KEY `status_5` (`status`,`center`,`category`,`publish`) USING BTREE,
  ADD KEY `filmId` (`filmId`,`status`);

--
-- Индексы таблицы `news_file`
--
ALTER TABLE `news_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hash` (`hash`(8));

--
-- Индексы таблицы `news_gallery`
--
ALTER TABLE `news_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news_gallery_image`
--
ALTER TABLE `news_gallery_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleryId` (`galleryId`,`order`) USING BTREE;

--
-- Индексы таблицы `news_link`
--
ALTER TABLE `news_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`),
  ADD KEY `filmId` (`filmId`),
  ADD KEY `newsId` (`newsId`,`personId`) USING BTREE,
  ADD KEY `newsId_2` (`newsId`,`filmId`);

--
-- Индексы таблицы `news_stat`
--
ALTER TABLE `news_stat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `newsId` (`newsId`);

--
-- Индексы таблицы `news_tag`
--
ALTER TABLE `news_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `newsId` (`newsId`),
  ADD KEY `tagId` (`tagId`,`newsId`) USING BTREE;

--
-- Индексы таблицы `news_tag_value`
--
ALTER TABLE `news_tag_value`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `news_tag_value` ADD FULLTEXT KEY `tag` (`tag`);

--
-- Индексы таблицы `parser_log`
--
ALTER TABLE `parser_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_imdb` (`id_imdb`),
  ADD KEY `status` (`status`,`weight`),
  ADD KEY `id_kp` (`id_kp`),
  ADD KEY `id_kt` (`id_kt`),
  ADD KEY `id_rk` (`id_rk`),
  ADD KEY `day` (`status`,`day`,`month`,`weight`) USING BTREE;

--
-- Индексы таблицы `person_casting`
--
ALTER TABLE `person_casting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `castingId` (`castingId`),
  ADD KEY `personId` (`personId`),
  ADD KEY `sex` (`sex`,`personWeight`) USING BTREE,
  ADD KEY `birthday` (`birthday`,`personWeight`) USING BTREE;

--
-- Индексы таблицы `person_casting_dance`
--
ALTER TABLE `person_casting_dance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`,`keyId`) USING BTREE;

--
-- Индексы таблицы `person_casting_ethnic`
--
ALTER TABLE `person_casting_ethnic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`,`keyId`) USING BTREE;

--
-- Индексы таблицы `person_casting_language`
--
ALTER TABLE `person_casting_language`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`,`keyId`) USING BTREE;

--
-- Индексы таблицы `person_casting_music_instrument`
--
ALTER TABLE `person_casting_music_instrument`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`,`keyId`) USING BTREE;

--
-- Индексы таблицы `person_casting_sing`
--
ALTER TABLE `person_casting_sing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`,`keyId`) USING BTREE;

--
-- Индексы таблицы `person_casting_sport`
--
ALTER TABLE `person_casting_sport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`,`keyId`) USING BTREE;

--
-- Индексы таблицы `person_letter`
--
ALTER TABLE `person_letter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`);

--
-- Индексы таблицы `person_photo`
--
ALTER TABLE `person_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`,`order`);

--
-- Индексы таблицы `person_review`
--
ALTER TABLE `person_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`,`status`,`date`);

--
-- Индексы таблицы `person_review_stat`
--
ALTER TABLE `person_review_stat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviewId` (`reviewId`);

--
-- Индексы таблицы `person_review_vote`
--
ALTER TABLE `person_review_vote`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviewId` (`reviewId`,`userId`);

--
-- Индексы таблицы `person_stat`
--
ALTER TABLE `person_stat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`);

--
-- Индексы таблицы `person_wallpaper`
--
ALTER TABLE `person_wallpaper`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`);

--
-- Индексы таблицы `popular`
--
ALTER TABLE `popular`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `suggest`
--
ALTER TABLE `suggest`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `keyword` (`keyword`);

--
-- Индексы таблицы `trailer`
--
ALTER TABLE `trailer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`,`type`,`date`),
  ADD KEY `status_2` (`status`,`type`,`popular`,`local`,`filmId`) USING BTREE,
  ADD KEY `filmId` (`filmId`,`status`,`local`) USING BTREE,
  ADD KEY `status_3` (`status`,`local`,`type`,`weight`);

--
-- Индексы таблицы `trailer_person`
--
ALTER TABLE `trailer_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`);

--
-- Индексы таблицы `trailer_stat`
--
ALTER TABLE `trailer_stat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `newsId` (`trailerId`);

--
-- Индексы таблицы `trailer_type`
--
ALTER TABLE `trailer_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`(2));

--
-- Индексы таблицы `tv_chanel`
--
ALTER TABLE `tv_chanel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tv_program`
--
ALTER TABLE `tv_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`,`time`),
  ADD KEY `filmId` (`filmId`);

--
-- Индексы таблицы `tv_program_person`
--
ALTER TABLE `tv_program_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personId` (`personId`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`(16)) USING BTREE,
  ADD KEY `login` (`login`(24)) USING BTREE;

--
-- Индексы таблицы `user_film_vote`
--
ALTER TABLE `user_film_vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`,`filmId`) USING BTREE;

--
-- Индексы таблицы `user_folder`
--
ALTER TABLE `user_folder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`,`type`,`status`,`order`) USING BTREE;

--
-- Индексы таблицы `user_folder_film`
--
ALTER TABLE `user_folder_film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folderId` (`folderId`,`order`);

--
-- Индексы таблицы `user_folder_person`
--
ALTER TABLE `user_folder_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folderId` (`folderId`,`order`);

--
-- Индексы таблицы `user_temp_password`
--
ALTER TABLE `user_temp_password`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `admin_access`
--
ALTER TABLE `admin_access`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `admin_group`
--
ALTER TABLE `admin_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `admin_token`
--
ALTER TABLE `admin_token`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `awards`
--
ALTER TABLE `awards`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `awards_nomination`
--
ALTER TABLE `awards_nomination`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `awards_set`
--
ALTER TABLE `awards_set`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `awards_year`
--
ALTER TABLE `awards_year`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `comment_stat`
--
ALTER TABLE `comment_stat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `comment_vote`
--
ALTER TABLE `comment_vote`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `count`
--
ALTER TABLE `count`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `design`
--
ALTER TABLE `design`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `eav_storage`
--
ALTER TABLE `eav_storage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film`
--
ALTER TABLE `film`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_boxoffice`
--
ALTER TABLE `film_boxoffice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_cast`
--
ALTER TABLE `film_cast`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_company_rel`
--
ALTER TABLE `film_company_rel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_country`
--
ALTER TABLE `film_country`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_crew`
--
ALTER TABLE `film_crew`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_frame`
--
ALTER TABLE `film_frame`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_frame_person`
--
ALTER TABLE `film_frame_person`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_genre`
--
ALTER TABLE `film_genre`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_gross`
--
ALTER TABLE `film_gross`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_last_rate_update`
--
ALTER TABLE `film_last_rate_update`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_letter`
--
ALTER TABLE `film_letter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_poster`
--
ALTER TABLE `film_poster`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_review`
--
ALTER TABLE `film_review`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_review_stat`
--
ALTER TABLE `film_review_stat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_review_vote`
--
ALTER TABLE `film_review_vote`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_script`
--
ALTER TABLE `film_script`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_sound_dir`
--
ALTER TABLE `film_sound_dir`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_sound_track`
--
ALTER TABLE `film_sound_track`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_stat`
--
ALTER TABLE `film_stat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_wallpaper`
--
ALTER TABLE `film_wallpaper`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `film_wallpaper_person`
--
ALTER TABLE `film_wallpaper_person`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `log_parser`
--
ALTER TABLE `log_parser`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `moderate`
--
ALTER TABLE `moderate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news_file`
--
ALTER TABLE `news_file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news_gallery`
--
ALTER TABLE `news_gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news_gallery_image`
--
ALTER TABLE `news_gallery_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news_link`
--
ALTER TABLE `news_link`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news_stat`
--
ALTER TABLE `news_stat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news_tag`
--
ALTER TABLE `news_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news_tag_value`
--
ALTER TABLE `news_tag_value`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `parser_log`
--
ALTER TABLE `parser_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person`
--
ALTER TABLE `person`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_casting`
--
ALTER TABLE `person_casting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_casting_dance`
--
ALTER TABLE `person_casting_dance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_casting_ethnic`
--
ALTER TABLE `person_casting_ethnic`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_casting_language`
--
ALTER TABLE `person_casting_language`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_casting_music_instrument`
--
ALTER TABLE `person_casting_music_instrument`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_casting_sing`
--
ALTER TABLE `person_casting_sing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_casting_sport`
--
ALTER TABLE `person_casting_sport`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_letter`
--
ALTER TABLE `person_letter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_photo`
--
ALTER TABLE `person_photo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_review`
--
ALTER TABLE `person_review`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_review_stat`
--
ALTER TABLE `person_review_stat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_review_vote`
--
ALTER TABLE `person_review_vote`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_stat`
--
ALTER TABLE `person_stat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `person_wallpaper`
--
ALTER TABLE `person_wallpaper`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `popular`
--
ALTER TABLE `popular`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `suggest`
--
ALTER TABLE `suggest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `trailer`
--
ALTER TABLE `trailer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `trailer_person`
--
ALTER TABLE `trailer_person`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `trailer_stat`
--
ALTER TABLE `trailer_stat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `trailer_type`
--
ALTER TABLE `trailer_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tv_chanel`
--
ALTER TABLE `tv_chanel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tv_program`
--
ALTER TABLE `tv_program`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tv_program_person`
--
ALTER TABLE `tv_program_person`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user_film_vote`
--
ALTER TABLE `user_film_vote`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user_folder`
--
ALTER TABLE `user_folder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user_folder_film`
--
ALTER TABLE `user_folder_film`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user_folder_person`
--
ALTER TABLE `user_folder_person`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user_temp_password`
--
ALTER TABLE `user_temp_password`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;