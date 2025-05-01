-- database/books.sql - SQL file to create the database and tables
-- This file contains SQL statements to create the 'book_catalog' database
-- and the 'books' and 'users' tables.

-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS book_catalog;

-- Use the book_catalog database
USE book_catalog;


-- This SQL script creates the necessary tables for the Book Cataloging System.

-- --------------------------------------------------------

-- Table structure for table `users`
-- Stores user account information

CREATE TABLE `users` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL, -- Store hashed passwords
  `email` varchar(100) NOT NULL UNIQUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `books`
-- Stores book information, including the user who added it

CREATE TABLE `books` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) UNSIGNED NOT NULL, -- Foreign key to link book to a user
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `added_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE -- If a user is deleted, delete their books
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;