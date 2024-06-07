DROP TABLE IF EXISTS habitacion;
CREATE TABLE `habitacion` (
  `numero` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `num_fotos` int(11) DEFAULT 0,
  PRIMARY KEY (`numero`),
  KEY `numero` (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO habitacion VALUES ('0', '4', '0', '', '0');
INSERT INTO habitacion VALUES ('1', '2', '10', 'Habitacion de dos personas', '0');
INSERT INTO habitacion VALUES ('101', '2', '0', '', '0');
INSERT INTO habitacion VALUES ('102', '2', '0', '', '0');
INSERT INTO habitacion VALUES ('103', '2', '0', '', '0');
INSERT INTO habitacion VALUES ('104', '2', '0', '', '0');
INSERT INTO habitacion VALUES ('105', '2', '0', '', '0');
INSERT INTO habitacion VALUES ('201', '3', '0', '', '0');
INSERT INTO habitacion VALUES ('202', '3', '0', '', '0');
INSERT INTO habitacion VALUES ('203', '3', '0', '', '0');
INSERT INTO habitacion VALUES ('204', '3', '0', '', '0');
INSERT INTO habitacion VALUES ('301', '4', '0', '', '0');
INSERT INTO habitacion VALUES ('302', '4', '0', '', '0');

DROP TABLE IF EXISTS logs;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO logs VALUES ('1', 'garridonaldaandres99@gmail.com', 'garridonaldaandres99@gmail.com ha iniciado sesión', '2024-06-07');
INSERT INTO logs VALUES ('2', 'garridonaldaandres99@gmail.com', 'garridonaldaandres99@gmail.com ha cerrado sesión', '2024-06-07');
INSERT INTO logs VALUES ('4', 'marcos@correo.com', 'marcos@correo.com ha iniciado sesión', '2024-06-07');
INSERT INTO logs VALUES ('5', 'marcos@correo.com', 'marcos@correo.com ha cerrado sesión', '2024-06-07');
INSERT INTO logs VALUES ('6', 'paco@correo.com', 'paco@correo.com ha iniciado sesión', '2024-06-07');

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
INSERT INTO reserva VALUES ('garridonaldaandres99@gmail.com', '101', '2', 'Ok', '2024-06-10', '2024-06-20', 'Confirmada', '2024-06-06');
INSERT INTO reserva VALUES ('garridonaldaandres99@gmail.com', '102', '1', '', '2024-06-10', '2024-06-20', '', '2024-06-07');
INSERT INTO reserva VALUES ('paco@correo.com', '101', '1', '', '2024-06-21', '2024-06-25', '', '2024-06-07');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO usuario VALUES ('4', 'marcugas@correo.ugr.es', '$2y$10$8sYfqd38uD46NEcbrVk/a./oLLbi.oUcTJ7K4rnL.sfzgnnWXKD7m', 'marc', 'ugas', '3235432', '324532', 'cliente');
INSERT INTO usuario VALUES ('5', 'garridonaldaandres99@gmail.com', '$2y$10$W3/EU6xWorXNrJ8jP5xe.uNB..MddQvQ1E5fQo7zTPV9.myJWwYP2', 'Andres', 'Garrido', '77768401', '1111', 'cliente');
INSERT INTO usuario VALUES ('6', 'valentinrapidin@correo.com', '$2y$10$IpSXKDEStKbrAuxP.nw3wOM.nOo07uhzWkLnGW.HIpauMtz8KEMl6', 'Valentin', 'Gonzalez ', '1234', '1111', 'cliente');
INSERT INTO usuario VALUES ('7', 'paco@correo.com', '$2y$10$c.rY7hC/hqljO6rmSUMo/.wShXNygLdxWTsrjQUARiv9IUnATyUWS', 'Paco', 'Petines', '123', '1111', 'admin');
INSERT INTO usuario VALUES ('8', 'marcos@correo.com', '$2y$10$weSrFSq2Wu/WkYAz/aKUbeZDYw5jbGytBpsrXYYHW0ZqrhgNG729e', 'Marcos', 'Largo', '1234', '1111', 'recepcionista');

