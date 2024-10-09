-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysqldb
-- Tiempo de generación: 09-10-2024 a las 14:00:30
-- Versión del servidor: 5.7.44
-- Versión de PHP: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `app4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE DATABASE IF NOT EXISTS `app4` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `app4`;

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`id`, `description`) VALUES
(1, 'TK-STAR'),
(2, 'TRACKTOK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `id_model` int(11) NOT NULL,
  `imei` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `devices`
--

INSERT INTO `devices` (`id`, `id_brand`, `id_model`, `imei`) VALUES
(3, 1, 2, '4012657811');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linked`
--

CREATE TABLE `linked` (
  `id` int(11) NOT NULL,
  `id_people` int(11) NOT NULL,
  `id_device` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `linked`
--

INSERT INTO `linked` (`id`, `id_people`, `id_device`) VALUES
(48, 77, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_brand` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `models`
--

INSERT INTO `models` (`id`, `description`, `id_brand`) VALUES
(1, 'TK-109', 1),
(2, 'CY06', 2),
(4, 'TK-110', 1),
(6, 'CY07', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `gender` char(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `addresses` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `rol_id` tinyint(4) NOT NULL DEFAULT '2',
  `id_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`id`, `name`, `last_name`, `dni`, `gender`, `email`, `pass`, `addresses`, `country`, `rol_id`, `id_status`, `created_at`) VALUES
(1, 'Root', 'Admin', '00000000', 'M', 'admin@mail.com', '$2y$10$DJOo2kHw.Y5ZSIdwCiaHUOr0RfkajjPTcv8XYedA1axXCLnYvwh.S', 'calle falsa 123', 'Argentina', 1, 1, '2024-07-17 00:00:01'),
(8, 'Mauro', 'Ramírez', '34037147', 'M', 'mauroaramirez88@gmail.com', '$2y$10$MU8rORay4mrbzvisRIQiaOIzvaijJKV3qqkhjgpaAH/wyA6j8FPAG', 'Balcarce 1490', 'Argentina', 2, 1, '2024-09-30 13:38:10'),
(77, 'Ttt', 'Ttt', '56546546', 'M', 'mauroaramirezasdasd88@gmail.com', '$2y$10$idnDrfTJEpiEB8Tx1mlU/.Zvza8DDKwZj1M/s7xsc26zkDsE63N8S', 'Balcarce 1490', 'Argentina', 2, 1, '2024-10-09 13:40:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` tinyint(4) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Roles de Socios';

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imei` (`imei`) USING BTREE,
  ADD KEY `fk_id_brand_idx` (`id_brand`) USING BTREE,
  ADD KEY `fk_id_model_idx` (`id_model`);

--
-- Indices de la tabla `linked`
--
ALTER TABLE `linked`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_people_idx` (`id_people`) USING BTREE,
  ADD KEY `fk_id_device_idx` (`id_device`) USING BTREE,
  ADD KEY `fk_id_linked_idx` (`id`);

--
-- Indices de la tabla `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion` (`description`),
  ADD KEY `id_marca` (`id_brand`);

--
-- Indices de la tabla `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_rol_id_idx` (`rol_id`),
  ADD KEY `fk_id_status_idx` (`id_status`),
  ADD KEY `fk_id_idx` (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `linked`
--
ALTER TABLE `linked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_ibfk_1` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `devices_ibfk_2` FOREIGN KEY (`id_model`) REFERENCES `models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_ibfk_1` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`id`) REFERENCES `people` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
