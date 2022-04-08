-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 08 avr. 2022 à 15:56
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chatapp`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `fromUser` int(100) NOT NULL,
  `toUser` int(100) NOT NULL,
  `message` text NOT NULL,
  `see` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `fromUser`, `toUser`, `message`, `see`, `date`) VALUES
(1, 15, 14, 'Bonjour', 1, '2022-04-08 12:28:52'),
(2, 15, 14, 'Tu vas bien', 1, '2022-04-08 12:34:14'),
(3, 14, 15, 'Oui ca va?', 1, '2022-04-08 12:35:17'),
(4, 15, 14, 'Bonjour', 1, '2022-04-08 12:45:43'),
(5, 15, 14, 'Hey', 1, '2022-04-08 12:48:40'),
(6, 15, 14, 'Hey', 1, '2022-04-08 12:49:58'),
(7, 15, 14, 'Hey', 1, '2022-04-08 12:51:04'),
(8, 15, 14, 'Ca va?', 1, '2022-04-08 12:51:09'),
(9, 16, 13, 'Bonjour, comment - allez vous ??', 1, '2022-04-08 13:01:59'),
(10, 13, 16, 'bien', 1, '2022-04-08 13:06:06'),
(11, 16, 13, 'hey', 1, '2022-04-08 13:06:55'),
(12, 16, 13, 'oui', 1, '2022-04-08 13:07:49'),
(13, 16, 9, 'Bonjour', 1, '2022-04-08 13:12:20'),
(14, 9, 16, 'bonjour', 1, '2022-04-08 13:12:38'),
(15, 9, 16, 'hello', 1, '2022-04-08 13:15:17'),
(16, 9, 16, 'bi', 1, '2022-04-08 13:15:29'),
(17, 16, 9, 'hash', 1, '2022-04-08 13:16:12'),
(18, 9, 16, 'ho', 1, '2022-04-08 13:16:45'),
(19, 16, 9, 'bonjour', 1, '2022-04-08 13:44:32'),
(20, 16, 9, 'ca va', 1, '2022-04-08 13:44:40'),
(21, 16, 9, 'vien ici', 1, '2022-04-08 13:44:50');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `fullname`, `pseudo`, `password`) VALUES
(9, 'fabien', 'fabien', '777bcfcf9efee56bedca63c5eb2304e67df52892'),
(10, 'affri', 'affri', '24ced4e6e1fb950cbae6ea48b0b886961ff08497'),
(11, 'penuel', 'penuel', '3ccde8b2035e7ccffa6f949d883e1ce6046d9d5f'),
(12, 'affou', 'affou', '0b7eadaacb19be43fe9e1542953f2a2b0345efd4'),
(13, 'stephane', 'stephane', '36bd4f73be32ed7262c164e7ee72163e7543989e'),
(14, 'mohamed', 'mohamed', '292959f6c7ab4f8b0761469ac1f11fc73f43b306'),
(15, 'richard', 'richard', '320bca71fc381a4a025636043ca86e734e31cf8b'),
(16, 'mistertam', 'tam', '5d418a47c3711bc374ad76e63148b4dfd84a58e6');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fromUser` (`fromUser`),
  ADD KEY `toUser` (`toUser`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`fromUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`toUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
