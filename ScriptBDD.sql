DROP DATABASE IF EXISTS tienda;
CREATE DATABASE tienda;
USE tienda;

DROP TABLE IF EXISTS productoses;
CREATE TABLE productoses (
    idProducto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombreProducto VARCHAR(100) NOT NULL,
    enlaceFoto VARCHAR(200) NOT NULL);


DROP TABLE IF EXISTS productosen;
CREATE TABLE productosen (
    idProducto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombreProducto VARCHAR(100) NOT NULL,
    enlaceFoto VARCHAR(200) NOT NULL);


INSERT INTO productoses (nombreProducto, enlaceFoto)
VALUES 
("Fideos", "https://i.imgur.com/kgfZgGV.png"),
("Pescado", "https://i.imgur.com/c1sAsTR.png"),
("Manzana", "https://i.imgur.com/ikE9ccy.png"),
("Cangrejo", "https://i.imgur.com/dki5J2b.png");


INSERT INTO productosen (nombreProducto, enlaceFoto)
VALUES 
("Noodles", "https://i.imgur.com/kgfZgGV.png"),
("Fish", "https://i.imgur.com/c1sAsTR.png"),
("Apple", "https://i.imgur.com/ikE9ccy.png"),
("Crab", "https://i.imgur.com/dki5J2b.png");




