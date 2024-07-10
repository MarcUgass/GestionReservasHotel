DROP TABLE IF EXISTS habitacion;
CREATE TABLE `habitacion` (
  `numero` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `num_fotos` int(11) DEFAULT 0,
  `imagen` longblob,
  PRIMARY KEY (`numero`),
  KEY `numero` (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert statements with LOAD_FILE function
INSERT INTO habitacion VALUES (101, 2, 100, 'Descripcion de habitacion 101', 0, LOAD_FILE('habitacionTipo1.jpg'));
INSERT INTO habitacion VALUES (102, 2, 100, 'Descripcion de habitacion 102', 0, LOAD_FILE('habitacionTipo2.jpg'));
INSERT INTO habitacion VALUES (103, 2, 100, 'Descripcion de habitacion 103', 1, LOAD_FILE('habitacionTipo1.jpg'));
INSERT INTO habitacion VALUES (104, 2, 100, 'Descripcion de habitacion 104', 1, LOAD_FILE('habitacionTipo2.jpg'));
INSERT INTO habitacion VALUES (105, 2, 100, 'Descripcion de habitacion 105', 2, LOAD_FILE('habitacionTipo1.jpg'));
INSERT INTO habitacion VALUES (201, 3, 150, 'Descripcion de habitacion 201', 2, LOAD_FILE('habitacionTipo2.jpg'));
INSERT INTO habitacion VALUES (202, 3, 150, 'Descripcion de habitacion 202', 3, LOAD_FILE('habitacionTipo1.jpg'));
INSERT INTO habitacion VALUES (203, 3, 150, 'Descripcion de habitacion 203', 3, LOAD_FILE('habitacionTipo2.jpg'));
INSERT INTO habitacion VALUES (204, 3, 150, 'Descripcion de habitacion 204', 4, LOAD_FILE('habitacionTipo1.jpg'));
INSERT INTO habitacion VALUES (301, 4, 200, 'Descripcion de habitacion 301', 4, LOAD_FILE('habitacionTipo2.jpg'));
INSERT INTO habitacion VALUES (302, 4, 200, 'Descripcion de habitacion 302', 4, LOAD_FILE('habitacionTipo1.jpg'));

DROP TABLE IF EXISTS logs;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO logs VALUES ('24', 'tia@void.ugr.es', 'tia@void.ugr.es se ha registrado', '2024-06-07');
INSERT INTO logs VALUES ('25', 'abuela@void.ugr.es', 'abuela@void.ugr.es se ha registrado', '2024-06-07');
INSERT INTO logs VALUES ('26', 'director@void.ugr.es', 'director@void.ugr.es se ha registrado', '2024-06-07');
INSERT INTO logs VALUES ('27', 'elsuper@void.ugr.es', 'elsuper@void.ugr.es se ha registrado', '2024-06-07');
INSERT INTO logs VALUES ('28', 'mortadelo@void.ugr.es', 'mortadelo@void.ugr.es se ha registrado', '2024-06-07');
INSERT INTO logs VALUES ('29', 'filemon@void.ugr.es', 'filemon@void.ugr.es se ha registrado', '2024-06-07');
INSERT INTO logs VALUES ('30', 'bacterio@void.ugr.es', 'bacterio@void.ugr.es se ha registrado', '2024-06-07');
INSERT INTO logs VALUES ('31', 'ofelia@void.ugr.es', 'ofelia@void.ugr.es se ha registrado', '2024-06-07');
INSERT INTO logs VALUES ('32', 'irma@void.ugr.es', 'irma@void.ugr.es se ha registrado', '2024-06-07');
INSERT INTO logs VALUES ('33', 'tia@void.ugr.es', 'tia@void.ugr.es ha iniciado sesión', '2024-06-07');
INSERT INTO logs VALUES ('34', 'tia@void.ugr.es', 'tia@void.ugr.es ha cerrado sesión', '2024-06-07');
INSERT INTO logs VALUES ('35', 'director@void.ugr.es', 'director@void.ugr.es ha iniciado sesión', '2024-06-07');
INSERT INTO logs VALUES ('36', 'director@void.ugr.es', 'director@void.ugr.es ha cerrado sesión', '2024-06-07');
INSERT INTO logs VALUES ('37', 'filemon@void.ugr.es', 'filemon@void.ugr.es ha iniciado sesión', '2024-06-07');
INSERT INTO logs VALUES ('38', 'filemon@void.ugr.es', 'filemon@void.ugr.es ha cerrado sesión', '2024-06-07');
INSERT INTO logs VALUES ('39', 'tia@void.ugr.es', 'tia@void.ugr.es ha iniciado sesión', '2024-06-07');

DROP TABLE IF EXISTS reserva;
CREATE TABLE `reserva` (
  `email` varchar(99) NOT NULL,
  `num_hab` int(11) NOT NULL,
  `personas` int(11) NOT NULL,
  `comentarios` varchar(100) NOT NULL,
  `entrada` date NOT NULL,
  `salida` date NOT NULL,
  `Estado` enum('Operativa','Pendiente','Confirmada') NOT NULL,
  `Marca` date NOT NULL,
  PRIMARY KEY (`email`,`num_hab`),
  KEY `num_hab` (`num_hab`),
  CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`num_hab`) REFERENCES `habitacion` (`numero`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO reserva VALUES ('bacterio@void.ugr.es', '103', '1', '', '2024-07-15', '2024-07-20', 'Confirmada', '2024-07-08');
INSERT INTO reserva VALUES ('filemon@void.ugr.es', '102', '1', '', '2024-07-08', '2024-07-12', 'Confirmada', '2024-07-08');
INSERT INTO reserva VALUES ('irma@void.ugr.es', '202', '1', '', '2024-07-19', '2024-07-23', 'Confirmada', '2024-07-08');
INSERT INTO reserva VALUES ('mortadelo@void.ugr.es', '101', '1', '', '2024-07-12', '2024-07-18', 'Confirmada', '2024-07-08');
INSERT INTO reserva VALUES ('ofelia@void.ugr.es', '103', '1', '', '2024-07-18', '2024-07-23', 'Confirmada', '2024-07-08');

DROP TABLE IF EXISTS usuario;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(99) NOT NULL,
  `clave` varchar(99) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `tarjeta` int(11) NOT NULL,
  `rol` enum('cliente','admin','recepcionista','anonimo') NOT NULL,
  PRIMARY KEY (`id`,`email`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO usuario VALUES ('10', 'tia@void.ugr.es', '$2y$10$elU5gP/qSuYQEUgwcXHqEeptRc1XuxQt0GLJiIxhB51w/hqps3tAC', 'Tia', 'Gonzalez ', '1234', '1111', 'admin');
INSERT INTO usuario VALUES ('11', 'abuela@void.ugr.es', '$2y$10$crH8TFbjfFOU0W8OBp6Bi.4NS9cDLvhEtd.rQjHFqTYYH1Q60AyhK', 'Abuela', 'Gonzalez ', '1234', '1111', 'admin');
INSERT INTO usuario VALUES ('12', 'director@void.ugr.es', '$2y$10$DcTKRGvOfj6JgyhpfboiF.Qxnui26PExw6naGUPS9QRe/q61sQc16', 'Director', 'Gonzalez ', '1234', '1111', 'recepcionista');
INSERT INTO usuario VALUES ('13', 'elsuper@void.ugr.es', '$2y$10$nFKycbOF9fvfXizjEnP3aOvCigQTtsn0jAsb85vCTC5nx1ONSPss6', 'ElSuper', 'Gonzalez ', '1234', '1111', 'recepcionista');
INSERT INTO usuario VALUES ('14', 'mortadelo@void.ugr.es', '$2y$10$okcnBX3AGqrRXuiaCChvkOac7uW3gSN3qpmNsYzOleP199nYluBKa', 'Mortadelo', 'Gonzalez ', '1234', '1111', 'cliente');
INSERT INTO usuario VALUES ('15', 'filemon@void.ugr.es', '$2y$10$hBcbOWhTfxE0nOGpZjNwcOm3Jc2xnkLhPiXnKDV046W73QHI3ll7i', 'Filemon', 'Gonzalez ', '1234', '1111', 'cliente');
INSERT INTO usuario VALUES ('16', 'bacterio@void.ugr.es', '$2y$10$RzNYGXgXEbgInA1aEcF7QeTgHHyooB5IjS3i/SWSh9eeklCDB6KOi', 'Bacterio', 'Profesor', '1234', '1111', 'cliente');
INSERT INTO usuario VALUES ('17', 'ofelia@void.ugr.es', '$2y$10$Bhpf3kdN7wQ9sBKsLELcA.6Ws0em1pRgRhlVAabo82tZUZjOooJYO', 'Ofelia', 'Gonzalez ', '1234', '1111', 'cliente');
INSERT INTO usuario VALUES ('18', 'irma@void.ugr.es', '$2y$10$iKdErlyklV0G5RKgIJdYJOfvR2wLugfesSI5kmMfd5XTVb9NDHwL.', 'Irma', 'Gonzalez ', '1234', '1111', 'cliente');

