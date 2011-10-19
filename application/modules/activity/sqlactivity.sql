SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

ALTER TABLE `globalpms-zf`.`acl_productions` CHANGE COLUMN `date_end` `date_end` DATETIME NOT NULL  ;

CREATE  TABLE IF NOT EXISTS `globalpms-zf`.`acl_activities` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `productions_id` INT(11) NOT NULL ,
  `name` VARCHAR(64) CHARACTER SET 'latin1' NOT NULL DEFAULT '0' ,
  `customer` VARCHAR(250) CHARACTER SET 'latin1' NOT NULL ,
  `client` VARCHAR(250) NULL DEFAULT NULL ,
  `resp_client` VARCHAR(250) CHARACTER SET 'latin1' NOT NULL DEFAULT '0' ,
  `telf_client` VARCHAR(45) NULL DEFAULT NULL ,
  `activity_type` INT(11) NULL DEFAULT NULL ,
  `date_start` DATETIME NOT NULL ,
  `date_end` DATETIME NOT NULL ,
  `resp_customer` VARCHAR(250) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email` (`date_end` ASC) ,
  INDEX `fk_acl_activities_acl_productions1` (`productions_id` ASC) ,
  CONSTRAINT `fk_acl_activities_acl_productions1`
    FOREIGN KEY (`productions_id` )
    REFERENCES `globalpms-zf`.`acl_productions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
AUTO_INCREMENT = 24
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
