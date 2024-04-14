-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 14, 2024 alle 17:18
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.1.17

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
(1, 'allWrestler'),
(2, 'Flyer'),
(3, 'Hardcore');

-- --------------------------------------------------------

--
-- Struttura della tabella `federations`
--

CREATE TABLE `federations` (
  `id_federation` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `list_ranking`
--

INSERT INTO `list_ranking` (`id_ranking`, `ranking_name`, `description`, `ranking`, `status`, `category_id`) VALUES
(1, 'Wrestler of the Year 2024', 'Vote for your favorite wrestler of the year 2024.', 'wrestler', 1, NULL),
(2, 'Tag Team of the Year 2024', 'Vote for your favorite tag team of the year 2024.', 'tag team', 0, NULL),
(3, 'Flyer of the year 2024', 'Vote your favourite Flyer of the 2024', 'wrestler', 1, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `tag_teams`
--

CREATE TABLE `tag_teams` (
  `id_tag_team` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `membro1` int(11) DEFAULT NULL,
  `membro2` int(11) DEFAULT NULL,
  `continent` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `id_vote_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tag_teams`
--

INSERT INTO `tag_teams` (`id_tag_team`, `name`, `membro1`, `membro2`, `continent`, `country`, `id_vote_category`) VALUES
(1, 'The Dynamic Duo', 1, 2, 'North America', 'USA', 2),
(2, 'The Unstoppables', 3, 4, 'Oceania', 'Australia', 2);

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
  `role` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id_user`, `fullname`, `email`, `username`, `image_path`, `password`, `created_at`, `role`) VALUES
(1, 'John Doe', 'john@doe.com', 'johndoe', 'john.jpg', '$2y$10$mfhvQ3nh.TdyVX5yLwGDIedEbbt5Jr0JA/ZZH.EPMebbaZixWrjmy', '2024-04-10 11:05:09', NULL),
(2, 'Mary Jane', 'mary@jane.com', 'maryjane99', 'mary.jpg', '$2y$10$JYIFMefwR2El8SxdIKW5oOEO2F33LUld8Ct8VHAJbwqbdK1voWVim', '2024-04-10 12:16:55', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `votes`
--

CREATE TABLE `votes` (
  `id_votes` int(11) NOT NULL,
  `id_ranking` int(11) DEFAULT NULL,
  `id_wrestler` int(11) DEFAULT NULL,
  `id_tag_team` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `score` decimal(3,1) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `date_vote` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `votes`
--

INSERT INTO `votes` (`id_votes`, `id_ranking`, `id_wrestler`, `id_tag_team`, `id_user`, `score`, `year`, `date_vote`) VALUES
(2, 1, 1, NULL, 1, 6.0, 2024, '2024-04-13 17:08:46'),
(4, 3, 4, NULL, 1, 1.5, 2024, '2024-04-13 17:27:31'),
(18, 1, 1, NULL, 2, 2.5, 2024, '2024-04-14 15:16:37');

-- --------------------------------------------------------

--
-- Struttura della tabella `wrestlers`
--

CREATE TABLE `wrestlers` (
  `id_wrestler` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `federation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `wrestlers`
--

INSERT INTO `wrestlers` (`id_wrestler`, `name`, `country`, `category_id`, `federation_id`) VALUES
(1, 'John', 'USA', NULL, NULL),
(2, 'Jane', 'UK', 2, NULL),
(3, 'Max', 'Canada', NULL, NULL),
(4, 'Lucy', 'Australia', 2, NULL);

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
  ADD KEY `membro1` (`membro1`),
  ADD KEY `membro2` (`membro2`);

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
  ADD UNIQUE KEY `idx_ranking_user` (`id_ranking`,`id_user`),
  ADD KEY `id_wrestler` (`id_wrestler`),
  ADD KEY `id_tag_team` (`id_tag_team`),
  ADD KEY `id_user` (`id_user`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `federations`
--
ALTER TABLE `federations`
  MODIFY `id_federation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `list_ranking`
--
ALTER TABLE `list_ranking`
  MODIFY `id_ranking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `tag_teams`
--
ALTER TABLE `tag_teams`
  MODIFY `id_tag_team` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `votes`
--
ALTER TABLE `votes`
  MODIFY `id_votes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `wrestlers`
--
ALTER TABLE `wrestlers`
  MODIFY `id_wrestler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `tag_teams_ibfk_1` FOREIGN KEY (`membro1`) REFERENCES `wrestlers` (`id_wrestler`),
  ADD CONSTRAINT `tag_teams_ibfk_2` FOREIGN KEY (`membro2`) REFERENCES `wrestlers` (`id_wrestler`);

--
-- Limiti per la tabella `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`id_ranking`) REFERENCES `list_ranking` (`id_ranking`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`id_wrestler`) REFERENCES `wrestlers` (`id_wrestler`),
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`id_tag_team`) REFERENCES `tag_teams` (`id_tag_team`),
  ADD CONSTRAINT `votes_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Limiti per la tabella `wrestlers`
--
ALTER TABLE `wrestlers`
  ADD CONSTRAINT `fk_federation` FOREIGN KEY (`federation_id`) REFERENCES `federations` (`id_federation`),
  ADD CONSTRAINT `fk_wrestler_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
