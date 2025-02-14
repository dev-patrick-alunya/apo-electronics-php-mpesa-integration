-- phpMyAdmin SQL Dump
-- Enhanced Version (No Pre-Populated Data)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `apo-electronics-php-mpesa-integration`;

-- Create Database
CREATE DATABASE IF NOT EXISTS `apo-electronics-php-mpesa-integration` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `apo-electronics-php-mpesa-integration`;

-- -- Table: items
-- CREATE TABLE `items` (
--   `item_id` int(11) NOT NULL AUTO_INCREMENT,
--   `name` varchar(255) NOT NULL UNIQUE,
--   `price` int(11) NOT NULL CHECK (`price` > 0),
--   `created_at` datetime NOT NULL DEFAULT current_timestamp(),
--   `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
--   PRIMARY KEY (`item_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: users
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL UNIQUE,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: user_item
CREATE TABLE `user_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
   `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL CHECK (`price` > 0),
  `status` enum('Added to cart', 'Confirmed', 'Cancelled') NOT NULL DEFAULT 'Added to cart',
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
  -- FOREIGN KEY (`item_id`) REFERENCES `items`(`item_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
