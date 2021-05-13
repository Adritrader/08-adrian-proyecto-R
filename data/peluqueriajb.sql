-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-02-2021 a las 14:13:47
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
-- Base de datos: `peluqueriajb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

DROP TABLE IF EXISTS `contiene`;
CREATE TABLE IF NOT EXISTS `contiene` (
  `PRODUCTO_id` int(11) NOT NULL,
  `PEDIDO_id` int(11) NOT NULL,
  PRIMARY KEY (`PRODUCTO_id`,`PEDIDO_id`),
  KEY `fk_PRODUCTO_has_PEDIDO_PEDIDO1_idx` (`PEDIDO_id`),
  KEY `fk_PRODUCTO_has_PEDIDO_PRODUCTO1_idx` (`PRODUCTO_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contiene`
--

INSERT INTO `contiene` (`PRODUCTO_id`, `PEDIDO_id`) VALUES
(1, 1),
(2, 1),
(2, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `precio`, `fecha`, `estado`, `REALIZA_id`, `REALIZA_USUARIO_id`) VALUES
(1, '80', '2021-01-03', 'Preparando', 1, 1),
(2, '140.69', '2020-12-30', 'Enviado', 2, 3),
(3, '245.95', '2021-01-29', 'En reparto', 3, 4);

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
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `categoria`, `precio`, `imagen`, `descripcion`) VALUES
(1, 'Sérum Kerastase', 'Tratamientos', 14, 'serum-kerastase.jpg', 'ampollas para pelo'),
(2, 'Ampolla Anti-Caida', 'Tratamientos', 8, 'ampolla-2.jpg', 'Ampolla anti caida'),
(3, 'Pantene Revitalize', 'Champús', 19, 'champu.jpg', 'Champu revitalizante'),
(4, 'GHD Plancha', 'Accesorios', 245, 'ghd-plancha.jpg', 'Plancha para el pelo GHD'),
(5, 'Sebastian', 'Champu', 10, 'sebastian-rizado.jpg', 'Champu para pelo rizado'),
(6, 'Aceite Loreal', 'Tratamientos', 16, 'loreal-aceite.jpg', 'Aceite para el pelo Loreal'),
(7, 'Pantene', 'Champu', 10, 'champu.jpg', 'Champu pantene');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `realiza`
--

INSERT INTO `realiza` (`id`, `USUARIO_id`) VALUES
(1, 1),
(2, 3),
(3, 4),
(4, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `registra`
--

INSERT INTO `registra` (`id`, `USUARIO_id`, `SERVICIO_id`, `hora`, `fecha`) VALUES
(1, 1, 1, '17:00:00', '2021-02-27'),
(2, 3, 2, '18:00:00', '2021-01-09'),
(3, 4, 5, '19:00:00', '2021-01-15');

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
  `telefono` int(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `telefono`, `email`, `username`, `password`, `role`) VALUES
(1, 'Tamara', 'Garcia', 658774115, 'tamaragar@gmail.com', 'user', 'user', 'ROLE_USER'),
(2, 'Paula', 'Catalá', 621032215, 'catalapau@gmail.com', 'Paula', 'user', 'ROLE_USER'),
(3, 'Jose', 'Murcia', 699874610, 'josemur@gmail.com', 'Jose', 'user', 'ROLE_USER'),
(4, 'Amparo', 'Chacón', 655477412, 'amparoChacon@gmail.com', 'admin', 'admin', 'ROLE_ADMIN'),
(5, 'Adrian', 'Garcia', 652874956, 'adri_denia_123@hotmail.com', 'kakak', '1234', 'ROLE_USER');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contiene`
--
ALTER TABLE `contiene`
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
