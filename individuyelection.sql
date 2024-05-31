-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 31, 2024 alle 11:12
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `individuyelection`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(2, 'Flyer'),
(3, 'Hardcore'),
(4, 'Comedan'),
(6, 'Astrofisici Nucleari');

-- --------------------------------------------------------

--
-- Struttura della tabella `federations`
--

CREATE TABLE `federations` (
  `id_federation` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `federations`
--

INSERT INTO `federations` (`id_federation`, `name`, `description`) VALUES
(2, 'AEW', 'All Elite Wrestling'),
(3, 'AJPW', 'All Japan Pro Wrestling'),
(4, 'WWE', 'World Wrestling Entertainment'),
(6, 'ASCA', 'Associazione Astrofisici Nucleari');

-- --------------------------------------------------------

--
-- Struttura della tabella `list_ranking`
--

CREATE TABLE `list_ranking` (
  `id_ranking` int(11) NOT NULL,
  `ranking_name` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ranking` varchar(255) NOT NULL,
  `status` int(3) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `include_inactive` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `list_ranking`
--

INSERT INTO `list_ranking` (`id_ranking`, `ranking_name`, `description`, `ranking`, `status`, `category_id`, `include_inactive`) VALUES
(1, 'Wrestler of the Year 2024', 'Vote for your favorite wrestler of the year 2024.', 'wrestler', 0, NULL, 0),
(2, 'Tag Team of the Year 2024', 'Vote your favorite tag team of the year 2024.', 'tag team', 0, NULL, 0),
(15, 'Wrestler all time', 'all', 'wrestler', 1, NULL, 1),
(16, 'Best Astrofisici Nucleari 2024', 'Chi e\' in lizza per il nobel 2024', 'wrestler', 1, 6, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `tag_teams`
--

CREATE TABLE `tag_teams` (
  `id_tag_team` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `federation_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tag_teams`
--

INSERT INTO `tag_teams` (`id_tag_team`, `name`, `country`, `category_id`, `federation_id`, `is_active`) VALUES
(1, 'The Dynamic Duo', 'USA', NULL, NULL, 1),
(2, 'The Unstoppables', 'Australia', NULL, NULL, 1),
(3, 'DX Generation', 'USA', NULL, 4, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `image_path` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(50) DEFAULT 'user',
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id_user`, `fullname`, `email`, `username`, `image_path`, `password`, `created_at`, `role`, `reset_token`, `token_expiry`) VALUES
(1, 'John Doe', 'john@doe.com', 'johndoe', 'john.jpg', '$2y$10$mfhvQ3nh.TdyVX5yLwGDIedEbbt5Jr0JA/ZZH.EPMebbaZixWrjmy', '2024-04-10 11:05:09', 'admin', NULL, NULL),
(2, 'Mary Jane', 'mary@jane.com', 'maryjane99', 'john.jpg', '$2y$10$JYIFMefwR2El8SxdIKW5oOEO2F33LUld8Ct8VHAJbwqbdK1voWVim', '2024-04-10 12:16:55', 'user', NULL, NULL),
(5, 'peter parker', 'flavio.pantaleo@yahoo.com', 'spiderman', 'spiderman.jpg', '$2y$10$YU5lgrmi7oXIGHsNNsEdd.B0wCTmmqMw4KwlAHCRUHv2XdHdyHE26', '2024-05-20 11:55:48', 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `votes`
--

CREATE TABLE `votes` (
  `id_votes` int(11) NOT NULL,
  `id_ranking` int(11) DEFAULT NULL,
  `id_wrestler` int(11) DEFAULT NULL,
  `id_tag_team` int(11) DEFAULT NULL,
  `id_federation` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `score` decimal(3,1) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `votes`
--

INSERT INTO `votes` (`id_votes`, `id_ranking`, `id_wrestler`, `id_tag_team`, `id_federation`, `id_user`, `score`, `year`, `created_at`) VALUES
(4, 3, 4, NULL, NULL, 1, 1.5, 2024, '2024-04-13 17:27:31'),
(19, 1, 2, NULL, NULL, 2, 3.5, 2024, '2024-04-14 16:32:41'),
(20, 3, 2, NULL, NULL, 2, 0.5, 2024, '2024-04-14 16:33:15'),
(24, 1, 2, NULL, NULL, 1, 1.0, 2024, '2024-04-19 17:53:01'),
(28, 2, NULL, 1, NULL, 1, 2.5, 2024, '2024-05-03 10:51:19'),
(30, 2, NULL, 2, NULL, 1, 4.5, 2024, '2024-05-03 13:41:18'),
(31, 15, 7, NULL, NULL, 1, 2.5, 2024, '2024-05-20 11:46:37'),
(32, 1, 5, NULL, NULL, 1, 8.5, 2024, '2024-05-20 11:47:03'),
(33, 15, 4, NULL, NULL, 1, 6.0, 2024, '2024-05-27 08:17:06'),
(34, 15, 4, NULL, NULL, 2, 6.5, 2024, '2024-05-27 08:18:29');

-- --------------------------------------------------------

--
-- Struttura della tabella `wrestlers`
--

CREATE TABLE `wrestlers` (
  `id_wrestler` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `federation_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `wrestlers`
--

INSERT INTO `wrestlers` (`id_wrestler`, `name`, `country`, `category_id`, `federation_id`, `is_active`) VALUES
(2, 'Jane', 'UK', 2, 2, 1),
(4, 'Lucy', 'Australia', 6, 4, 1),
(5, 'Nero', 'Holland', 6, 6, 1),
(7, 'tren', 'china', NULL, 3, 0),
(8, 'Sandro', 'Francia', NULL, 2, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indici per le tabelle `federations`
--
ALTER TABLE `federations`
  ADD PRIMARY KEY (`id_federation`);

--
-- Indici per le tabelle `list_ranking`
--
ALTER TABLE `list_ranking`
  ADD PRIMARY KEY (`id_ranking`),
  ADD KEY `fk_votes_categories_category_id` (`category_id`);

--
-- Indici per le tabelle `tag_teams`
--
ALTER TABLE `tag_teams`
  ADD PRIMARY KEY (`id_tag_team`),
  ADD KEY `fk_tag_teams_category` (`category_id`),
  ADD KEY `fk_tag_teams_federation` (`federation_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indici per le tabelle `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id_votes`),
  ADD UNIQUE KEY `idx_user_ranking_wrestler` (`id_user`,`id_ranking`,`id_wrestler`),
  ADD KEY `id_tag_team` (`id_tag_team`),
  ADD KEY `fk_votes_federation` (`id_federation`),
  ADD KEY `fk_votes_wrestler` (`id_wrestler`);

--
-- Indici per le tabelle `wrestlers`
--
ALTER TABLE `wrestlers`
  ADD PRIMARY KEY (`id_wrestler`),
  ADD KEY `fk_wrestler_category` (`category_id`),
  ADD KEY `fk_federation` (`federation_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `federations`
--
ALTER TABLE `federations`
  MODIFY `id_federation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `list_ranking`
--
ALTER TABLE `list_ranking`
  MODIFY `id_ranking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `tag_teams`
--
ALTER TABLE `tag_teams`
  MODIFY `id_tag_team` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `votes`
--
ALTER TABLE `votes`
  MODIFY `id_votes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT per la tabella `wrestlers`
--
ALTER TABLE `wrestlers`
  MODIFY `id_wrestler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `list_ranking`
--
ALTER TABLE `list_ranking`
  ADD CONSTRAINT `fk_votes_categories_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Limiti per la tabella `tag_teams`
--
ALTER TABLE `tag_teams`
  ADD CONSTRAINT `fk_tag_teams_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_tag_teams_federation` FOREIGN KEY (`federation_id`) REFERENCES `federations` (`id_federation`) ON DELETE SET NULL;

--
-- Limiti per la tabella `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `fk_votes_federation` FOREIGN KEY (`id_federation`) REFERENCES `federations` (`id_federation`),
  ADD CONSTRAINT `fk_votes_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `fk_votes_wrestler` FOREIGN KEY (`id_wrestler`) REFERENCES `wrestlers` (`id_wrestler`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`id_wrestler`) REFERENCES `wrestlers` (`id_wrestler`),
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`id_tag_team`) REFERENCES `tag_teams` (`id_tag_team`),
  ADD CONSTRAINT `votes_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Limiti per la tabella `wrestlers`
--
ALTER TABLE `wrestlers`
  ADD CONSTRAINT `fk_federation` FOREIGN KEY (`federation_id`) REFERENCES `federations` (`id_federation`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_wrestler_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
