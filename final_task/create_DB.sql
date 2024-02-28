CREATE DATABASE `library_fyodor`;
USE `library_fyodor`;


CREATE TABLE `books` (
    `id` INT AUTO_INCREMENT,
    `isbn` VARCHAR(17) NOT NULL UNIQUE,
    `title` VARCHAR(255) NOT NULL,
    `number_of_pages` SMALLINT NOT NULL,
    `published_at` DATE DEFAULT(NULL),
    PRIMARY KEY(`id`)
);

CREATE TABLE `authors` (
    `id` INT AUTO_INCREMENT,
    `first_name` VARCHAR(40) NOT NULL,
    `last_name` VARCHAR(40) NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE `genres` (
    `id` INT AUTO_INCREMENT,
    `genre` VARCHAR(30) NOT NULL UNIQUE,
    PRIMARY KEY(`id`)
);

CREATE TABLE `authored` (
    `id` INT AUTO_INCREMENT,
    `author` INT NOT NULL,
    `book` INT NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`author`) REFERENCES `authors`(`id`),
    FOREIGN KEY(`book`) REFERENCES `books`(`id`)
);

CREATE TABLE `genre_of_book` (
    `id` INT AUTO_INCREMENT,
    `genre` INT NOT NULL,
    `book` INT NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`genre`) REFERENCES `genres`(`id`),
    FOREIGN KEY(`book`) REFERENCES `books`(`id`)
);