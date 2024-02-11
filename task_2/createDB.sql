CREATE DATABASE `feedback_fyodor`;

USE `feedback_fyodor`;

CREATE TABLE `feedback` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `comment` TEXT,
    `name` VARCHAR(100) NOT NULL,
    `address` VARCHAR(100),
    `email` VARCHAR(100),
    `phone` VARCHAR(14) NOT NULL,
    PRIMARY KEY (`id`)
);