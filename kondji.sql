-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 07 oct. 2022 à 15:26
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kondji`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `identifiant` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sexe` varchar(25) NOT NULL,
  `token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `lastname`, `firstname`, `identifiant`, `password`, `sexe`, `token`, `created_at`, `updated_at`) VALUES
(3, 'malo', 'doro', 'a12354', '$2y$10$datf/NLPMS1Jt7g9k/cAS.6u.4OGCut5HtznIQpuTUINSI.DutKAu', 'Homme', 'cc6286a9243fb3561aace801217792a4d4e68f33f8765c1a78e9db653b2c71a1371f9ca3049d4a00eb61f41b23912211f40aad084bc1fc8b8fd41adf40474b0e', '2022-09-24 22:27:47', '2022-09-24 23:32:07'),
(4, 'lola', 'lopiu', 'b09876', '$2y$10$Od/6StzZxpEdNC1CyFVpJudRFi7aHNjt3u2sBy4sPE66gIKnDYLl6', 'Femme', NULL, '2022-09-24 22:59:37', '2022-09-24 23:00:20'),
(5, 'Ali', 'Mark', 'admin', '$2y$10$T4mkNHVowZ1fOIDT7BRZIeSwvg1CJQvJ/tRqEhjbVGg/FDaKve1M2', 'Homme', '545fbe275d4d201f6de1a441e96ef1e0ec6b366221070f5b4cc9f1624e3ed58af08f27d08bec8c96a01a0b2e63c4d470d2ad86a60a6b2ba4b5a4a1f77bfcf834', '2022-09-27 19:06:04', '2022-09-27 19:06:59');

-- --------------------------------------------------------

--
-- Structure de la table `centre_de_sante`
--

CREATE TABLE `centre_de_sante` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

CREATE TABLE `consultation` (
  `id` int(11) NOT NULL,
  `motif` text NOT NULL,
  `antecedant` text DEFAULT NULL,
  `description_maladie` text NOT NULL,
  `examen` text DEFAULT NULL,
  `diagnostic` text NOT NULL,
  `traitement` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `medecin_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `centre_de_sante_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

CREATE TABLE `medecin` (
  `id` int(11) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `identifiant` varchar(45) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`id`, `lastname`, `firstname`, `identifiant`, `sexe`, `password`, `token`, `created_at`, `updated_at`) VALUES
(4, 'Polo', 'Manu', 'm3333', 'Homme', '$2y$10$g.06tcVH76D6JDcFrUiwi.jYMYw7fDQ1xcCOcYsOthj9hTQZGDOQm', NULL, '2022-09-27 19:10:25', '2022-09-27 21:40:04');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `sexe` varchar(25) NOT NULL,
  `birth_day` datetime DEFAULT NULL,
  `telephone` varchar(45) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `identifiant` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `lastname`, `firstname`, `sexe`, `birth_day`, `telephone`, `adresse`, `identifiant`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Ali', 'Fofana', 'Homme', '2022-08-01 08:25:00', '0022890876544', 'Lome, Adidome', NULL, NULL, NULL, '2022-09-21 12:13:02', '0000-00-00 00:00:00'),
(2, 'Soso', 'Manuel', 'Homme', '2022-09-27 19:10:25', '90876754', 'Lome, kegue', NULL, NULL, NULL, '2022-09-27 23:04:00', '0000-00-00 00:00:00'),
(3, 'Lolo', 'Ama', 'Femme', '2022-09-27 00:00:00', '90876543', 'Lome, Novissi', NULL, NULL, NULL, '2022-09-27 23:07:42', '0000-00-00 00:00:00'),
(4, '', '', 'Femme', '0000-00-00 00:00:00', '', '', NULL, NULL, NULL, '2022-09-27 23:20:16', '0000-00-00 00:00:00'),
(5, 'Pierre', 'Gold', 'Homme', '2022-09-27 00:00:00', '12667788', 'Lome, ag', NULL, NULL, NULL, '2022-09-27 23:22:17', '0000-00-00 00:00:00'),
(6, 'koko', 'sami', 'Homme', '2022-09-28 00:00:00', '55667788', 'Lome, Novissi', NULL, NULL, NULL, '2022-09-28 00:09:10', '0000-00-00 00:00:00'),
(7, 'Halo', 'Goty', 'Homme', '2022-09-28 00:00:00', '88662200', 'Lome, Novissi', NULL, NULL, NULL, '2022-09-28 00:14:00', '0000-00-00 00:00:00'),
(8, 'Halo', 'mimi', 'Femme', '2022-09-28 00:00:00', '00998877', 'Lome, kpe', NULL, NULL, NULL, '2022-09-28 00:16:39', '0000-00-00 00:00:00'),
(9, 'abalo', 'afi', 'Femme', '2022-09-29 00:00:00', '88776654', 'Lome, kpe', NULL, NULL, NULL, '2022-09-28 00:19:12', '0000-00-00 00:00:00'),
(10, 'wew', 'oihh', 'Homme', '2022-09-21 00:00:00', '77665544', 'Lome, ape', NULL, NULL, NULL, '2022-09-28 00:21:03', '0000-00-00 00:00:00'),
(11, 'jis', 'jsjs', 'Femme', '2022-09-28 00:00:00', '09887765', 'Lome, Novissi', NULL, NULL, NULL, '2022-09-28 01:20:30', '0000-00-00 00:00:00'),
(12, 'iei', 'cjfj', 'Homme', '2022-09-29 00:00:00', '09876543', '', NULL, NULL, NULL, '2022-09-28 01:27:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `patient_id` int(11) NOT NULL,
  `centre_de_sante_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `centre_de_sante`
--
ALTER TABLE `centre_de_sante`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_consultation_medecin` (`medecin_id`),
  ADD KEY `fk_consultation_patient1` (`patient_id`),
  ADD KEY `fk_consultation_centre_de_sante1` (`centre_de_sante_id`);

--
-- Index pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rendez_vous_centre_de_sante1` (`centre_de_sante_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `centre_de_sante`
--
ALTER TABLE `centre_de_sante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `fk_consultation_centre_de_sante1` FOREIGN KEY (`centre_de_sante_id`) REFERENCES `centre_de_sante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_consultation_medecin` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_consultation_patient1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `fk_rendez_vous_centre_de_sante1` FOREIGN KEY (`centre_de_sante_id`) REFERENCES `centre_de_sante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rendez_vous_patient1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
