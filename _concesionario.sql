-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2020 at 05:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `concesionario`
--
CREATE DATABASE IF NOT EXISTS `concesionario` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `concesionario`;

-- --------------------------------------------------------

--
-- Table structure for table `coche`
--

DROP TABLE IF EXISTS `coche`;
CREATE TABLE IF NOT EXISTS `coche` (
  `idCoche` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL,
  PRIMARY KEY (`idCoche`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coche`
--

INSERT INTO `coche` (`idCoche`, `marca`, `modelo`, `tipo`, `precio`) VALUES
(1, 'Volkswagen', 'Tiguan', 'Suv', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

DROP TABLE IF EXISTS `motor`;
CREATE TABLE IF NOT EXISTS `motor` (
  `idMotor` int(11) NOT NULL AUTO_INCREMENT,
  `potencia` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `combustible` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cilindrada` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `consumo` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `co2` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cajaCambio` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL,
  PRIMARY KEY (`idMotor`)

) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `motor`
--

INSERT INTO `motor` (`idMotor`, `potencia`, `combustible`, `cilindrada`, `consumo`, `co2`, `cajaCambio`, `precio`) VALUES
(1, '150', 'Gasolina', '1500', '5.8', '132', 'Automático', 5000 );


-- --------------------------------------------------------

--
-- Table structure for table `garantia`
--

DROP TABLE IF EXISTS `garantia`;
CREATE TABLE IF NOT EXISTS `garantia` (
  `idGarantia` int(11) NOT NULL AUTO_INCREMENT,
  `anios` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `kilometraje` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL,
  PRIMARY KEY (`idGarantia`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `garantia`
--

INSERT INTO `garantia` (`idGarantia`, `anios`, `kilometraje`, `precio`) VALUES
(1, '3 años', '50000', 405);

-- --------------------------------------------------------

--
-- Table structure for table `disenio`
--

DROP TABLE IF EXISTS `disenio`;
CREATE TABLE IF NOT EXISTS `disenio` (
  `idDisenio` int(11) NOT NULL AUTO_INCREMENT,
  `acabado` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `llantas` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `asientos` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `parrilla` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL,
  PRIMARY KEY (`idDisenio`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disenio`
--

INSERT INTO `disenio` (`idDisenio`, `acabado`, `llantas`, `asientos`, `parrilla`, `precio`) VALUES
(1, 'Deportivo (R Line)', '19', 'Cuero', 'Cromada', 8000);

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `idFactura` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idCoche` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idMotor` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idDisenio` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idGarantia` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idColor` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date,
  `precioFinal` int(11) NOT NULL,
  PRIMARY KEY (`idFactura`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `factura`
--

INSERT INTO `factura` (`idFactura`, `idUsuario`, `idCoche`, `idMotor`, `idDisenio`, `idGarantia`, `idColor`, `fecha`, `precioFinal`) VALUES
(1, '1', '2', '2', '2', '1', '4', '2021-01-02', 32000);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
CREATE TABLE IF NOT EXISTS `color` (
  `idColor` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `hexadecimal` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idColor`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`idColor`, `color`, `hexadecimal`) VALUES
(1, 'Azul', '#336DFF');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contrasenna` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `tipo`, `nombre`, `apellido`, `usuario`, `contrasenna`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'Admin', 'Admin');

