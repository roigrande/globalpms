SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


CREATE  TABLE IF NOT EXISTS `globalpms-zf`.`acl_companies` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(64) CHARACTER SET 'latin1' NOT NULL DEFAULT '0' ,
  `direction` VARCHAR(250) CHARACTER SET 'latin1' NOT NULL ,
  `date_start` DATETIME NOT NULL ,
  `date_end` DATETIME NOT NULL ,
  `observation` VARCHAR(250) NULL DEFAULT NULL ,
  `person_id` VARCHAR(250) CHARACTER SET 'latin1' NOT NULL DEFAULT '0' ,
  `budget` INT(11) NOT NULL DEFAULT '0' ,
  `in_litter` BINARY(0) NULL DEFAULT NULL ,
  `acl_type_company_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email` (`date_end` ASC) ,
  INDEX `fk_acl_company_acl_type_company1` (`acl_type_company_id` ASC) ,
  CONSTRAINT `fk_acl_company_acl_type_company1`
    FOREIGN KEY (`acl_type_company_id` )
    REFERENCES `globalpms-zf`.`acl_type_company` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
AUTO_INCREMENT = 24
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE  TABLE IF NOT EXISTS `globalpms-zf`.`acl_contacts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(64) CHARACTER SET 'latin1' NOT NULL DEFAULT '0' ,
  `direction` VARCHAR(250) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `email` VARCHAR(250) CHARACTER SET 'latin1' NOT NULL DEFAULT '0' ,
  `phone` VARCHAR(250) CHARACTER SET 'latin1' NOT NULL DEFAULT '0' ,
  `acl_company_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email` (`email` ASC) ,
  INDEX `fk_acl_contacts_acl_company1` (`acl_company_id` ASC) ,
  CONSTRAINT `fk_acl_contacts_acl_company1`
    FOREIGN KEY (`acl_company_id` )
    REFERENCES `globalpms-zf`.`acl_companies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
AUTO_INCREMENT = 24
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE  TABLE IF NOT EXISTS `globalpms-zf`.`acl_clients` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `type_client` VARCHAR(64) CHARACTER SET 'latin1' NOT NULL DEFAULT '0' ,
  `acl_type_client_id` INT(11) NOT NULL ,
  `acl_companies_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_acl_client_acl_type_client1` (`acl_type_client_id` ASC) ,
  INDEX `fk_acl_clients_acl_companies1` (`acl_companies_id` ASC) ,
  CONSTRAINT `fk_acl_client_acl_type_client1`
    FOREIGN KEY (`acl_type_client_id` )
    REFERENCES `globalpms-zf`.`acl_type_client` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_acl_clients_acl_companies1`
    FOREIGN KEY (`acl_companies_id` )
    REFERENCES `globalpms-zf`.`acl_companies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
AUTO_INCREMENT = 24
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE  TABLE IF NOT EXISTS `globalpms-zf`.`acl_type_production` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `module_name` (`name` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 26
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE  TABLE IF NOT EXISTS `globalpms-zf`.`acl_type_client` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `module_name` (`name` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 26
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
