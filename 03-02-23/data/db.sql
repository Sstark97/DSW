CREATE DATABASE schedule;
USE schedule;

CREATE TABLE User (
    id INT PRIMARY KEY AUTO_INCREMENT,
    dni VARCHAR(9) NOT NULL,
    name VARCHAR(65) NOT NULL,
    surname VARCHAR(75) NOT NULL,
    email VARCHAR(55) NOT NULL,
    phone VARCHAR(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO User(dni, name, surname, email, phone) VALUES
("45398037Q", "Aitor", "Santana Cabrera", "aitorscinfo@gmail.com", "123456789"),
("36398036Z", "Pepe", "Cabrera Santana ", "pepe@gmail.com", "1234567854"),
("15338037Y", "Juan", "Dominguez Santana", "juan@gmail.com", "123456723"),
("95398037B", "Carlos", "Santana Pereira", "carlos@gmail.com", "433456789"),
("65398037N", "Juan Carlos", "Santana Cazorla", "juancar@gmail.com", "653456789"),
("35398037M", "Victor", "Perez Cabrera", "victor@gmail.com", "563456789"),
("25398037P", "Manuel", "Escaldon Cabrera", "manuel@gmail.com", "673456789"),
("45398090E", "Jose Tomas", "Figueroa Cabrera", "josetomas@gmail.com", "693456789"),
("45398021X", "Rodrigo", "Gonzales Cabrera", "rodrigo@gmail.com", "603456789");
