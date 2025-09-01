-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2025 at 05:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `club_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE `career` (
  `id` int(11) NOT NULL,
  `season` varchar(20) NOT NULL,
  `league` varchar(100) DEFAULT NULL,
  `cup` varchar(100) DEFAULT NULL,
  `champions` varchar(100) DEFAULT NULL,
  `europa` varchar(100) DEFAULT NULL,
  `supercup` varchar(100) DEFAULT NULL,
  `european` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `id` int(11) NOT NULL,
  `month` date NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `ground` enum('Home','Away','Neutral') NOT NULL,
  `score` varchar(20) DEFAULT NULL,
  `opponent_id` int(11) NOT NULL,
  `goal_scorers` varchar(255) DEFAULT NULL,
  `assists` varchar(255) DEFAULT NULL,
  `man_of_the_match` varchar(100) DEFAULT NULL,
  `player_of_the_month` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `head_to_head`
--

CREATE TABLE `head_to_head` (
  `id` int(11) NOT NULL,
  `season` varchar(20) NOT NULL,
  `opponent` varchar(100) NOT NULL,
  `home_wins` int(11) DEFAULT 0,
  `home_draws` int(11) DEFAULT 0,
  `home_losses` int(11) DEFAULT 0,
  `home_scored` int(11) DEFAULT 0,
  `home_conceded` int(11) DEFAULT 0,
  `away_wins` int(11) DEFAULT 0,
  `away_draws` int(11) DEFAULT 0,
  `away_losses` int(11) DEFAULT 0,
  `away_scored` int(11) DEFAULT 0,
  `away_conceded` int(11) DEFAULT 0,
  `neutral_wins` int(11) DEFAULT 0,
  `neutral_draws` int(11) DEFAULT 0,
  `neutral_losses` int(11) DEFAULT 0,
  `neutral_scored` int(11) DEFAULT 0,
  `neutral_conceded` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `objectives`
--

CREATE TABLE `objectives` (
  `id` int(11) NOT NULL,
  `season` varchar(20) NOT NULL,
  `league_objective` varchar(255) DEFAULT NULL,
  `other_objectives` text DEFAULT NULL,
  `status` enum('In Progress','Completed','Pending') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `opponents`
--

CREATE TABLE `opponents` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `tournament` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `season_stats`
--

CREATE TABLE `season_stats` (
  `id` int(11) NOT NULL,
  `season` varchar(20) NOT NULL,
  `matches` int(11) DEFAULT 0,
  `wins` int(11) DEFAULT 0,
  `draws` int(11) DEFAULT 0,
  `losses` int(11) DEFAULT 0,
  `goals_for` int(11) DEFAULT 0,
  `goals_against` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `squad_hub`
--

CREATE TABLE `squad_hub` (
  `id` int(11) NOT NULL,
  `overall` int(11) NOT NULL,
  `growth` int(11) NOT NULL,
  `final_overall` int(11) NOT NULL,
  `age` varchar(20) NOT NULL,
  `position` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('First Team','HG','U21','Academy','Youth Player') DEFAULT 'First Team',
  `transfer_type` enum('None','Loan In','Loan Out') DEFAULT 'None',
  `transfer_team` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `founded` year(4) DEFAULT NULL,
  `stadium` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `season` year(4) DEFAULT NULL,
  `format` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`id`, `name`, `type`, `country`, `season`, `format`, `created_at`) VALUES
(1, 'Uefa Champions League', NULL, NULL, NULL, NULL, '2025-08-26 02:22:39'),
(2, 'Uefa Europa League', NULL, NULL, NULL, NULL, '2025-08-26 02:22:39'),
(3, 'Uefa Conference League', NULL, NULL, NULL, NULL, '2025-08-26 02:22:39'),
(4, 'EFL League One', NULL, NULL, NULL, NULL, '2025-08-26 02:22:39'),
(5, 'Championship', NULL, NULL, NULL, NULL, '2025-08-26 02:22:39'),
(6, 'Carabao Cup', NULL, NULL, NULL, NULL, '2025-08-26 02:22:39'),
(7, 'Emirates FA Cup', NULL, NULL, NULL, NULL, '2025-08-26 02:22:39'),
(8, 'Bristol Cup', NULL, NULL, NULL, NULL, '2025-08-26 02:22:39'),
(9, 'Pre-Season Cup', NULL, NULL, NULL, NULL, '2025-08-26 02:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '2025-08-26 02:55:51', '2025-08-26 02:55:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `career`
--
ALTER TABLE `career`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tournament` (`tournament_id`),
  ADD KEY `fk_opponent` (`opponent_id`);

--
-- Indexes for table `head_to_head`
--
ALTER TABLE `head_to_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objectives`
--
ALTER TABLE `objectives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opponents`
--
ALTER TABLE `opponents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `season_stats`
--
ALTER TABLE `season_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `squad_hub`
--
ALTER TABLE `squad_hub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfer_team` (`transfer_team`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `career`
--
ALTER TABLE `career`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `head_to_head`
--
ALTER TABLE `head_to_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `objectives`
--
ALTER TABLE `objectives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opponents`
--
ALTER TABLE `opponents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `season_stats`
--
ALTER TABLE `season_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `squad_hub`
--
ALTER TABLE `squad_hub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD CONSTRAINT `fk_opponent` FOREIGN KEY (`opponent_id`) REFERENCES `opponents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tournament` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `squad_hub`
--
ALTER TABLE `squad_hub`
  ADD CONSTRAINT `squad_hub_ibfk_1` FOREIGN KEY (`transfer_team`) REFERENCES `teams` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
