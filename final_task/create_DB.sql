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



INSERT INTO `genres` (`genre`)
VALUES 
    ('Фантастика'),
    ('Фэнтези'),
    ('Детектив'),
    ('Ужасы'),
    ('Приключение'),
    ('Триллер')
;

INSERT INTO `books` (`isbn`, `title`, `number_of_pages`, `published_at`)
VALUES
    ('9785001398141', 'Сато', 380, '2020-08-14'),
    ('9785532939141', 'Космический наемник', 2387, '2021-03-17'),
    ('9781112939141', 'Церера. Сияние полуночного золота', 543, '2021-01-13'),
    ('9785389191020', 'Приключения Арсена Люпена', 126, '2022-12-04'),
    ('9785005532909', 'Пустившие по ветру. Роман', 452, NULL),
    ('9785129191020', 'Секреты Родни Длаба', 351, '2021-05-01'),
    ('9785041633974', 'Разрушенный трон', 739, '2021-02-15'),
    ('9785389205437', 'Крысиный остров и другие истории', 355, '2021-07-19')
;

INSERT INTO `authors` (`first_name`, `last_name`)
VALUES
    ('Рагим', 'Джафаров'),
    ('Александр', 'Низаев'),
    ('Мелани', 'Рик'),
    ('Морис', 'Леблан'),
    ('Дина', 'Клопова'),
    ('Нея', 'Соулу'),
    ('Ю', 'Несбё')
;


INSERT INTO `authored` (`author`, `book`)
VALUES
    (
        (SELECT `id` 
        FROM `authors` 
        WHERE `first_name` = 'Рагим'
            AND `last_name` = 'Джафаров')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785001398141')
    ),
    (
        (SELECT `id` 
        FROM `authors` 
        WHERE `first_name` = 'Александр'
            AND `last_name` = 'Низаев')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785532939141')
    ),
    (
        (SELECT `id` 
        FROM `authors` 
        WHERE `first_name` = 'Мелани'
            AND `last_name` = 'Рик')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9781112939141')
    ),
    (
        (SELECT `id` 
        FROM `authors` 
        WHERE `first_name` = 'Морис'
            AND `last_name` = 'Леблан')
    ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785389191020')
    ),
    (
        (SELECT `id` 
        FROM `authors` 
        WHERE `first_name` = 'Дина'
            AND `last_name` = 'Клопова')
    ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785005532909')
    ),
    (
        (SELECT `id` 
        FROM `authors` 
        WHERE `first_name` = 'Нея'
            AND `last_name` = 'Соулу')
    ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785129191020')
    ),
    (
        (SELECT `id` 
        FROM `authors` 
        WHERE `first_name` = 'Нея'
            AND `last_name` = 'Соулу')
    ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785041633974')
    ),
    (
        (SELECT `id` 
        FROM `authors` 
        WHERE `first_name` = 'Ю'
            AND `last_name` = 'Несбё')
    ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785389205437')
    )
;

INSERT INTO `genre_of_book` (`genre`, `book`)
VALUES
    (
        (SELECT `id`
        FROM `genres`
        WHERE `genre` = 'Фантастика')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785001398141')
    ),
    (
        (SELECT `id`
        FROM `genres`
        WHERE `genre` = 'Триллер')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785001398141')
    ),
    (
        (SELECT `id`
        FROM `genres`
        WHERE `genre` = 'Фантастика')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785532939141')
    ),
    (
        (SELECT `id`
        FROM `genres`
        WHERE `genre` = 'Фантастика')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9781112939141')
    ),
    (
        (SELECT `id`
        FROM `genres`
        WHERE `genre` = 'Детектив')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785389191020')
    ),
    (
        (SELECT `id`
        FROM `genres`
        WHERE `genre` = 'Ужасы')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785005532909')
    ),
    (
        (SELECT `id`
        FROM `genres`
        WHERE `genre` = 'Фантастика')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785005532909')
    ),
    (
        (SELECT `id`
        FROM `genres`
        WHERE `genre` = 'Приключение')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785129191020')
    ),
    (
        (SELECT `id`
        FROM `genres`
        WHERE `genre` = 'Фэнтези')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785041633974')
    ),
    (
        (SELECT `id`
        FROM `genres`
        WHERE `genre` = 'Триллер')
        ,
        (SELECT `id`
        FROM `books`
        WHERE `isbn` = '9785389205437')
    )
;