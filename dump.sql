-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Servidor: sql308.byetcluster.com
-- Tiempo de generación: 08-05-2018 a las 07:00:06
-- Versión del servidor: 5.6.35-81.0
-- Versión de PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `epiz_22051112_v3enraya`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movida`
--

CREATE TABLE IF NOT EXISTS `movida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jugador` int(11) NOT NULL,
  `celda` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `id_partida` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_movida_partida` (`id_partida`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=68 ;

--
-- Volcado de datos para la tabla `movida`
--

INSERT INTO `movida` (`id`, `jugador`, `celda`, `id_partida`) VALUES
(10, 2, '1-2', 11),
(9, 1, '1-3', 11),
(8, 2, '2-2', 11),
(7, 1, '1-1', 11),
(6, 2, '1-1', 10),
(11, 1, '1-1', 12),
(12, 1, '1-1', 13),
(13, 1, '1-1', 14),
(14, 1, '1-1', 15),
(15, 1, '1-1', 16),
(16, 1, '1-1', 17),
(17, 1, '1-1', 18),
(18, 1, '1-1', 19),
(19, 1, '1-1', 20),
(20, 1, '1-1', 21),
(21, 1, '1-1', 22),
(22, 1, '1-1', 23),
(23, 1, '1-1', 24),
(24, 1, '1-1', 25),
(25, 1, '1-1', 26),
(26, 1, '1-1', 27),
(27, 1, '1-1', 28),
(28, 2, '1-2', 28),
(29, 2, '1-2', 28),
(30, 1, '2-2', 28),
(31, 2, '1-3', 28),
(32, 1, '3-3', 28),
(33, 1, '1-1', 29),
(34, 2, '2-2', 29),
(35, 1, '1-3', 29),
(36, 2, '3-2', 29),
(37, 1, '1-2', 29),
(38, 1, '1-1', 30),
(39, 2, '1-2', 30),
(40, 1, '1-3', 30),
(41, 2, '2-2', 30),
(42, 1, '3-3', 30),
(43, 2, '3-2', 30),
(44, 1, '1-1', 31),
(45, 2, '2-2', 31),
(46, 1, '1-3', 31),
(47, 2, '3-2', 31),
(48, 1, '2-2', 32),
(49, 2, '1-3', 32),
(50, 1, '3-1', 32),
(51, 2, '1-1', 32),
(52, 1, '2-2', 33),
(53, 2, '1-3', 33),
(54, 1, '3-1', 33),
(55, 1, '1-2', 32),
(56, 2, '2-3', 32),
(57, 1, '3-2', 32),
(58, 1, '1-1', 34),
(59, 2, '1-2', 34),
(60, 1, '2-2', 34),
(61, 2, '2-3', 34),
(62, 1, '3-3', 34),
(63, 1, '1-1', 35),
(64, 2, '2-2', 35),
(65, 1, '1-3', 35),
(66, 2, '3-2', 35),
(67, 1, '1-2', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE IF NOT EXISTS `partida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `jugador` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `estado`, `jugador`) VALUES
(35, 'C', 2),
(34, 'C', 2),
(33, 'I', 2),
(32, 'C', 2),
(31, 'I', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
