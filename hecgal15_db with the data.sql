-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-05-2016 a las 23:55:59
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hecgal15_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DEVICES`
--

CREATE TABLE `DEVICES` (
  `ID_DEVICE` int(11) NOT NULL,
  `NAME` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `DEVICES`
--

INSERT INTO `DEVICES` (`ID_DEVICE`, `NAME`) VALUES
(9, 'AC'),
(17, 'Car'),
(4, 'Door'),
(16, 'Fire Alarm'),
(7, 'Heater'),
(3, 'Humidity'),
(5, 'Lamp'),
(10, 'Lights'),
(2, 'Motion'),
(6, 'Oven'),
(14, 'PC'),
(15, 'Pressure'),
(13, 'PS4'),
(1, 'Temperature'),
(8, 'TV'),
(11, 'Window'),
(12, 'Xbox');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DEVICE_LOCATOR`
--

CREATE TABLE `DEVICE_LOCATOR` (
  `ID` int(11) NOT NULL,
  `ID_DEVICE` int(11) NOT NULL,
  `ID_ROOM` int(11) NOT NULL,
  `DESCRIPTION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `DEVICE_LOCATOR`
--

INSERT INTO `DEVICE_LOCATOR` (`ID`, `ID_DEVICE`, `ID_ROOM`, `DESCRIPTION`) VALUES
(1, 1, 1, 'Garage Temperature Sensor'),
(2, 2, 1, 'Garage Motion Sensor'),
(3, 3, 1, 'Garage Humidity Sensor'),
(4, 4, 1, 'Garage Door Sensor'),
(5, 1, 2, 'Kitchen Temperature Sensor'),
(6, 2, 2, 'Kitchen Motion Sensor'),
(7, 3, 2, 'Kitchen Humidity Sensor'),
(8, 4, 2, 'Kitchen Door Sensor'),
(9, 5, 2, 'Kitchen Lamp'),
(10, 1, 3, 'Living Room Temperature Sensor'),
(11, 2, 3, 'Living Room Motion Sensor'),
(12, 3, 3, 'Living Room Humidity Sensor'),
(13, 10, 1, 'Garage Lights'),
(14, 16, 1, 'Fire Alarm'),
(15, 17, 1, 'Car Sensor'),
(16, 6, 2, 'Kitchen Oven'),
(17, 7, 2, 'Kitchen Heater'),
(18, 9, 2, 'Kitchen AC'),
(19, 10, 2, 'Kitchen Lights'),
(20, 11, 2, 'Kitchen Window'),
(21, 15, 2, 'Kitchen Pressure Sensor'),
(22, 16, 2, 'Kitchen Fire Alarm'),
(23, 5, 3, 'Living Room First Lamp'),
(24, 5, 3, 'Living Room Second Lamp'),
(25, 7, 3, 'Living Room Heater'),
(26, 8, 3, 'Living Room TV'),
(27, 9, 3, 'Living Room AC'),
(28, 11, 3, 'Living Room Window'),
(29, 15, 3, 'Living Room Pressure Sensor'),
(30, 16, 3, 'Living Room Fire Alarm'),
(31, 1, 4, 'Hall Temperature Sensor'),
(32, 2, 4, 'Hall Motion Sensor'),
(33, 3, 4, 'Hall Humidity Sensor'),
(34, 4, 4, 'Hall Main Door'),
(35, 7, 4, 'Hall Heater'),
(36, 10, 4, 'Hall Lights'),
(37, 9, 4, 'Hall AC'),
(38, 15, 4, 'Hall Pressure Sensor'),
(39, 16, 4, 'Hall Fire Alarm'),
(40, 1, 5, 'Bedroom Temperature Sensor'),
(41, 2, 5, 'Bedroom Motion Sensor'),
(42, 3, 5, 'Bedroom Humidity Sensor'),
(43, 4, 5, 'Bedroom Door'),
(44, 5, 5, 'Bedroom Right Lamp'),
(45, 5, 5, 'Bedroom Left Lamp'),
(46, 7, 5, 'Bedroom Heater'),
(47, 8, 5, 'Bedroom TV'),
(48, 9, 5, 'Bedroom AC'),
(49, 10, 5, 'Bedroom Lights'),
(50, 11, 5, 'Bedroom Window'),
(51, 14, 5, 'Bedroom PC'),
(52, 15, 5, 'Bedroom Pressure Sensor'),
(53, 16, 5, 'Bedroom Fire Alarm'),
(54, 1, 6, 'Playroom Temperature Sensor'),
(55, 2, 6, 'Playroom Motion Sensor'),
(56, 3, 6, 'Playroom Humidity Sensor'),
(57, 4, 6, 'Playroom Door'),
(58, 7, 6, 'Playroom Heater'),
(59, 8, 6, 'Playroom TV'),
(60, 9, 6, 'Playroom AC'),
(61, 10, 6, 'Playroom Lights'),
(62, 11, 6, 'Playroom Window'),
(63, 12, 6, 'Playroom Xbox'),
(64, 13, 6, 'Playroom PS4'),
(65, 15, 6, 'Playroom Pressure Sensor'),
(66, 16, 6, 'Playroom Fire Alarm'),
(67, 1, 7, 'Bathroom Temperature Sensor'),
(68, 2, 7, 'Bathroom Motion Sensor'),
(69, 3, 7, 'Bathroom Humidity Sensor'),
(70, 4, 7, 'Bathroom Door'),
(71, 7, 7, 'Bathroom Heater'),
(72, 10, 7, 'Bathroom Lights'),
(73, 11, 7, 'Bathroom Window'),
(74, 15, 7, 'Bathroom Pressure Sensor'),
(75, 16, 7, 'Bathroom Fire Alarm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DEVICE_STATUS`
--

CREATE TABLE `DEVICE_STATUS` (
  `ID` int(11) NOT NULL,
  `STATUS` varchar(10) NOT NULL,
  `EVENT_TIMER` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `DEVICE_STATUS`
--

INSERT INTO `DEVICE_STATUS` (`ID`, `STATUS`, `EVENT_TIMER`) VALUES
(1, '23', '2016-05-17 19:07:26'),
(5, '22', '2016-05-17 19:07:26'),
(10, '24', '2016-05-17 19:07:26'),
(31, '23', '2016-05-17 19:07:26'),
(40, '22', '2016-05-17 19:07:26'),
(54, '25', '2016-05-17 19:07:26'),
(67, '24', '2016-05-17 19:07:26'),
(2, '0', '2016-05-17 19:07:26'),
(6, '1', '2016-05-17 19:07:26'),
(11, '0', '2016-05-17 19:07:26'),
(32, '1', '2016-05-17 19:07:26'),
(41, '0', '2016-05-17 19:07:26'),
(55, '0', '2016-05-17 19:07:26'),
(68, '1', '2016-05-17 19:07:26'),
(3, '11', '2016-05-17 19:07:26'),
(7, '12', '2016-05-17 19:07:26'),
(12, '10', '2016-05-17 19:07:26'),
(33, '9', '2016-05-17 19:07:26'),
(42, '7', '2016-05-17 19:07:26'),
(56, '8', '2016-05-17 19:07:26'),
(69, '34', '2016-05-17 19:07:26'),
(4, '1', '2016-05-17 19:07:26'),
(8, '0', '2016-05-17 19:07:26'),
(34, '0', '2016-05-17 19:07:26'),
(43, '0', '2016-05-17 19:07:26'),
(57, '1', '2016-05-17 19:07:26'),
(70, '0', '2016-05-17 19:07:26'),
(9, '0', '2016-05-17 19:07:26'),
(23, '0', '2016-05-17 19:07:26'),
(24, '1', '2016-05-17 19:07:26'),
(44, '0', '2016-05-17 19:07:26'),
(45, '0', '2016-05-17 19:07:26'),
(16, '0', '2016-05-17 19:07:26'),
(17, '0', '2016-05-17 19:08:37'),
(25, '0', '2016-05-17 19:08:37'),
(35, '0', '2016-05-17 19:08:37'),
(46, '0', '2016-05-17 19:08:37'),
(58, '0', '2016-05-17 19:08:37'),
(71, '0', '2016-05-17 19:08:37'),
(26, '0', '2016-05-17 19:10:55'),
(47, '0', '2016-05-17 19:10:55'),
(59, '0', '2016-05-17 19:10:55'),
(18, '1', '2016-05-17 19:10:55'),
(27, '1', '2016-05-17 19:10:55'),
(37, '0', '2016-05-17 19:10:55'),
(48, '1', '2016-05-17 19:10:55'),
(60, '1', '2016-05-17 19:10:55'),
(13, '0', '2016-05-17 19:10:55'),
(19, '1', '2016-05-17 19:10:55'),
(36, '0', '2016-05-17 19:10:55'),
(49, '0', '2016-05-17 19:10:55'),
(61, '1', '2016-05-17 19:10:55'),
(72, '0', '2016-05-17 19:10:55'),
(20, '0', '2016-05-17 19:10:55'),
(28, '0', '2016-05-17 19:10:55'),
(50, '0', '2016-05-17 19:10:55'),
(62, '1', '2016-05-17 19:10:55'),
(73, '0', '2016-05-17 19:10:55'),
(63, '0', '2016-05-17 19:10:55'),
(63, '1', '2016-05-17 19:20:13'),
(64, '0', '2016-05-17 19:20:13'),
(51, '1', '2016-05-17 19:20:13'),
(38, '0.97', '2016-05-17 19:20:13'),
(52, '0.98', '2016-05-17 19:20:13'),
(65, '0.99', '2016-05-17 19:20:13'),
(74, '0.98', '2016-05-17 19:20:13'),
(21, '0.99', '2016-05-17 19:20:13'),
(29, '0.97', '2016-05-17 19:20:13'),
(14, '0', '2016-05-17 19:20:13'),
(22, '0', '2016-05-17 19:20:13'),
(30, '0', '2016-05-17 19:20:13'),
(39, '0', '2016-05-17 19:20:13'),
(53, '0', '2016-05-17 19:20:13'),
(66, '0', '2016-05-17 19:20:13'),
(75, '0', '2016-05-17 19:20:13'),
(15, '0', '2016-05-17 19:20:13'),
(4, '1', '2016-05-17 20:48:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ROOMS`
--

CREATE TABLE `ROOMS` (
  `ID_ROOM` int(11) NOT NULL,
  `NAME` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ROOMS`
--

INSERT INTO `ROOMS` (`ID_ROOM`, `NAME`) VALUES
(1, 'Garage'),
(2, 'Kitchen'),
(3, 'Living Room'),
(4, 'Hall'),
(5, 'Bedroom'),
(6, 'Playroom'),
(7, 'Bathroom');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USERS`
--

CREATE TABLE `USERS` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `USERS`
--

INSERT INTO `USERS` (`ID_USER`, `USERNAME`, `PASSWORD`) VALUES
(1, 'hec', '1234'),
(2, 'hect', '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `DEVICES`
--
ALTER TABLE `DEVICES`
  ADD PRIMARY KEY (`ID_DEVICE`),
  ADD UNIQUE KEY `NAME` (`NAME`);

--
-- Indices de la tabla `DEVICE_LOCATOR`
--
ALTER TABLE `DEVICE_LOCATOR`
  ADD PRIMARY KEY (`ID`,`ID_DEVICE`,`ID_ROOM`),
  ADD KEY `ID_DEVICE` (`ID_DEVICE`),
  ADD KEY `ID_ROOM` (`ID_ROOM`);

--
-- Indices de la tabla `ROOMS`
--
ALTER TABLE `ROOMS`
  ADD PRIMARY KEY (`ID_ROOM`);

--
-- Indices de la tabla `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`ID_USER`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `DEVICES`
--
ALTER TABLE `DEVICES`
  MODIFY `ID_DEVICE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `DEVICE_LOCATOR`
--
ALTER TABLE `DEVICE_LOCATOR`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT de la tabla `ROOMS`
--
ALTER TABLE `ROOMS`
  MODIFY `ID_ROOM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `USERS`
--
ALTER TABLE `USERS`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `DEVICE_LOCATOR`
--
ALTER TABLE `DEVICE_LOCATOR`
  ADD CONSTRAINT `device_locator_ibfk_1` FOREIGN KEY (`ID_DEVICE`) REFERENCES `DEVICES` (`ID_DEVICE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `device_locator_ibfk_2` FOREIGN KEY (`ID_ROOM`) REFERENCES `ROOMS` (`ID_ROOM`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
