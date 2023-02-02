CREATE DATABASE islands;
USE islands;

CREATE TABLE Island(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(65)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE Village(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(65),
    islandId INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

ALTER TABLE Village ADD FOREIGN KEY (islandId) REFERENCES Island(id);

INSERT INTO Island(name) VALUES
("Gran Canaria"),
("Tenerife"),
("La Palma"),
("Fuerteventura"),
("Lanzarote"),
("La Gomera"),
("El Hierro");

INSERT INTO Village(name, islandId) VALUES 
("Agaete", 1),
("Agüimes", 1),
("La Aldea de San Nicolás", 1),
("Artenara", 1),
("Arucas", 1),
("Firgas", 1),
("Gáldar", 1),
("Ingenio", 1),
("Mogán", 1),
("Moya", 1),
("Las Palmas de Gran Canaria", 1),
("San Bartolomé de Tirajana", 1),
("Santa Brígida", 1),
("Santa Lucía de Tirajana", 1),
("Santa María de Guía de Gran Canaria", 1),
("Tejeda", 1),
("Telde", 1),
("Teror", 1),
("Valleseco", 1),
("Valsequillo de Gran Canaria", 1),
("Vega de San Mateo", 1),

("Adeje", 2),
("Arafo", 2),
("Arico", 2),
("Arona", 2),
("Buenavista del Norte", 2),
("Candelaria", 2),
("El Rosario", 2),
("El Sauzal", 2),
("El Tanque", 2),
("Fasnia", 2),
("Garachico", 2),
("Granadilla de Abona", 2),
("Guía de Isora", 2),
("Güímar", 2),
("Icod de los Vinos", 2),
("La Guancha", 2),
("La Matanza de Acentejo", 2),
("La Orotava", 2),
("La Victoria de Acentejo", 2),
("Los Realejos", 2),
("Los Silos", 2),
("Puerto de la Cruz", 2),
("San Cristóbal de La Laguna", 2),
("San Juan de la Rambla", 2),
("San Miguel de Abona", 2),
("Santa Cruz de Tenerife", 2),
("Santa Úrsula", 2),
("Santiago del Teide", 2),
("Tacoronte", 2),
("Tegueste", 2),
("Vilaflor de Chasna", 2),

("Garafía", 3),
("Tijarafe", 3),
("Puntagorda", 3),
("Tazacorte", 3),
("Los Llanos de Aridane", 3),
("El Paso", 3),
("Fuencaliente", 3),
("Barlovento", 3),
("San Andrés y Sauces", 3),
("Puntallana", 3),
("Santa Cruz de La Palma", 3),
("Breña Alta", 3),
("Breña Baja", 3),
("Villa de Mazo", 3),

("Antigua", 4),
("Betancuria", 4),
("La Oliva", 4),
("Pájara", 4),
("Puero del Rosario", 4),
("Tuineje", 4),

("Arrecife", 5),
("Haría", 5),
("San Bartolomé", 5),
("Teguise", 5),
("Tías", 5),
("Tinajo", 5),
("Yaiza", 5),

("Agulo", 6),
("Alajeró", 6),
("Hermigua", 6),
("San Sebastián de la Gomera", 6),
("Vallehermoso", 6),
("Valle Gran Rey", 6),

("Valverde", 7),
("Frontera", 7),
("El Pinar", 7);
