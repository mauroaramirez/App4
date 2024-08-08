-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysqldb
-- Tiempo de generación: 28-06-2024 a las 19:43:23
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
-- Base de datos: `geo`
--

CREATE DATABASE IF NOT EXISTS `geo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `geo`;

CREATE TABLE `status` (
  `id`  int(11)  NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `status` (`id`, `description`) VALUES (NULL, 'activo');
INSERT INTO `status` (`id`, `description`) VALUES (NULL, 'inactivo');

CREATE TABLE `roles` (
  `id`  int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_roles_idx` (`id_status`),
  CONSTRAINT `fk_roles_id_status`
    FOREIGN KEY (`id_status`)
    REFERENCES `status` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `roles` (`id`, `description`, `id_status`) VALUES (NULL, 'admin', '1');
INSERT INTO `roles` (`id`, `description`, `id_status`) VALUES (NULL, 'titular', '1');

CREATE TABLE `users` (
  `id`  int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_status`  int(11) NOT NULL,
  PRIMARY KEY (`id`),
    KEY `fk_id_status_idx` (`id_status`),
  CONSTRAINT `fk_users_id_status`
    FOREIGN KEY (`id_status`)
    REFERENCES `status` (`id`),
  CONSTRAINT `fk_users_id_role`
    FOREIGN KEY (`id_role`)
    REFERENCES `roles` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `password`, `id_role`, `created_at`, `full_name`, `address`, `email`, `id_status`) VALUES (NULL, '123', '1', '2024-08-08', 'admin', 'falsa 123', 'admin@gmail.com', '1');

CREATE TABLE `emergency_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_emergency_contacts_idx` (`id_status`),
  CONSTRAINT `fk_emergency_contacts_id_status`
    FOREIGN KEY (`id_status`)
    REFERENCES `status` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `emergency_contacts` (`id`, `created_at`, `contact_name`, `contact_email`, `contact_phone`, `id_status`) VALUES (NULL, CURRENT_TIMESTAMP, 'pedro pedro pe', 'pedro@gmail.com', '1144557788', '1');

CREATE TABLE `user_emergency_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_emergency_contacts` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_emergency_contacts_idx` (`id_emergency_contacts`),
  KEY `fk_id_user_idx` (`id_user`),
  KEY `fk_user_emergency_contacts_idx` (`id_status`),
  CONSTRAINT `fk_user_emergency_contacts_id_emergency_contacts`
    FOREIGN KEY (`id_emergency_contacts`)
    REFERENCES `emergency_contacts` (`id`),
  CONSTRAINT `fk_user_emergency_contacts_id_user`
    FOREIGN KEY (`id_user`)
    REFERENCES `users` (`id`),
  CONSTRAINT `fk_user_emergency_contacts_id_status`
    FOREIGN KEY (`id_status`)
    REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user_emergency_contacts` (`id`, `id_user`, `id_emergency_contacts`, `id_status`) VALUES (NULL, '1', '1', '1');

CREATE TABLE `locations` (
  `id`  int(11) NOT NULL AUTO_INCREMENT,
  `id_user`  int(11) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `address` varchar(255) NOT NULL,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_user_idx` (`id_user`),
  KEY `fk_id_status_idx` (`id_status`),
  CONSTRAINT `fk_locations_user_id`
    FOREIGN KEY (`id_user`)
    REFERENCES `users` (`id`),
  CONSTRAINT `fk_locations_id_status`
    FOREIGN KEY (`id_status`)
    REFERENCES `status` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `locations` (`id`, `id_user`, `latitude`, `longitude`, `timestamp`, `address`, `id_status`) VALUES (NULL, '1', '2232133', '1312321', CURRENT_TIMESTAMP, 'falsa 123', '1');

CREATE TABLE `notifications` (
  `id`  int(11) NOT NULL AUTO_INCREMENT,
  `id_user`  int(11) NOT NULL,
  `notification_text` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_user_idx` (`id_user`),
  KEY `fk_notifications_idx` (`id_status`),
  CONSTRAINT `fk_notifications_user_id`
    FOREIGN KEY (`id_user`)
    REFERENCES `users` (`id`),
  CONSTRAINT `fk_notifications_id_status`
    FOREIGN KEY (`id_status`)
    REFERENCES `status` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `notifications` (`id`, `id_user`, `notification_text`, `timestamp`, `id_status`) VALUES (NULL, '1', 'mensaje de prueba', CURRENT_TIMESTAMP, '1');

CREATE TABLE `emergency_services` (
  `id`  int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `id_status`  int(11) NOT NULL,
  `id_locations`  int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_status_idx` (`id_status`),
  KEY `fk_id_locations_idx` (`id_locations`),
  CONSTRAINT `fk_emergency_services_id_status`
    FOREIGN KEY (`id_status`)
    REFERENCES `status` (`id`),
  CONSTRAINT `fk_emergency_services_id_locations`
    FOREIGN KEY (`id_locations`)
    REFERENCES `locations` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `emergency_services` (`id`, `service_name`, `latitude`, `longitude`, `address`, `id_status`, `id_locations`) VALUES (NULL, 'test', '54545564654', '456465465', 'falsa 123', '1', '1');

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_text` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_status_idx` (`id_status`),
  CONSTRAINT `fk_messages_id_status`
    FOREIGN KEY (`id_status`)
    REFERENCES `status` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `messages` (`id`, `message_text`, `timestamp`, `id_status`) VALUES (NULL, 'mensaje de prueba', CURRENT_TIMESTAMP, '1');

CREATE TABLE `emergency_alerts` (
  `id`  int(11) NOT NULL AUTO_INCREMENT,
  `id_user`  int(11) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `alert_type`  int(11) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_message`  int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_emergency_alerts_idx` (`id_user`),
  KEY `fk_messages_idx` (`id_message`),
  KEY `fk_id_status_idx` (`id_status`),
  CONSTRAINT `fk_emergency_alerts_user_id`
    FOREIGN KEY (`id_user`)
    REFERENCES `users` (`id`),
  CONSTRAINT `fk_messages_id_message`
    FOREIGN KEY (`id_message`)
    REFERENCES `messages` (`id`),
  CONSTRAINT `fk_emergency_alerts_id_status`
    FOREIGN KEY (`id_status`)
    REFERENCES `status` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `emergency_alerts` (`id`, `id_user`, `latitude`, `longitude`, `alert_type`, `timestamp`, `description`, `id_message`, `id_status`) VALUES (NULL, '1', '324324324', '423432432', '1', CURRENT_TIMESTAMP, 'test de prueba - secuestro', '1', '1');

CREATE TABLE `alert_histories` (
  `id`  int(11) NOT NULL AUTO_INCREMENT,
  `id_user`  int(11) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `details` varchar(255) NOT NULL,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alert_histories_idx` (`id_user`),
  CONSTRAINT `fk_alert_histories_user_id`
    FOREIGN KEY (`id_user`)
    REFERENCES `users` (`id`),
  CONSTRAINT `fk_alert_histories_id_status`
    FOREIGN KEY (`id_status`)
    REFERENCES `status` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `alert_histories` (`id`, `id_user`, `event_type`, `timestamp`, `details`, `id_status`) VALUES (NULL, '1', '1231', CURRENT_TIMESTAMP, 'test', '1');

CREATE TABLE `safe_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `id_user`  int(11) NOT NULL,
  `id_status`  int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_safe_addresses_idx` (`id_user`),
  CONSTRAINT `fk_safe_addresses_id_user`
    FOREIGN KEY (`id_user`)
    REFERENCES `users` (`id`),
  CONSTRAINT `fk_safe_addresses_id_status`
    FOREIGN KEY (`id_status`)
    REFERENCES `status` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `safe_addresses` (`id`, `location_name`, `latitude`, `longitude`, `address`, `id_user`, `id_status`) VALUES (NULL, 'la casa de tu vieja', '24234234324', '234324234', 'real 123', '1', '1');

-- --------------------------------------------------------

--
-- Índices para tablas creadas
--

-- --------------------------------------------------------
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`);

-- --------------------------------------------------------

COMMIT;