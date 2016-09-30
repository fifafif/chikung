--changeset fifa:1

DROP TABLE IF EXISTS `c1day`;
CREATE TABLE IF NOT EXISTS `c1day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `description` varchar(256) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

DROP TABLE IF EXISTS `c1exercise`;
CREATE TABLE IF NOT EXISTS `c1exercise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c1day_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `description` text COLLATE utf8_czech_ci NOT NULL,
  `video` varchar(256) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Morning; 1 - Evening',
  PRIMARY KEY (`id`),
  KEY `c1day_id` (`c1day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

DROP TABLE IF EXISTS `c1userProgress`;
CREATE TABLE IF NOT EXISTS `c1userProgress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `c1day_id` int(11) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '0 - no completed; 1 - completed',
  `completedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id-c1day_id` (`user_id`,`c1day_id`),
  KEY `c1day_id` (`c1day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `description` varchar(512) COLLATE utf8_czech_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

DROP TABLE IF EXISTS `DBVERSION`;
CREATE TABLE IF NOT EXISTS `DBVERSION` (
  `version` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

DROP TABLE IF EXISTS `exercise`;
CREATE TABLE IF NOT EXISTS `exercise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_czech_ci NOT NULL,
  `description` text COLLATE utf8_czech_ci NOT NULL,
  `video` varchar(128) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `images` varchar(512) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `method` int(11) NOT NULL DEFAULT '0',
  `paymentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `amount` float NOT NULL,
  `symbol` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(1024) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `accessToken` varchar(1024) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `accessToken` (`accessToken`(255)),
  KEY `id-username` (`id`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

DROP TABLE IF EXISTS `userCourse`;
CREATE TABLE IF NOT EXISTS `userCourse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id-course_id` (`user_id`,`course_id`),
  KEY `user_id` (`user_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

DROP TABLE IF EXISTS `userCoursePayment`;
CREATE TABLE IF NOT EXISTS `userCoursePayment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userCourse_id` int(11) NOT NULL,
  `symbol` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userCourse_id` (`userCourse_id`),
  UNIQUE KEY `symbol` (`symbol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

CREATE TABLE `course1` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL COLLATE 'utf8_czech_ci',
	`description` VARCHAR(512) NULL DEFAULT '' COLLATE 'utf8_czech_ci',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_czech_ci'
ENGINE=InnoDB;
