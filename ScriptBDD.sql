DROP DATABASE IF EXISTS tienda;
CREATE DATABASE tienda;
USE tienda;

DROP TABLE IF EXISTS productoses;
CREATE TABLE productoses (
    idProducto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombreProducto VARCHAR(100) NOT NULL,
    enlaceFoto VARCHAR(200) NOT NULL,
    precioProducto DECIMAL NOT NULL,
    descripcionProducto VARCHAR(200) NOT NULL);




DROP TABLE IF EXISTS productosen;
CREATE TABLE productosen (
    idProducto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombreProducto VARCHAR(100) NOT NULL,
    enlaceFoto VARCHAR(200) NOT NULL,
    precioProducto DECIMAL NOT NULL,
    descripcionProducto VARCHAR(200) NOT NULL);


INSERT INTO productoses (nombreProducto, enlaceFoto, precioProducto, descripcionProducto)
VALUES 
("Fideos", "https://i.imgur.com/kgfZgGV.png", 1.50, "Paquete de fideos de 500g"),
("Pescado", "https://i.imgur.com/c1sAsTR.png", 4.75, "Pescado fresco del día, por libra"),
("Manzana", "https://i.imgur.com/ikE9ccy.png", 0.50, "Manzana roja, precio por unidad"),
("Cangrejo", "https://i.imgur.com/dki5J2b.png", 8.20, "Cangrejo fresco, precio por libra");

INSERT INTO productosen (nombreProducto, enlaceFoto, precioProducto, descripcionProducto)
VALUES 
("Noodles", "https://i.imgur.com/kgfZgGV.png", 1.50, "500g pack of noodles"),
("Fish", "https://i.imgur.com/c1sAsTR.png", 4.75, "Fresh fish of the day, per pound"),
("Apple", "https://i.imgur.com/ikE9ccy.png", 0.50, "Red apple, price per unit"),
("Crab", "https://i.imgur.com/dki5J2b.png", 8.20, "Fresh crab, price per pound");



