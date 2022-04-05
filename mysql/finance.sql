-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 07:16 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dailyexpense`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(20) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `expense` int(20) NOT NULL,
  `expensedate` varchar(15) NOT NULL,
  `expensecategory` varchar(50) NOT NULL,
  `expensename` varchar(50) NOT NULL,
  -- `category_id` int(20) NOT NULL,
  PRIMARY KEY(expense_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- An expense has ONE user

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_path` varchar(50) NOT NULL DEFAULT 'default_profile.png',
  `password` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL,
  PRIMARY KEY(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- -- A user has one or more expenses

-- CREATE TABLE `categories`(
-- `id` int(20) NOT NULL,  
-- `category_id` int(20) NOT NULL,
-- `category_name` varchar(50) NOT NULL,
-- PRIMARY KEY(id)

-- )
-- ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- An expense has one cateogory

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
-- ALTER TABLE `expenses`
--   ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `users`
--
-- ALTER TABLE `users`
--   ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `categories` CHANGE `id` `id` INT(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `expenses` CHANGE `expense_id` `expense_id` INT(20) NOT NULL AUTO_INCREMENT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `profile_path`, `password`, `trn_date`) VALUES
(7, 'Edward', 'Ho', 'ed.ho@gmail.com', 'default_profile.png', 'c773fdef3889bdadbe809f1e8aaeea46', '2022-04-02 00:16:24'),
(8, 'a', 'a', 'a@a.com', 'default_profile.png', '0cc175b9c0f1b6a831c399e269772661', '2022-04-02 20:58:08'),
(9, 'Garson', 'Hung', 'garson.hung@gmail.com', 'default_profile.png', 'c773fdef3889bdadbe809f1e8aaeea46', '2022-04-05 19:45:02');


INSERT INTO `expenses` (`expense_id`, `user_id`, `expense`, `expensedate`, `expensecategory`, `expensename`) VALUES
(86, '7', 10, '2022-04-04', 'Food', 'Wendys'),
(87, '7', 10, '2022-04-04', 'Entertainment', '111'),
(88, '7', 10, '2022-04-04', 'Food', 'McD'),
(91, '7', 100, '2022-04-04', 'Bills & Recharges', 'Walmart'),
(92, '7', 100, '2022-04-05', 'Food', 'McD');