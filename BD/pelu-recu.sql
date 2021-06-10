-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-06-2021 a las 09:35:37
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pelu-recu`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contienepro`
--

DROP TABLE IF EXISTS `contienepro`;
CREATE TABLE IF NOT EXISTS `contienepro` (
  `PRODUCTO_id` int(11) NOT NULL,
  `PEDIDO_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`PRODUCTO_id`,`PEDIDO_id`,`id`),
  KEY `fk_PRODUCTO_has_PEDIDO_PEDIDO1_idx` (`PEDIDO_id`),
  KEY `fk_PRODUCTO_has_PEDIDO_PRODUCTO1_idx` (`PRODUCTO_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contienepro`
--

INSERT INTO `contienepro` (`PRODUCTO_id`, `PEDIDO_id`, `id`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 67, 3),
(6, 67, 4),
(2, 68, 5),
(3, 68, 6),
(2, 69, 8),
(3, 69, 8),
(5, 69, 7),
(3, 71, 9),
(5, 71, 8),
(1, 73, 9),
(1, 73, 12),
(3, 73, 10),
(3, 73, 12),
(5, 73, 11),
(5, 73, 12),
(1, 75, 13),
(1, 75, 14),
(1, 75, 15),
(1, 75, 16),
(2, 77, 17),
(2, 77, 18),
(3, 79, 19),
(5, 80, 20),
(5, 80, 21),
(5, 82, 22),
(5, 82, 23),
(5, 84, 24),
(5, 84, 25),
(1, 86, 28),
(2, 86, 26),
(3, 86, 27),
(2, 87, 29),
(3, 87, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precio` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `REALIZA_id` int(11) NOT NULL,
  `REALIZA_USUARIO_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_PEDIDO_REALIZA1_idx` (`REALIZA_id`,`REALIZA_USUARIO_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `precio`, `fecha`, `estado`, `REALIZA_id`, `REALIZA_USUARIO_id`) VALUES
(1, '80', '2021-01-03', 'Preparando', 1, 1),
(2, '140.69', '2020-12-30', 'Enviado', 2, 3),
(3, '245.95', '2021-01-29', 'En reparto', 3, 4),
(9, '8', '2021-05-22', 'Preparando', 4, 2),
(10, '8', '2021-05-22', 'Preparando', 4, 2),
(11, '8', '2021-05-22', 'Preparando', 4, 2),
(12, '8', '2021-05-22', 'Preparando', 4, 2),
(16, '48', '2021-05-22', 'Preparando', 15, 4),
(17, '48', '2021-05-22', 'Preparando', 16, 4),
(18, '22', '2021-05-22', 'Preparando', 17, 4),
(19, '22', '2021-05-22', 'Preparando', 18, 4),
(20, '22', '2021-05-22', 'Preparando', 19, 4),
(21, '22', '2021-05-22', 'Preparando', 20, 4),
(22, '22', '2021-05-22', 'Preparando', 21, 4),
(23, '22', '2021-05-22', 'Preparando', 22, 4),
(24, '22', '2021-05-23', 'Preparando', 23, 4),
(25, '22', '2021-05-23', 'Preparando', 24, 4),
(26, '22', '2021-05-23', 'Preparando', 25, 4),
(27, '22', '2021-05-23', 'Preparando', 26, 4),
(28, '22', '2021-05-23', 'Preparando', 27, 4),
(29, '22', '2021-05-23', 'Preparando', 28, 4),
(30, '22', '2021-05-23', 'Preparando', 29, 4),
(31, '22', '2021-05-23', 'Preparando', 30, 4),
(32, '8', '2021-05-23', 'Preparando', 31, 4),
(33, '56', '2021-05-23', 'Preparando', 32, 4),
(34, '36', '2021-05-23', 'Preparando', 33, 4),
(35, '28', '2021-05-23', 'Preparando', 34, 4),
(36, '28', '2021-05-23', 'Preparando', 35, 4),
(37, '62', '2021-05-23', 'Preparando', 36, 4),
(38, '62', '2021-05-23', 'Preparando', 37, 4),
(39, '62', '2021-05-23', 'Preparando', 38, 4),
(40, '62', '2021-05-23', 'Preparando', 39, 4),
(41, '62', '2021-05-23', 'Preparando', 40, 4),
(42, '62', '2021-05-23', 'Preparando', 41, 4),
(43, '62', '2021-05-23', 'Preparando', 42, 4),
(44, '62', '2021-05-23', 'Preparando', 43, 4),
(45, '62', '2021-05-23', 'Preparando', 44, 4),
(46, '22', '2021-05-23', 'Preparando', 45, 4),
(47, '22', '2021-05-23', 'Preparando', 46, 4),
(48, '22', '2021-05-23', 'Preparando', 47, 4),
(49, '22', '2021-05-23', 'Preparando', 48, 4),
(50, '22', '2021-05-23', 'Preparando', 49, 4),
(51, '98', '2021-05-23', 'Preparando', 50, 4),
(53, '97', '2021-05-23', 'Preparando', 52, 1),
(54, '97', '2021-05-23', 'Preparando', 53, 1),
(55, '85', '2021-05-23', 'Preparando', 54, 1),
(56, '64', '2021-05-23', 'Preparando', 55, 1),
(57, '98', '2021-05-23', 'Preparando', 56, 1),
(59, '77', '2021-05-23', 'Preparando', 58, 4),
(60, '8', '2021-05-23', 'Preparando', 60, 4),
(67, '84', '2021-05-23', 'Preparando', 67, 4),
(68, '59', '2021-05-24', 'Preparando', 68, 4),
(69, '28', '2021-05-24', 'Preparando', 69, 4),
(71, '28', '2021-05-24', 'Preparando', 72, 1),
(73, '20', '2021-05-24', 'Preparando', 75, 4),
(75, '66', '2021-05-24', 'Preparando', 77, 1),
(77, '28', '2021-05-24', 'Preparando', 79, 4),
(79, '8', '2021-05-25', 'Preparando', 81, 16),
(80, '20', '2021-05-25', 'Preparando', 82, 16),
(82, '32', '2021-05-25', 'Preparando', 84, 18),
(84, '32', '2021-05-25', 'Preparando', 86, 19),
(86, '32', '2021-05-25', 'Preparando', 88, 4),
(87, '42', '2021-05-25', 'Preparando', 89, 4),
(88, '28', '2021-05-27', 'Preparando', 90, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `categoria` varchar(45) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `categoria`, `precio`, `imagen`, `descripcion`) VALUES
(1, 'Sérum Kerastase', 'Tratamientos', 14, 'serum-kerastase.jpg', 'Serum para cabello'),
(2, 'Ampolla Anti-Caida', 'Tratamientos', 8, 'ampolla-1.jpg', 'Ampolla para revitalizar el cabello'),
(3, 'Pantene Revitalize2', 'Champ&uacute;s', 20, 'proteina.jpg', 'Es una champu a prueba de balas'),
(5, 'Champu salerm', 'Champ&uacute;s', 32, 'champu.jpg', 'Champu salerm para pelos '),
(6, 'Ampollas Salerm', 'Tratamientos', 45, 'ampollas-salerm.jpg', 'Ampollas revitalizantes Salerm'),
(7, 'Champu Schwarkopft', 'Champu', 24, 'serum-kerastase.jpg', 'Es un champu para el pelo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `realiza`
--

DROP TABLE IF EXISTS `realiza`;
CREATE TABLE IF NOT EXISTS `realiza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`USUARIO_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_REALIZA_USUARIO1_idx` (`USUARIO_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `realiza`
--

INSERT INTO `realiza` (`id`, `USUARIO_id`) VALUES
(1, 1),
(2, 3),
(3, 4),
(4, 2),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(37, 4),
(38, 4),
(39, 4),
(40, 4),
(41, 4),
(42, 4),
(43, 4),
(44, 4),
(45, 4),
(46, 4),
(47, 4),
(48, 4),
(49, 4),
(50, 4),
(51, 4),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 4),
(59, 4),
(60, 4),
(61, 4),
(62, 4),
(63, 1),
(64, 1),
(65, 4),
(66, 4),
(67, 4),
(68, 4),
(69, 4),
(70, 4),
(71, 1),
(72, 1),
(73, 1),
(74, 4),
(75, 4),
(76, 4),
(77, 1),
(78, 1),
(79, 4),
(80, 4),
(81, 16),
(82, 16),
(83, 16),
(84, 18),
(85, 18),
(86, 19),
(87, 19),
(88, 4),
(89, 4),
(90, 4),
(91, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registra`
--

DROP TABLE IF EXISTS `registra`;
CREATE TABLE IF NOT EXISTS `registra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO_id` int(11) NOT NULL,
  `SERVICIO_id` int(11) NOT NULL,
  `hora` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`,`USUARIO_id`,`SERVICIO_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_USUARIO_has_SERVICIO_SERVICIO1_idx` (`SERVICIO_id`),
  KEY `fk_USUARIO_has_SERVICIO_USUARIO_idx` (`USUARIO_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `registra`
--

INSERT INTO `registra` (`id`, `USUARIO_id`, `SERVICIO_id`, `hora`, `fecha`) VALUES
(1, 1, 1, '17:00:00', '2021-02-27'),
(2, 3, 2, '18:00:00', '2021-01-09'),
(3, 4, 5, '19:00:00', '2021-01-15'),
(4, 1, 4, '12:00:00', '2021-05-26'),
(5, 4, 1, '09:30:00', '2021-05-26'),
(6, 4, 5, '16:30:00', '2021-05-30'),
(7, 4, 1, '18:00:00', '2021-05-30'),
(8, 4, 5, '16:30:00', '2021-05-31'),
(9, 4, 3, '18:00:00', '2025-10-24'),
(10, 1, 1, '11:00:00', '2021-05-30'),
(11, 1, 6, '12:00:00', '2021-06-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

DROP TABLE IF EXISTS `servicio`;
CREATE TABLE IF NOT EXISTS `servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`) VALUES
(1, 'Corte Mujer'),
(2, 'Corte Caballero'),
(3, 'Color'),
(4, 'Lavar y secar'),
(5, 'Recogido'),
(6, 'Secado y peinado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `telefono`, `email`, `password`, `role`, `username`, `avatar`) VALUES
(1, 'Tamara', 'Garcia', '658774115', 'tamaragar@gmail.com', 'user', 'ROLE_USER', 'user', 'avatar1.jpg'),
(2, 'Paula', 'Catalá', '621032215', 'catalapau@gmail.com', 'Pau_00', 'ROLE_USER', 'Paula', 'foto.jpg'),
(3, 'Jose', 'Murcia', '699874610', 'josemur@gmail.com', 'Murcia_69', 'ROLE_USER', 'Jose', 'imagen2.jpg'),
(4, 'Admin', 'Chac&oacute;n', '655477412', 'amparoChacon@gmail.com', 'admin', 'ROLE_ADMIN', 'admin', 'iconeg-05.png'),
(6, 'Adrian', 'Garcia', '695414544', 'adri@gmail.com', 'user', 'ROLE_USER', 'user', 'avatar2.jpg'),
(8, 'Usuario', 'Creado', '966544525', 'usuario@gmail.com', 'user', 'ROLE_USER', 'vapordev', 'avatar3.jpg'),
(9, 'Adrian', 'Garcia', '652874956', 'adri_denia_123@hotmail.com', '1234', 'ROLE_USER', 'Vapor2', 'iconeg-05.png'),
(10, 'Juan', 'Rodriguez', '699226688', 'juan@hotmail.com', '12345', 'ROLE_USER', 'Jose', 'universo-espacio-interestelar-2903.jpg'),
(11, 'Sergio', 'Carape', '698774414', 'Sergiocape@gmail.com', '12345', 'ROLE_USER', 'Carape', 'bitcoin-digital-currency.jpg'),
(12, 'Alberto777', 'Looi', '622114458', 'luisalb@hotmail.com', '1234', 'ROLE_USER', 'AlbertoLuis', 'eclipse-solar-desde-espacio-5303c998cd1c9.jpg'),
(13, 'Alberto777', 'Looi', '622114458', 'luisalb@hotmail.com', '12345', 'ROLE_USER', 'AlbertoLuis', 'eclipse-solar-desde-espacio-5303c998cd1c9.jpg'),
(14, 'Alberto', 'Amen', '622114458', 'luisalb@hotmail.com', '1234', 'ROLE_USER', 'nust', 'universo-espacio-interestelar-2903.jpg'),
(15, 'Alberto', 'Amen', '622114458', 'luisalb@hotmail.com', '8787', 'ROLE_USER', 'nust', 'universo-espacio-interestelar-2903.jpg'),
(16, 'Juan', 'Rodriguez', '699226688', 'juan@hotmail.com', '1234', 'ROLE_USER', 'JuanAn', 'eclipse-solar-desde-espacio-5303c998cd1c9.jpg'),
(17, 'Juan', 'Rodriguez', '699226688', 'juan@hotmail.com', '12345', 'ROLE_USER', 'JuanAn', 'eclipse-solar-desde-espacio-5303c998cd1c9.jpg'),
(18, 'Andriw', 'Bisquert', '687711141', 'andrea@gmail.com', '12345', 'ROLE_USER', 'Andriw', 'bitcoin-digital-currency.jpg'),
(19, 'Alberto3', 'Looi', '622114458', 'luisalb@hotmail.com', 'po1', 'ROLE_USER', 'po1', 'universo-espacio-interestelar-2903.jpg');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contienepro`
--
ALTER TABLE `contienepro`
  ADD CONSTRAINT `fk_PRODUCTO_has_PEDIDO_PEDIDO1` FOREIGN KEY (`PEDIDO_id`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PRODUCTO_has_PEDIDO_PRODUCTO1` FOREIGN KEY (`PRODUCTO_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_PEDIDO_REALIZA1` FOREIGN KEY (`REALIZA_id`,`REALIZA_USUARIO_id`) REFERENCES `realiza` (`id`, `USUARIO_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD CONSTRAINT `fk_REALIZA_USUARIO1` FOREIGN KEY (`USUARIO_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registra`
--
ALTER TABLE `registra`
  ADD CONSTRAINT `fk_USUARIO_has_SERVICIO_SERVICIO1` FOREIGN KEY (`SERVICIO_id`) REFERENCES `servicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USUARIO_has_SERVICIO_USUARIO` FOREIGN KEY (`USUARIO_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
