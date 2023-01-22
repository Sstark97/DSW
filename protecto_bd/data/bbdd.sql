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
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(75) NOT NULL,
    description VARCHAR(350) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    img VARCHAR(80),
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

-- Usuario Administrador
INSERT INTO User (dni, name, surname, email, phone, age, password, is_admin) VALUES
("12345678A", "admin", "admin", "admin@admin.com", "111111111", 99, "admin1234", true);

-- Datos de ejemplo VIdeojuegos
INSERT INTO VideoGame (name, description, genre, img, price, assesment, release_date) VALUES 
("Persona 5", "Persona 5 es un videojuego de rol desarrollado por Atlus", "JRPG","assets/images/persona-5.jpg",34.95, 4.95, "2016-09-16"),
("Arkham Knight", "Batman: Arkham Knight es un juego desarrollado por Rocksteady Studios", "Acción", "assets/images/arkham-knigh.jpg", 19.95, 4.95, "2015-06-23"),
("Pokemon escarlata", "Desarrollados por Game Freak y publicados por Nintendo y The Pokémon Company", "RPG", "assets/images/pkm-escarlata.jpg", 49.95, 5.95, "2022-11-16"),
("Pokemon purpura", "Desarrollados por Game Freak y publicados por Nintendo y The Pokémon Company", "RPG", "assets/images/pkm-purpura.jpg", 49.95, 5.95, "2022-11-16"),
("Pokemon: Arceus", "Desarrollados por Game Freak y publicados por Nintendo y The Pokémon Company", "Acción/RPG", "assets/images/pkm-arceus.jpg", 49.95, 5.95, "2022-01-28"),
("Elden Ring", "Desarrollado por FromSoftware y publicado por Bandai Namco Entertainment", "Acción/RPG", "assets/images/elden-ring.jpg", 54.95, 5.55, "2022-02-25"),
("God of War: Ragnarok", "Juego de acción y aventuras desarrollado por Santa Monica Studio y publicado por Sony Interactive Entertainment", "Acción", "assets/images/ragnarok.jpg", 69.95, 4.95, "2022-11-09"),
("Gotham Knights", "Videojuego de acción y beat'em up basado en el universo de Batman", "Acción", "assets/images/gotham-knights.jpg", 49.95, 4.55, "2022-10-21"),
("Sonic Frontiers", "¡Disfruta de Sonic como nunca antes! ¡Dos mundos chocan en la nueva y vertiginosa aventura de Sonic the Hedgehog! ", "Plataformas", "assets/images/sonic.jpg", 34.95, 3.95, "2022-11-08"),
("Assassin's Creed: Valhalla", "Videojuego desarrollado por Ubisoft Montreal y publicado por Ubisoft", "Acción/RPG", "assets/images/valhalla.png", 34.95, 4.95, "2020-11-10");