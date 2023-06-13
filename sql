-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-06-2023 a las 00:28:42
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `peluqueria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `id_cita` int NOT NULL AUTO_INCREMENT,
  `fecha_cita_creada` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_cliente` int NOT NULL,
  `id_peluquero` int NOT NULL,
  `inicio` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cancelada` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_cita_cancelada` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `endeudar` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_cita_endeudada` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `registrada` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_cita`),
  KEY `fk_cita_peluquero` (`id_peluquero`),
  KEY `fk_cita_cliente` (`id_cliente`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `appointments`
--

INSERT INTO `appointments` (`id_cita`, `fecha_cita_creada`, `id_cliente`, `id_peluquero`, `inicio`, `fin`, `cancelada`, `motivo_cita_cancelada`, `endeudar`, `motivo_cita_endeudada`, `registrada`) VALUES
(68, '2023-06-04 22:25:00', 45, 10, '2023-06-05 08:15:00', '2023-06-05 08:43:00', 0, NULL, 0, NULL, 1),
(69, '2023-06-04 22:26:00', 45, 10, '2023-06-05 08:45:00', '2023-06-05 09:13:00', 0, NULL, 0, NULL, 1),
(70, '2023-06-04 22:26:00', 45, 10, '2023-06-05 09:15:00', '2023-06-05 09:43:00', 0, NULL, 0, NULL, 1),
(71, '2023-06-07 20:51:50', 44, 16, '2023-06-06 20:51:50', '2023-06-06 21:21:50', 0, NULL, 0, NULL, 0),
(73, '2023-06-06 20:54:13', 44, 10, '2023-06-09 20:54:13', '2023-06-09 20:54:13', 0, NULL, 0, NULL, 0),
(74, '2023-06-12 19:45:00', 44, 10, '2023-06-13 08:15:00', '2023-06-13 08:43:00', 0, NULL, 1, NULL, 0),
(75, '2023-06-12 19:46:00', 44, 10, '2023-06-13 08:15:00', '2023-06-13 08:43:00', 1, '', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boxs`
--

DROP TABLE IF EXISTS `boxs`;
CREATE TABLE IF NOT EXISTS `boxs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_apertura` timestamp NOT NULL,
  `fecha_cierre` timestamp NULL DEFAULT NULL,
  `saldo_inicial` decimal(6,2) NOT NULL,
  `saldo_final` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `boxs`
--

INSERT INTO `boxs` (`id`, `fecha_apertura`, `fecha_cierre`, `saldo_inicial`, `saldo_final`) VALUES
(57, '2023-05-31 19:26:59', '2023-05-31 19:16:03', '0.00', '42.00'),
(58, '2023-05-31 19:16:03', '2023-05-31 19:36:15', '100.00', '121.00'),
(59, '2023-05-31 19:36:15', '2023-05-31 19:53:55', '100.00', '121.00'),
(60, '2023-05-31 19:53:55', '2023-05-31 21:44:42', '100.00', '310.00'),
(61, '2023-05-31 21:44:42', '2023-06-01 05:41:30', '100.00', '121.00'),
(62, '2023-06-01 05:41:30', '2023-06-01 05:49:54', '100.00', '100.00'),
(63, '2023-06-02 05:49:54', '2023-06-01 05:50:06', '100.00', '100.00'),
(64, '2023-06-02 05:50:06', '2023-06-02 05:52:13', '100.00', '100.00'),
(65, '2023-06-02 05:52:13', '2023-06-01 08:53:10', '100.00', '100.00'),
(66, '2023-06-02 05:53:10', '2023-06-01 05:59:11', '100.00', '100.00'),
(67, '2023-06-02 06:00:00', '2023-06-01 06:02:37', '100.00', '100.00'),
(68, '2023-06-02 06:00:00', '2023-06-01 06:03:18', '100.00', '100.00'),
(69, '2023-06-02 06:00:00', '2023-06-01 08:27:40', '100.00', '100.00'),
(70, '2023-06-02 06:00:00', '2023-06-01 08:32:34', '100.00', '100.00'),
(71, '2023-06-02 06:00:00', '2023-06-01 08:43:02', '100.00', '100.00'),
(72, '2023-06-02 06:00:00', '2023-06-01 08:43:52', '100.00', '100.00'),
(73, '2023-06-02 06:00:00', '2023-06-01 08:44:25', '100.00', '100.00'),
(74, '2023-06-02 06:00:00', '2023-06-01 09:19:06', '100.00', '100.00'),
(75, '2023-06-02 06:00:00', '2023-06-01 09:24:24', '100.00', '100.00'),
(76, '2023-06-02 06:00:00', '2023-06-01 09:25:35', '100.00', '100.00'),
(77, '2023-06-02 06:00:00', '2023-06-01 09:26:59', '100.00', '100.00'),
(78, '2023-06-02 06:00:00', '2023-06-01 09:28:41', '100.00', '100.00'),
(79, '2023-06-02 06:00:00', '2023-06-01 09:29:08', '100.00', '100.00'),
(80, '2023-06-02 06:00:00', '2023-06-01 09:29:32', '100.00', '100.00'),
(81, '2023-06-02 06:00:00', '2023-06-01 09:29:54', '100.00', '100.00'),
(82, '2023-06-02 06:00:00', '2023-06-01 09:31:44', '100.00', '100.00'),
(83, '2023-06-02 06:00:00', '2023-06-01 09:32:53', '100.00', '100.00'),
(84, '2023-06-02 06:00:00', '2023-06-01 09:33:54', '100.00', '100.00'),
(85, '2023-06-02 06:00:00', '2023-06-01 09:34:55', '100.00', '100.00'),
(86, '2023-06-02 06:00:00', '2023-06-02 07:06:18', '100.00', '121.00'),
(87, '2023-06-03 07:00:00', '2023-06-04 22:30:26', '100.00', '100.00'),
(88, '2023-06-05 07:00:00', '2023-06-08 18:02:13', '100.00', '163.00'),
(89, '2023-06-09 07:00:00', '2023-06-08 18:04:15', '100.00', '100.00'),
(90, '2023-06-09 07:00:00', '2023-06-08 19:18:25', '100.00', '100.00'),
(91, '2023-06-09 07:00:00', '2023-06-08 19:18:40', '100.00', '100.00'),
(92, '2023-06-09 07:00:00', '2023-06-08 19:19:24', '100.00', '100.00'),
(93, '2023-06-09 07:00:00', '2023-06-08 19:20:48', '100.00', '100.00'),
(94, '2023-06-09 07:00:00', '2023-06-08 19:22:00', '100.00', '100.00'),
(95, '2023-06-09 07:00:00', '2023-06-08 19:22:45', '100.00', '100.00'),
(96, '2023-06-09 07:00:00', '2023-06-08 19:25:31', '100.00', '100.00'),
(97, '2023-06-09 07:00:00', '2023-06-08 19:25:58', '100.00', '100.00'),
(98, '2023-06-09 07:00:00', '2023-06-08 19:26:45', '100.00', '100.00'),
(99, '2023-06-09 07:00:00', '2023-06-08 19:27:03', '100.00', '100.00'),
(100, '2023-06-09 07:00:00', '2023-06-08 19:28:11', '100.00', '100.00'),
(101, '2023-06-09 07:00:00', '2023-06-08 19:28:33', '100.00', '100.00'),
(102, '2023-06-09 07:00:00', '2023-06-08 19:28:53', '100.00', '100.00'),
(103, '2023-06-09 07:00:00', '2023-06-08 19:29:12', '100.00', '100.00'),
(104, '2023-06-09 07:00:00', '2023-06-08 19:30:19', '100.00', '100.00'),
(105, '2023-06-09 07:00:00', '2023-06-08 19:34:01', '100.00', '100.00'),
(106, '2023-06-09 07:00:00', '2023-06-08 19:34:40', '100.00', '100.00'),
(107, '2023-06-09 07:00:00', '2023-06-08 19:55:54', '100.00', '100.00'),
(108, '2023-06-09 07:00:00', '2023-06-08 20:12:46', '100.00', '100.00'),
(109, '2023-06-09 07:00:00', '2023-06-12 18:51:11', '100.00', '100.00'),
(110, '2023-06-13 07:00:00', '2023-06-12 19:50:54', '100.00', '100.00'),
(111, '2023-06-13 07:00:00', NULL, '100.00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boxs_movements`
--

DROP TABLE IF EXISTS `boxs_movements`;
CREATE TABLE IF NOT EXISTS `boxs_movements` (
  `id_movimiento` int NOT NULL AUTO_INCREMENT,
  `cantidad` decimal(6,2) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_caja` int NOT NULL,
  PRIMARY KEY (`id_movimiento`),
  KEY `fk_caja_movimiento` (`id_caja`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `boxs_movements`
--

INSERT INTO `boxs_movements` (`id_movimiento`, `cantidad`, `tipo`, `descripcion`, `id_caja`) VALUES
(30, '21.00', 0, 'trenza suiza: k', 57),
(31, '21.00', 0, 'trenza suiza: k', 57),
(32, '21.00', 0, 'trenza suiza: k', 58),
(33, '21.00', 0, 'trenza suiza: k', 59),
(34, '21.00', 0, 'trenza suiza: k', 60),
(35, '21.00', 0, 'trenza suiza: k', 60),
(36, '21.00', 0, 'trenza suiza: k', 60),
(37, '21.00', 0, 'trenza suiza: k', 60),
(38, '21.00', 0, 'trenza suiza: k', 60),
(39, '21.00', 0, 'trenza suiza: k', 60),
(40, '21.00', 0, 'trenza suiza: k', 60),
(41, '21.00', 0, 'trenza suiza: k', 57),
(42, '21.00', 0, 'trenza suiza: k', 60),
(43, '21.00', 0, 'trenza suiza: k', 60),
(44, '21.00', 0, 'trenza suiza: k', 60),
(45, '21.00', 0, 'trenza suiza: k', 61),
(46, '21.00', 0, 'trenza suiza: k', 86),
(47, '21.00', 0, 'trenza suiza: k', 88),
(48, '21.00', 0, 'trenza suiza: k', 88),
(49, '21.00', 0, 'trenza suiza: k', 88);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cliente_correo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `cliente_correo` (`cliente_correo`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id_cliente`, `nombre`, `apellido`, `telefono`, `cliente_correo`) VALUES
(44, 'david', 'herrera', '635013240', 'herreracostadavid@gmail.com'),
(45, 'david2', 'herrera2', '635013242', 'herreracostadavid2@gmail.com'),
(46, 'fdawdaw', 'dawdadaw', '635013240', 'dwadawd@gmail.com'),
(47, 'david5', 'herrera5', '635013245', 'herreracostadavid5@gmail.com'),
(48, 'david4', 'herrera4', '635013240', 'herreracostadavid4@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla ` debts`
--

DROP TABLE IF EXISTS ` debts`;
CREATE TABLE IF NOT EXISTS ` debts` (
  `id_deuda` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` double NOT NULL,
  `id_peluquero` int NOT NULL,
  PRIMARY KEY (`id_deuda`),
  KEY `fk_deuda_peluquero` (`id_peluquero`),
  KEY `fk_deuda_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hairdressers`
--

DROP TABLE IF EXISTS `hairdressers`;
CREATE TABLE IF NOT EXISTS `hairdressers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `correo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `hairdressers`
--

INSERT INTO `hairdressers` (`id`, `nombre`, `apellido`, `telefono`, `correo`) VALUES
(10, 'fran', 'cesco', '5325325323', 'fran@gmail.com'),
(16, 'da', 'davvo', '24525232', 'ds@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hairdressers_admin`
--

DROP TABLE IF EXISTS `hairdressers_admin`;
CREATE TABLE IF NOT EXISTS `hairdressers_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `correo` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`correo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `hairdressers_admin`
--

INSERT INTO `hairdressers_admin` (`id`, `username`, `correo`, `nombre`, `password`) VALUES
(1, 'david', 'david@gmail.com', 'david', 'b2c25679714e4b0be0477d60f6db5a50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hairdressers_schedule`
--

DROP TABLE IF EXISTS `hairdressers_schedule`;
CREATE TABLE IF NOT EXISTS `hairdressers_schedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_peluquero` int NOT NULL,
  `id_dia` tinyint(1) NOT NULL,
  `desde_hora` time NOT NULL,
  `hasta_hora` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_peluquero_horario` (`id_peluquero`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `hairdressers_schedule`
--

INSERT INTO `hairdressers_schedule` (`id`, `id_peluquero`, `id_dia`, `desde_hora`, `hasta_hora`) VALUES
(82, 10, 1, '09:00:00', '18:00:00'),
(83, 10, 2, '09:00:00', '18:00:00'),
(84, 10, 3, '10:00:00', '18:00:00'),
(85, 10, 4, '09:00:00', '18:00:00'),
(86, 10, 5, '09:00:00', '18:00:00'),
(87, 10, 6, '08:00:00', '18:00:00'),
(92, 16, 1, '10:00:00', '18:00:00'),
(93, 16, 2, '09:00:00', '18:00:00'),
(94, 16, 3, '09:00:00', '18:00:00'),
(95, 16, 4, '11:00:00', '18:00:00'),
(96, 16, 5, '10:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `precio` double NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `precio`, `nombre`, `descripcion`, `stock`) VALUES
(1, 15, 'peine', 'peine para cabellos duros', 1),
(2, 5, 'secador', 'secador profesional alta potenciak', 6),
(5, 3, 'gel', 'gel pelo', 0),
(6, 5, 'champu', 'champu pelo', 5),
(8, 1, 'laca', 'laca pelo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `id_producto` int NOT NULL,
  `fecha` timestamp NOT NULL,
  `pago` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idproducto` (`id_producto`),
  KEY `idcliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `purchases`
--

INSERT INTO `purchases` (`id`, `id_cliente`, `id_producto`, `fecha`, `pago`) VALUES
(10, 44, 1, '2023-06-02 21:45:00', 15),
(11, 44, 2, '2023-06-02 21:46:00', 10),
(12, 44, 1, '2023-06-02 21:47:00', 15),
(13, 44, 2, '2023-06-02 21:49:00', 10),
(14, 47, 2, '2023-06-02 21:54:00', 10),
(15, 48, 1, '2023-06-02 21:56:00', 15),
(16, 44, 1, '2023-06-02 21:56:00', 15),
(17, 48, 5, '2023-06-04 22:06:00', 3),
(18, 45, 5, '2023-06-04 22:06:00', 3),
(19, 45, 5, '2023-06-04 22:07:00', 3),
(20, 44, 5, '2023-06-04 22:20:00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `duracion` int NOT NULL,
  `id_categoria` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_services_category` (`id_categoria`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id`, `nombre`, `descripcion`, `precio`, `duracion`, `id_categoria`) VALUES
(24, 'trenza suiza', 'k', '21.00', 28, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_category`
--

DROP TABLE IF EXISTS `services_category`;
CREATE TABLE IF NOT EXISTS `services_category` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `services_category`
--

INSERT INTO `services_category` (`id_categoria`, `nombre_categoria`) VALUES
(12, 'sincategorizar'),
(21, 'p');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_reserved`
--

DROP TABLE IF EXISTS `services_reserved`;
CREATE TABLE IF NOT EXISTS `services_reserved` (
  `id_cita` int NOT NULL,
  `id_servicio` int NOT NULL,
  PRIMARY KEY (`id_cita`,`id_servicio`),
  KEY `FK_servicesreserved_service` (`id_servicio`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `services_reserved`
--

INSERT INTO `services_reserved` (`id_cita`, `id_servicio`) VALUES
(68, 24),
(69, 24),
(70, 24),
(71, 24),
(73, 24),
(74, 24),
(75, 24);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_cita_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clients` (`id_cliente`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_cita_peluquero` FOREIGN KEY (`id_peluquero`) REFERENCES `hairdressers` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `boxs_movements`
--
ALTER TABLE `boxs_movements`
  ADD CONSTRAINT `fk_caja_movimiento` FOREIGN KEY (`id_caja`) REFERENCES `boxs` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla ` debts`
--
ALTER TABLE ` debts`
  ADD CONSTRAINT `fk_deuda_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clients` (`id_cliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_deuda_peluquero` FOREIGN KEY (`id_peluquero`) REFERENCES `hairdressers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `hairdressers_schedule`
--
ALTER TABLE `hairdressers_schedule`
  ADD CONSTRAINT `fk_hairdressers` FOREIGN KEY (`id_peluquero`) REFERENCES `hairdressers` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `FK_services_category` FOREIGN KEY (`id_categoria`) REFERENCES `services_category` (`id_categoria`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `services_reserved`
--
ALTER TABLE `services_reserved`
  ADD CONSTRAINT `FK_appointment` FOREIGN KEY (`id_cita`) REFERENCES `appointments` (`id_cita`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_servicesreserved_appointment` FOREIGN KEY (`id_cita`) REFERENCES `appointments` (`id_cita`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_servicesreserved_services` FOREIGN KEY (`id_servicio`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
