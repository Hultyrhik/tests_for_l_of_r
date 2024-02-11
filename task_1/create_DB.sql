CREATE DATABASE `task_1_fyodor`;
USE `task_1_fyodor`;


CREATE TABLE `книги` (
    `id` INT AUTO_INCREMENT,
    `isbn` VARCHAR(17) NOT NULL UNIQUE,
    `название` VARCHAR(255) NOT NULL,
    `количество страниц` SMALLINT NOT NULL,
    `дата публикации` DATE DEFAULT(NULL),
    PRIMARY KEY(`id`)
);

CREATE TABLE `авторы` (
    `id` INT AUTO_INCREMENT,
    `имя` VARCHAR(40) NOT NULL,
    `фамилия` VARCHAR(40) NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE `жанры` (
    `id` INT AUTO_INCREMENT,
    `название` VARCHAR(30) NOT NULL UNIQUE,
    PRIMARY KEY(`id`)
);

CREATE TABLE `авторство` (
    `id` INT AUTO_INCREMENT,
    `автор` INT NOT NULL,
    `книга` INT NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`автор`) REFERENCES `авторы`(`id`),
    FOREIGN KEY(`книга`) REFERENCES `книги`(`id`)
);

CREATE TABLE `жанр_книги` (
    `id` INT AUTO_INCREMENT,
    `жанр` INT NOT NULL,
    `книга` INT NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`жанр`) REFERENCES `жанры`(`id`),
    FOREIGN KEY(`книга`) REFERENCES `книги`(`id`)
);