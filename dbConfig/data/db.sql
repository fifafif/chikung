--changeset fifa:1

CREATE TABLE `course1` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL COLLATE 'utf8_czech_ci',
	`description` VARCHAR(512) NULL DEFAULT '' COLLATE 'utf8_czech_ci',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_czech_ci'
ENGINE=InnoDB;

--changeset fifa:2
CREATE TABLE `course2` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL COLLATE 'utf8_czech_ci',
	`description` VARCHAR(512) NULL DEFAULT '' COLLATE 'utf8_czech_ci',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_czech_ci'
ENGINE=InnoDB;

--changeset fifa:3

DROP TABLE `course2`;