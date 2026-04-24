-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 23 avr. 2026 à 18:11
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `monerp`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employeId` varchar(7) NOT NULL,
  `dateDemabauche` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `employeId`, `dateDemabauche`) VALUES
(1, 1, 'ADMIN01', '2026-04-23');

-- --------------------------------------------------------

--
-- Structure de la table `appels`
--

CREATE TABLE `appels` (
  `eleveId` int(11) NOT NULL,
  `classeId` int(11) NOT NULL,
  `matierreId` int(11) NOT NULL,
  `dateAppel` date NOT NULL DEFAULT curdate(),
  `statut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `appels`
--

INSERT INTO `appels` (`eleveId`, `classeId`, `matierreId`, `dateAppel`, `statut`) VALUES
(1, 6, 2, '2026-04-22', 1),
(3, 4, 1, '2026-04-22', 1),
(3, 4, 2, '2026-04-22', 1),
(3, 4, 4, '2026-04-22', 0),
(5, 2, 1, '2026-04-22', 1),
(5, 2, 2, '2026-04-22', 1),
(5, 2, 4, '2026-04-22', 1),
(7, 6, 1, '2026-04-22', 1),
(7, 6, 2, '2026-04-22', 1),
(9, 4, 1, '2026-04-22', 1),
(9, 4, 2, '2026-04-22', 1),
(9, 4, 4, '2026-04-22', 0),
(11, 2, 1, '2026-04-22', 1),
(11, 2, 2, '2026-04-22', 1),
(11, 2, 4, '2026-04-22', 1),
(13, 6, 1, '2026-04-22', 1),
(13, 6, 2, '2026-04-22', 1),
(15, 4, 1, '2026-04-22', 1),
(15, 4, 2, '2026-04-22', 1),
(15, 4, 4, '2026-04-22', 0),
(17, 2, 1, '2026-04-22', 1),
(17, 2, 2, '2026-04-22', 1),
(17, 2, 4, '2026-04-22', 1),
(19, 4, 1, '2026-04-22', 1),
(19, 4, 2, '2026-04-22', 1),
(19, 4, 4, '2026-04-22', 0),
(21, 2, 1, '2026-04-22', 1),
(21, 2, 2, '2026-04-22', 1),
(21, 2, 4, '2026-04-22', 1);

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `nombreEleve` int(11) DEFAULT NULL,
  `nomClasse` varchar(5) DEFAULT NULL,
  `idEns` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `nombreEleve`, `nomClasse`, `idEns`) VALUES
(1, 30, '1ere1', NULL),
(2, 32, '2eme1', 6),
(3, 29, '3eme1', NULL),
(4, 30, '4eme1', 6),
(5, 35, '5eme1', NULL),
(6, 31, '6eme1', 6);

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE `eleves` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `classe` varchar(5) NOT NULL,
  `idClasse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `eleves`
--

INSERT INTO `eleves` (`id`, `nom`, `prenom`, `classe`, `idClasse`) VALUES
(1, 'Oussema', 'Oueslati', '6eme1', 6),
(2, 'Youssef', 'Mejri', '5eme1', 5),
(3, 'Ahmed', 'Gabsi', '4eme1', 4),
(4, 'Emna', 'Bani', '3eme1', 3),
(5, 'Welid', 'Hkiri', '2eme1', 2),
(6, 'Nadhir', 'Hamrouni', '1ere1', 1),
(7, 'Mouhamed Aziz', 'Wesleti', '6eme1', 6),
(8, 'Doua', 'Chamekhi', '5eme1', 5),
(9, 'Abir', 'Benghoula', '4eme1', 4),
(10, 'Esraa', 'Soualhi', '3eme1', 3),
(11, 'Bochra', 'Hammami', '2eme1', 2),
(12, 'Yassine', 'Shili', '1ere1', 1),
(13, 'Yassine', 'Bouzidi', '6eme1', 6),
(14, 'Imen', 'Zarouk', '5eme1', 5),
(15, 'Aziz', 'Barhoumi', '4eme1', 4),
(16, 'Achref', 'Braiki', '3eme1', 3),
(17, 'Jalel', 'Ben Jeddou', '2eme1', 2),
(18, 'Atta', 'Khmiri', '1ere1', 1),
(19, 'Mehdi', 'Dhieb', '4eme1', 4),
(20, 'Ahmed', 'Chahdoura', '3eme1', 3),
(21, 'Kmar', 'Mejri', '2eme1', 2),
(22, 'Amen', 'Brahmi', '1ere', 1);

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

CREATE TABLE `enseignants` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `employeId` varchar(20) NOT NULL,
  `dateEmbauche` date NOT NULL,
  `diplome` varchar(200) DEFAULT NULL,
  `specialite` varchar(50) DEFAULT NULL,
  `estProfesseurPrincipale` tinyint(1) DEFAULT 0,
  `dateCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateMiseAjour` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignants`
--

INSERT INTO `enseignants` (`id`, `user_id`, `employeId`, `dateEmbauche`, `diplome`, `specialite`, `estProfesseurPrincipale`, `dateCreation`, `dateMiseAjour`) VALUES
(6, 2, 'ENS1', '2023-09-01', 'Master en anglais', 'Anglais', 1, '2026-04-15 10:52:43', '2026-04-15 10:52:43');

-- --------------------------------------------------------

--
-- Structure de la table `enseigner`
--

