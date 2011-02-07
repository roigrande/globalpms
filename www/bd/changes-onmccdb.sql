--13-05
ALTER TABLE `customers` ADD `next_app_date` DATETIME NULL DEFAULT NULL ;
--10-05
ALTER TABLE `customers` DROP `description`, DROP `info`;

--04-05
ALTER TABLE `customers_trackings`  DROP PRIMARY KEY ;
ALTER TABLE `customers_trackings` ADD `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ;
ALTER TABLE `customers_trackings` ADD INDEX ( `pk_fk_customer` , `pk_fk_tracking` ) ;
ALTER TABLE `customers_trackings` CHANGE `date` `date` DATETIME NOT NULL ;

--28-04

INSERT INTO `onmccdb`.`content_types` (
`pk_content_type` ,
`name` ,
`title`
)
VALUES (
'2', 'tracking', 'tracking'
);
ALTER TABLE `trackings` DROP `description` ;
ALTER TABLE `customers` ADD `web_page` VARCHAR( 255 ) NULL ,
ADD `info` VARCHAR( 255 ) NULL ;
ALTER TABLE `trackings` CHANGE `icon` `icon` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ;





--26-04

ALTER TABLE `trackings` ADD `description` VARCHAR( 255 ) NULL DEFAULT NULL ;
ALTER TABLE `customers_trackings` ADD `info` TEXT NULL DEFAULT NULL ;
