
DROP TABLE IF EXISTS `day`;
CREATE TABLE IF NOT EXISTS `day` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `theme` varchar(256) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


DROP TABLE IF EXISTS `exercise`;
CREATE TABLE IF NOT EXISTS `exercise` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_czech_ci NOT NULL,
  `description` text COLLATE utf8_czech_ci NOT NULL,
  `video` varchar(128) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `images` varchar(512) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


DROP TABLE IF EXISTS `exerciseVariation`;
CREATE TABLE IF NOT EXISTS `exerciseVariation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `name` varchar(256) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_DAY` (`exercise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `k` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `v` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(1024) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `accessToken` varchar(1024) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


DROP TABLE IF EXISTS `userData`;
CREATE TABLE IF NOT EXISTS `userData` (
  `user_id` bigint(20) NOT NULL,
  `exerciseCompleted` varchar(4096) COLLATE utf8_czech_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


DROP TABLE IF EXISTS `userDay`;
CREATE TABLE IF NOT EXISTS `userDay` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `completed` tinyint(4) NOT NULL DEFAULT '0',
  `effectiveDate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_USER` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
