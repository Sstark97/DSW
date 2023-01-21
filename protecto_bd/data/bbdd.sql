CREATE DATABASE IF NOT EXISTS GameShop;
USE GameShop;

GRANT ALL PRIVILEGES ON GameShop.* TO aitor97@'%' IDENTIFIED BY '12345';
FLUSH PRIVILEGES;

CREATE TABLE User (
    dni VARCHAR(9) PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    surname VARCHAR(75) NOT NULL,
    email VARCHAR(65) NOT NULL,
    password VARCHAR(70) NOT NULL,
    phone VARCHAR(9),
    age INT NOT NULL ,
    is_admin BOOLEAN DEFAULT false
);

CREATE TABLE VideoGame(
    id INT PRIMARY KEY,
    name VARCHAR(75) NOT NULL,
    description VARCHAR(350) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    price DOUBLE NOT NULL,
    assesment DOUBLE,
    release_date DATE
);

CREATE TABLE WhisList(
    dni VARCHAR(9) NOT NULL,
    gameId INT NOT NULL,
    PRIMARY KEY (dni, gameId)
);

ALTER TABLE WhisList ADD FOREIGN KEY (dni) REFERENCES User(dni);
ALTER TABLE WhisList ADD FOREIGN KEY (gameId) REFERENCES VideoGame(id); 

INSERT INTO User (dni, name, surname, email, phone, age, password, is_admin) VALUES
("12345678A", "admin", "admin", "admin@admin.com", "111111111", 99, "admin1234", true);
