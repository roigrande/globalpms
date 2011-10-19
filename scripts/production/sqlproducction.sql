SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE  TABLE IF NOT EXISTS `globalpms-zf`.`acl_productions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(64) CHARACTER SET 'latin1' NOT NULL DEFAULT '0' ,
  `direction` VARCHAR(250) CHARACTER SET 'latin1' NOT NULL ,
  `date_start` DATETIME NOT NULL ,
  `date_end` DATETIME NOT NULL ,
  `observation` VARCHAR(250) NULL DEFAULT NULL ,
  `person_id` VARCHAR(250) CHARACTER SET 'latin1' NOT NULL DEFAULT '0' ,
  `budget` INT(11) NOT NULL DEFAULT '0' ,
  `in_litter` BINARY(0) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email` (`date_end` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 24
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