CREATE TABLE `enseigner` (
  `idEns` int(11) NOT NULL,
  `idClasse` int(11) NOT NULL,
  `idMatierre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseigner`
--

INSERT INTO `enseigner` (`idEns`, `idClasse`, `idMatierre`) VALUES
(6, 2, 4),
(6, 4, 2),
(6, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `matierres`
--

CREATE TABLE `matierres` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matierres`
--

INSERT INTO `matierres` (`id`, `nom`) VALUES
(4, 'Anglais'),
(5, 'Arabe'),
(3, 'Français'),
(1, 'Informatique'),
(2, 'Mathématique'),
(7, 'Musique'),
(6, 'Sciences de la vie et de la terre');

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `eleveId` int(11) NOT NULL,
  `classeId` int(11) NOT NULL,
  `matierreId` int(11) NOT NULL,
  `note` decimal(4,2) NOT NULL CHECK (`note` between 0 and 20),
  `dateNote` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`eleveId`, `classeId`, `matierreId`, `note`, `dateNote`) VALUES
(5, 2, 4, 6.75, '2026-04-22'),
(11, 2, 4, 15.00, '2026-04-22'),
(17, 2, 4, 16.50, '2026-04-22'),
(21, 2, 4, 12.50, '2026-04-22');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `numeroDeTelephon` varchar(8) NOT NULL,
  `role` enum('ADMIN','ENS','SURV') NOT NULL DEFAULT 'ENS',
  `userStatut` enum('en-ligne','hors-ligne','suspendu') NOT NULL DEFAULT 'hors-ligne',
  `theme` enum('claire','sombre') NOT NULL DEFAULT 'sombre',
  `languePreferee` enum('fr','en') NOT NULL DEFAULT 'fr',
  `passwordHash` varchar(255) NOT NULL,
  `passwordResetToken` varchar(32) DEFAULT NULL,
  `passwordResetExpiry` datetime DEFAULT NULL,
  `failedAttempts` int(11) DEFAULT 0,
  `lockedUntil` datetime DEFAULT NULL,
  `dateDeCreation` datetime DEFAULT current_timestamp(),
  `dernierLogin` datetime DEFAULT NULL,
  `dateDeMiseAJour` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `numeroDeTelephon`, `role`, `userStatut`, `theme`, `languePreferee`, `passwordHash`, `passwordResetToken`, `passwordResetExpiry`, `failedAttempts`, `lockedUntil`, `dateDeCreation`, `dernierLogin`, `dateDeMiseAJour`) VALUES
(1, 'Admin', 'Super', 'admin@school.com', '06123456', 'ADMIN', 'en-ligne', 'sombre', 'fr', '$2y$10$bHtXgOi/5qtd0Zsb8jaBJuyiFS5PuV3k3ovko8jlezVY6get5QsyW', NULL, NULL, 0, NULL, '2026-04-12 09:12:02', NULL, NULL),
(2, 'Martin', 'Sophie', 'prof@school.com', '06876543', 'ENS', 'en-ligne', 'sombre', 'fr', '$2y$10$Crdkxlw9YBocBIDbeyQr2us4aTt83yZlJY18djObynfoP5o/Di53C', NULL, NULL, 0, NULL, '2026-04-12 09:40:06', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `employeId` (`employeId`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `appels`
--
ALTER TABLE `appels`
  ADD PRIMARY KEY (`eleveId`,`classeId`,`matierreId`,`dateAppel`),
  ADD KEY `classeId` (`classeId`),
  ADD KEY `matierreId` (`matierreId`);

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_classes_enseignant` (`idEns`);

--
-- Index pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `idClasse` (`idClasse`);

--
-- Index pour la table `enseignants`
--
ALTER TABLE `enseignants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `employeId` (`employeId`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Index pour la table `enseigner`
--
ALTER TABLE `enseigner`
  ADD PRIMARY KEY (`idEns`,`idClasse`,`idMatierre`),
  ADD KEY `idClasse` (`idClasse`),
  ADD KEY `idMatierre` (`idMatierre`);

--
-- Index pour la table `matierres`
--
ALTER TABLE `matierres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`eleveId`,`classeId`,`matierreId`,`dateNote`),
  ADD KEY `classeId` (`classeId`),
  ADD KEY `matierreId` (`matierreId`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `numeroDeTelephon` (`numeroDeTelephon`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_role` (`role`),
  ADD KEY `idx_userStatut` (`userStatut`),
  ADD KEY `idx_lockedUntil` (`lockedUntil`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `eleves`
--
ALTER TABLE `eleves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `enseignants`
--
ALTER TABLE `enseignants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `matierres`
--
ALTER TABLE `matierres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `appels`
--
ALTER TABLE `appels`
  ADD CONSTRAINT `appels_ibfk_1` FOREIGN KEY (`eleveId`) REFERENCES `eleves` (`id`),
  ADD CONSTRAINT `appels_ibfk_2` FOREIGN KEY (`classeId`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `appels_ibfk_3` FOREIGN KEY (`matierreId`) REFERENCES `matierres` (`id`);

--
-- Contraintes pour la table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `fk_classes_enseignant` FOREIGN KEY (`idEns`) REFERENCES `enseignants` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD CONSTRAINT `eleves_ibfk_1` FOREIGN KEY (`idClasse`) REFERENCES `classes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `enseignants`
--
ALTER TABLE `enseignants`
  ADD CONSTRAINT `enseignants_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `enseigner`
--
ALTER TABLE `enseigner`
  ADD CONSTRAINT `enseigner_ibfk_1` FOREIGN KEY (`idEns`) REFERENCES `enseignants` (`id`),
  ADD CONSTRAINT `enseigner_ibfk_2` FOREIGN KEY (`idClasse`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `enseigner_ibfk_3` FOREIGN KEY (`idMatierre`) REFERENCES `matierres` (`id`);

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`eleveId`) REFERENCES `eleves` (`id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`classeId`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `notes_ibfk_3` FOREIGN KEY (`matierreId`) REFERENCES `matierres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
