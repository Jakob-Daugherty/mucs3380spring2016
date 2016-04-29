-- Edited by Hunter G. 4/24/2016

-- DDL for the database we create
-- CREATE DATABASE `??`;

-- student TABLE
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
    `id` INTEGER NOT NULL,
    `username` VARCHAR(16) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `name_first` VARCHAR(30) DEFAULT NULL,
    `name_last` VARCHAR(45) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = INNODB;

-- 
-- employee TABLE
-- 
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
    `id` INTEGER NOT NULL,
    `username` VARCHAR(16) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `name_first` VARCHAR(30) DEFAULT NULL,
    `name_last` VARCHAR(45) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = INNODB;

-- 
-- employee_permissions TABLE
-- 
DROP TABLE IF EXISTS `employee_permissions`;
CREATE TABLE `employee_permissions` (
    `id` INTEGER NOT NULL,
    `name` VARCHAR(250) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = INNODB;

-- 
-- location TABLE
-- 
DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
    `id` INTEGER NOT NULL,
    `name` VARCHAR(250) DEFAULT NULL,
    `terminal_id` INTEGER NOT NULL,
    PRIMARY KEY(`id`, `terminal_id`)
) ENGINE = INNODB;

-- 
-- waiver TABLE
-- 
DROP TABLE IF EXISTS `waiver`;
CREATE TABLE `waiver` (
    `id` INTEGER NOT NULL,
    `name` VARCHAR(250) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = INNODB;

-- 
-- expired_waiver TABLE
-- 
DROP TABLE IF EXISTS `expired_waiver`;
CREATE TABLE `expired_waiver` (
    `student_id` INTEGER NOT NULL,
    `waiver_id` INTEGER NOT NULL,
    `initialized` DATETIME NOT NULL,
    `expires` DATETIME NOT NULL,
    FOREIGN KEY (`student_id`) REFERENCES `student`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`waiver_id`) REFERENCES `waiver`(`id`) ON DELETE CASCADE,
    PRIMARY KEY(`student_id`, `waiver_id`)
) ENGINE = INNODB;

-- 
-- item TABLE
-- 
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
    `id` INTEGER NOT NULL,
    `name` VARCHAR(250) NOT NULL,
    `available` TINYINT(1) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = INNODB;

-- 
-- item_condition TABLE
-- 
DROP TABLE IF EXISTS `item_condition`;
CREATE TABLE `item_condition` (
    `id` INTEGER NOT NULL,
    `name` VARCHAR(250) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = INNODB;

-- 
-- item_category TABLE
-- 
DROP TABLE IF EXISTS `item_category`;
CREATE TABLE `item_category` (
    `id` INTEGER NOT NULL,
    `name` VARCHAR(250) NOT NULL,
    `waiver` INT,
    PRIMARY KEY(`id`)
) ENGINE = INNODB;

-- 
-- item_condition_update TABLE
-- 
DROP TABLE IF EXISTS `item_condition_update`;
CREATE TABLE `item_condition_update` (
    `item_condition_id_old` INTEGER NOT NULL,
    `item_id` INTEGER NOT NULL,
    `item_condition_id_new` INTEGER NOT NULL,
    `date_time` DATETIME NOT NULL,
    `employee_id` INTEGER NOT NULL,
    `item_condition_updatecol` VARCHAR(45) DEFAULT NULL,
    FOREIGN KEY (`item_id`) REFERENCES `item`(`id`) ON DELETE CASCADE,
    PRIMARY KEY(`date_time`, `item_id`)
) ENGINE = INNODB;

-- 
-- student_item_transaction TABLE
-- 
DROP TABLE IF EXISTS `student_item_transaction`;
CREATE TABLE `student_item_transaction` (
    `student_id` INTEGER NOT NULL,
    `item_id` INTEGER NOT NULL,
    -- OTHER ATTRIBUTES THAT GO IN THIS TABLE
    FOREIGN KEY (`student_id`) REFERENCES `student`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`item_id`) REFERENCES `item`(`id`) ON DELETE CASCADE,
    PRIMARY KEY(`student_id`, `item_id`)
) ENGINE = INNODB;
