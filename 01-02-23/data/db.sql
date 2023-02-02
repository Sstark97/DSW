CREATE DATABASE supermarket;
USE supermarket;

CREATE TABLE Customer(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(65) NOT NULL,
    surname VARCHAR(80) NOT NULL,
    phone VARCHAR(9) NOT NULL
);

INSERT INTO Customer (name, surname, phone) VALUES
("Juan", "Sánchez Rodríguez", "123456789"),
("Rodrigo", "Rodríguez Sánchez", "123456789"),
("María", "Santana Rodríguez", "123456789"),
("Pedro", "Ramos Ramos", "123456789"),
("Rosario", "Ramos Sánchez", "123456789"),
("Beatriz", "Santana Santana", "123456789"),
("Nira", "Sánchez Sámchez", "123456789"),
("Alejandro", "Rodríguez Rodríguez", "123456789");