-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2021 a las 17:31:36
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `concesionario`
--
CREATE DATABASE IF NOT EXISTS `concesionario` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `concesionario`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coche`
--
DROP TABLE IF EXISTS `coche`;
CREATE TABLE `coche` (
  `idCoche` int(11) NOT NULL,
  `marca` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `coche`
--

INSERT INTO `coche` (`idCoche`, `marca`, `modelo`, `tipo`, `precio`) VALUES
(1, 'Volkswagen', 'Tiguan', 'Suv', 25000),
(2, 'Volkswagen', 'Passat', 'Familiar', 30000),
(3, 'Seat', 'Ibiza', 'Berlina', 18500),
(4, 'Seat', 'Cordoba', 'Berlina', 20000),
(5, 'Audi', 'Q7', 'Suv', 40000),
(6, 'Audi', 'A4', 'Familiar', 35000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--
DROP TABLE IF EXISTS `color`;
CREATE TABLE `color` (
  `idColor` int(11) NOT NULL,
  `color` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `hexadecimal` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`idColor`, `color`, `hexadecimal`) VALUES
(1, 'Azul', '#336DFF'),
(2, 'Rojo', '#FF5733'),
(3, 'Verde', '#36FF33'),
(4, 'Amarillo', '#EFFF33'),
(5, 'Metalico', '#90928A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disenio`
--
DROP TABLE IF EXISTS `disenio`;
CREATE TABLE `disenio` (
  `idDisenio` int(11) NOT NULL,
  `acabado` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `llantas` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `asientos` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `parrilla` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `disenio`
--

INSERT INTO `disenio` (`idDisenio`, `acabado`, `llantas`, `asientos`, `parrilla`, `precio`) VALUES
(1, 'Deportivo (R-Line)', '19', 'Cuero', 'Cromada', 8000),
(2, 'Base (Active)', '17', 'Tela', 'Negro', 4000),
(3, 'Intermedio (Ambition)', '18', 'Tela', 'Negro', 6000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--
DROP TABLE IF EXISTS `factura`;
CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `idUsuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idCoche` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idMotor` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idDisenio` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idGarantia` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idColor` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `precioFinal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `idUsuario`, `idCoche`, `idMotor`, `idDisenio`, `idGarantia`, `idColor`, `fecha`, `precioFinal`) VALUES
(1, '1', '2', '2', '2', '1', '4', '2021-01-02', 32000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `garantia`
--
DROP TABLE IF EXISTS `garantia`;
CREATE TABLE `garantia` (
  `idGarantia` int(11) NOT NULL,
  `anios` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `kilometraje` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `garantia`
--

INSERT INTO `garantia` (`idGarantia`, `anios`, `kilometraje`, `precio`) VALUES
(1, '3 años', '50000', 405),
(2, '4 años', '120000', 1135);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motor`
--
DROP TABLE IF EXISTS `motor`;
CREATE TABLE `motor` (
  `idMotor` int(11) NOT NULL,
  `potencia` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `combustible` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cilindrada` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `consumo` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `co2` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cajaCambio` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `motor`
--

INSERT INTO `motor` (`idMotor`, `potencia`, `combustible`, `cilindrada`, `consumo`, `co2`, `cajaCambio`, `precio`) VALUES
(1, '150', 'Gasolina', '1500', '5.8', '132', 'Automático', 5000),
(2, '150', 'Diesel', '2000', '4.5', '138', 'Manual', 4500),
(3, '170', 'Diesel', '2500', '4.9', '153', 'Automatico', 5200),
(4, '190', 'Gasolina', '3000', '5.4', '172', 'Automatico', 5800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `tipo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contrasenna` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigoCookie` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `tipo`, `nombre`, `apellido`, `usuario`, `contrasenna`,`codigoCookie`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'Admin', 'Admin',NULL),
(2, 'Cliente', 'Marti', 'Stefanov', 'marti', 'marti',NULL),
(3, 'Cliente', 'David', 'Gallego', 'david', 'david',NULL),
(4, 'Cliente', 'Alejandro', 'Gomez', 'alejandro', 'alejandro',NULL),
(5, 'Cliente', 'Mario', 'Garcia', 'mario', 'mario',NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `coche`
--
ALTER TABLE `coche`
  ADD PRIMARY KEY (`idCoche`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`idColor`);

--
-- Indices de la tabla `disenio`
--
ALTER TABLE `disenio`
  ADD PRIMARY KEY (`idDisenio`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`);

--
-- Indices de la tabla `garantia`
--
ALTER TABLE `garantia`
  ADD PRIMARY KEY (`idGarantia`);

--
-- Indices de la tabla `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`idMotor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `coche`
--
ALTER TABLE `coche`
  MODIFY `idCoche` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `idColor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `disenio`
--
ALTER TABLE `disenio`
  MODIFY `idDisenio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `garantia`
--
ALTER TABLE `garantia`
  MODIFY `idGarantia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `motor`
--
ALTER TABLE `motor`
  MODIFY `idMotor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
