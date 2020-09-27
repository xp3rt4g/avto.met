/*
Created: 2. 09. 2020
Modified: 23. 09. 2020
Model: MySQL 8.0
Database: MySQL 8.0
*/

-- Create tables section -------------------------------------------------

-- Table users

CREATE TABLE `users`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Char(25) NOT NULL,
  `seller_title` Char(25),
  `address` Char(100) NOT NULL,
  `phone` Char(30) NOT NULL,
  `email` Char(50) NOT NULL,
  `pass` Char(255) NOT NULL,
  `webpage` Char(100),
  `account_type_id` Int NOT NULL,
  `town_id` Int NOT NULL,
  `tax_number` Char(20),
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship1` ON `users` (`account_type_id`)
;

CREATE INDEX `IX_Relationship2` ON `users` (`town_id`)
;

-- Table account_types

CREATE TABLE `account_types`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Char(20) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table towns

CREATE TABLE `towns`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Char(50) NOT NULL,
  `post_number` Char(4) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table manufacturers

CREATE TABLE `manufacturers`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Char(25) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table models

CREATE TABLE `models`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Char(25) NOT NULL,
  `manufacturer_id` Int NOT NULL,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship3` ON `models` (`manufacturer_id`)
;

-- Table fuel_types

CREATE TABLE `fuel_types`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Char(20) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table gearboxes

CREATE TABLE `gearboxes`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Char(20) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table vehicle_status

CREATE TABLE `vehicle_status`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Char(20) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table number_of_owners

CREATE TABLE `number_of_owners`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Char(20) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table cars

CREATE TABLE `cars`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `user_id` Int NOT NULL,
  `model_id` Int NOT NULL,
  `type` Char(75) NOT NULL,
  `car_type_id` Int NOT NULL,
  `vehicle_status_id` Int NOT NULL,
  `has_warranty` Bool NOT NULL DEFAULT 0,
  `has_guarranty` Bool NOT NULL DEFAULT 0,
  `oldtimer` Bool NOT NULL DEFAULT 0,
  `first_registration` Date NOT NULL,
  `manufacture_year` Int NOT NULL,
  `inspection_expiry` Date NOT NULL,
  `mileage` Int NOT NULL,
  `number_of_owner_id` Int NOT NULL,
  `vin` Char(17),
  `price` Int NOT NULL,
  `cash_discount` Bool NOT NULL DEFAULT 0,
  `last_price` Bool NOT NULL DEFAULT 0,
  `driveable` Bool NOT NULL DEFAULT 1,
  `damaged` Bool NOT NULL DEFAULT 0,
  `crashed` Bool NOT NULL DEFAULT 0,
  `service_book` Bool NOT NULL DEFAULT 0,
  `slovenian` Bool NOT NULL DEFAULT 0,
  `garaged` Bool NOT NULL DEFAULT 0,
  `never_crashed` Bool NOT NULL DEFAULT 1,
  `fuel_type_id` Int NOT NULL,
  `gearbox_id` Int NOT NULL,
  `power` Int NOT NULL,
  `ccm` Int,
  `doors` Int NOT NULL,
  `seats` Int NOT NULL,
  `color_id` Int NOT NULL,
  `metallic` Bool NOT NULL DEFAULT 0,
  `consumption` Decimal(4,1),
  `abs` Bool NOT NULL DEFAULT 0,
  `fourwheel` Bool NOT NULL DEFAULT 0,
  `airbags` Int,
  `xenon` Bool NOT NULL DEFAULT 0,
  `led` Bool NOT NULL DEFAULT 0,
  `automatic_lights` Bool NOT NULL DEFAULT 0,
  `alarm` Bool NOT NULL DEFAULT 0,
  `headup` Bool NOT NULL DEFAULT 0,
  `emergency_brake` Bool NOT NULL DEFAULT 0,
  `ac` Bool NOT NULL DEFAULT 0,
  `digital_ac` Bool NOT NULL DEFAULT 0,
  `keyless_go` Bool NOT NULL DEFAULT 0,
  `start_stop` Bool NOT NULL DEFAULT 0,
  `cruise_control` Bool NOT NULL DEFAULT 0,
  `electric_parking_brake` Bool NOT NULL DEFAULT 0,
  `cd_player` Bool NOT NULL DEFAULT 0,
  `mp3_player` Bool NOT NULL DEFAULT 0,
  `usb` Bool NOT NULL DEFAULT 0,
  `dab` Bool NOT NULL DEFAULT 0,
  `navigation` Bool NOT NULL DEFAULT 0,
  `rear_camera` Bool NOT NULL DEFAULT 0,
  `towing_hook` Bool NOT NULL DEFAULT 0,
  `hill_assist` Bool NOT NULL DEFAULT 0,
  `pdc` Bool NOT NULL DEFAULT 0,
  `comment` Text,
  `avaliable` Bool NOT NULL DEFAULT 0,
  `date_posted` Timestamp NOT NULL,
  `date_edited` Timestamp NOT NULL,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship4` ON `cars` (`model_id`)
;

CREATE INDEX `IX_Relationship5` ON `cars` (`car_type_id`)
;

CREATE INDEX `IX_Relationship6` ON `cars` (`vehicle_status_id`)
;

CREATE INDEX `IX_Relationship7` ON `cars` (`user_id`)
;

CREATE INDEX `IX_Relationship8` ON `cars` (`fuel_type_id`)
;

CREATE INDEX `IX_Relationship9` ON `cars` (`gearbox_id`)
;

CREATE INDEX `IX_Relationship10` ON `cars` (`number_of_owner_id`)
;

CREATE INDEX `IX_Relationship11` ON `cars` (`color_id`)
;

-- Table car_types

CREATE TABLE `car_types`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Char(20) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table colors

CREATE TABLE `colors`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Char(20) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table images

CREATE TABLE `images`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `url` Char(200) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table cars_images

CREATE TABLE `cars_images`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `image_id` Int NOT NULL,
  `car_id` Int NOT NULL,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship12` ON `cars_images` (`image_id`)
;

CREATE INDEX `IX_Relationship13` ON `cars_images` (`car_id`)
;

-- Create foreign keys (relationships) section -------------------------------------------------

ALTER TABLE `users` ADD CONSTRAINT `Relationship1` FOREIGN KEY (`account_type_id`) REFERENCES `account_types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `users` ADD CONSTRAINT `Relationship2` FOREIGN KEY (`town_id`) REFERENCES `towns` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `models` ADD CONSTRAINT `Relationship3` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `cars` ADD CONSTRAINT `Relationship4` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `cars` ADD CONSTRAINT `Relationship5` FOREIGN KEY (`car_type_id`) REFERENCES `car_types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `cars` ADD CONSTRAINT `Relationship6` FOREIGN KEY (`vehicle_status_id`) REFERENCES `vehicle_status` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `cars` ADD CONSTRAINT `Relationship7` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `cars` ADD CONSTRAINT `Relationship8` FOREIGN KEY (`fuel_type_id`) REFERENCES `fuel_types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `cars` ADD CONSTRAINT `Relationship9` FOREIGN KEY (`gearbox_id`) REFERENCES `gearboxes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `cars` ADD CONSTRAINT `Relationship10` FOREIGN KEY (`number_of_owner_id`) REFERENCES `number_of_owners` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `cars` ADD CONSTRAINT `Relationship11` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `cars_images` ADD CONSTRAINT `Relationship12` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `cars_images` ADD CONSTRAINT `Relationship13` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


