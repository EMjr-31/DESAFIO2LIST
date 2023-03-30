CREATE DATABASE `textil`;
use textil;

CREATE TABLE `Categorias` (
	`codigo_categoria` varchar(10) NOT NULL,
	`nombre_categoria` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`codigo_categoria`)
);
CREATE TABLE `Producto` (
	`codigo_producto` varchar(10) NOT NULL,
	`nombre_producto` VARCHAR(255) NOT NULL,
	`codigo_categoria` varchar(10) NOT NULL,
	`precio_producto` float NOT NULL,
	`existencia_producto` INT NOT NULL,
	`descripcion_producto` VARCHAR(255) NOT NULL,
	`img` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`codigo_producto`)
);



CREATE TABLE `Usuarios` (
	`codigo_usuario` INT NOT NULL AUTO_INCREMENT,
	`nombre_usuario` VARCHAR(255) NOT NULL,
	`correo_usuario` VARCHAR(255) NOT NULL,
	`contrasenia_usuario` VARCHAR(255) NOT NULL,
	`estado` BOOLEAN NOT NULL,
	`codigo_rol`  VARCHAR(10) NOT NULL,
	PRIMARY KEY (`codigo_usuario`)
);

CREATE TABLE `Rol` (
	`codigo_rol` VARCHAR(10) NOT NULL,
	`nombre_rol` VARCHAR(255) ,
	PRIMARY KEY (`codigo_rol`)
);

CREATE TABLE `Venta` (
	`codigo_venta` INT NOT NULL auto_increment,
	`codigo_producto` varchar(10) NOT NULL,
	`codigo_usuario` INT NOT NULL,
	`fecha_venta` DATE NOT NULL,
    PRIMARY KEY (`codigo_venta`)
);


ALTER TABLE `Producto` ADD CONSTRAINT `Producto_fk0` FOREIGN KEY (`codigo_categoria`) REFERENCES `Categorias`(`codigo_categoria`);

ALTER TABLE `Usuarios` ADD CONSTRAINT `Usuarios_fk0` FOREIGN KEY (`codigo_rol`) REFERENCES `Rol`(`codigo_rol`);

ALTER TABLE `Venta` ADD CONSTRAINT `Venta_fk0` FOREIGN KEY (`codigo_producto`) REFERENCES `Producto`(`codigo_producto`);

ALTER TABLE `Venta` ADD CONSTRAINT `Venta_fk1` FOREIGN KEY (`codigo_usuario`) REFERENCES `Usuarios`(`codigo_usuario`);






