-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2023 a las 15:18:38
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sofia_ruleta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_premiado`
--

CREATE TABLE `cliente_premiado` (
  `ID_CLIENTE_PREMIEADO` int(11) NOT NULL,
  `NOMBRES` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `APELLIDOS` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `CARNET_IDENTIDAD` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `TELEFONO` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `CIUDAD` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `FECHA_NACIMIENTO` datetime DEFAULT NULL,
  `NRO_TICKET` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ID_MERCADO` int(11) DEFAULT NULL,
  `ID_PREMIO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mercado`
--

CREATE TABLE `mercado` (
  `ID_MERCADO` int(11) NOT NULL,
  `NOMBRE` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `CIUDAD` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `DIRECCION` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `USER_CREACION` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premio`
--

CREATE TABLE `premio` (
  `ID_PREMIO` int(11) NOT NULL,
  `NOMBRE` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ESTADO` varchar(1) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `CANTIDAD_MAX_SALIDAS` int(8) DEFAULT NULL,
  `CANTIDAD_ENTREGADO_DIARIO` int(8) DEFAULT NULL,
  `USER_CREACION` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `premio`
--

INSERT INTO `premio` (`ID_PREMIO`, `NOMBRE`, `ESTADO`, `CANTIDAD_MAX_SALIDAS`, `CANTIDAD_ENTREGADO_DIARIO`, `USER_CREACION`, `FECHA_CREACION`) VALUES
(1, 'Mortadela de 500 grs', 'H', 10, 0, 'calderonpa', '2023-05-05 01:03:17'),
(2, 'Pate de 100 grs', 'H', 30, 0, 'calderonpa', '2023-05-05 01:04:01'),
(3, 'Parrillada Dismac', 'H', 1, 0, 'calderonpa', '2023-05-05 01:04:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOMBRE_USUARIO` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `NOMBRES` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `APELLIDOS` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `TELEFONO` int(8) DEFAULT NULL,
  `CIUDAD` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ESTADO` varchar(1) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `USER_CREACION` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente_premiado`
--
ALTER TABLE `cliente_premiado`
  ADD PRIMARY KEY (`ID_CLIENTE_PREMIEADO`);

--
-- Indices de la tabla `mercado`
--
ALTER TABLE `mercado`
  ADD PRIMARY KEY (`ID_MERCADO`);

--
-- Indices de la tabla `premio`
--
ALTER TABLE `premio`
  ADD PRIMARY KEY (`ID_PREMIO`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mercado`
--
ALTER TABLE `mercado`
  MODIFY `ID_MERCADO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `premio`
--
ALTER TABLE `premio`
  MODIFY `ID_PREMIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
