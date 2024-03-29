-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 29 mars 2024 à 16:59
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e5`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `iduser` int(11) DEFAULT NULL,
  `Id_annonce` int(11) NOT NULL,
  `Id_marque` int(11) DEFAULT NULL,
  `Id_ref` int(11) DEFAULT NULL,
  `Prix` decimal(10,2) DEFAULT NULL,
  `Id_Photo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`iduser`, `Id_annonce`, `Id_marque`, `Id_ref`, `Prix`, `Id_Photo`, `description`) VALUES
(1, 2, 2, 6, '8000.00', 'photo2.jpg', NULL),
(7, 3, 3, 11, '5000.00', 'photo3.jpg', NULL),
(7, 5, 5, 22, '12000.00', 'photo5.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `Id_marque` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`Id_marque`, `Nom`) VALUES
(1, 'Rolex'),
(2, 'Omega'),
(3, 'Tag Heuer'),
(4, 'Patek Philippe'),
(5, 'Cartier'),
(6, 'Audemars Piguet'),
(7, 'Breitling'),
(8, 'Seiko'),
(9, 'Citizen'),
(10, 'Hublot'),
(11, 'Tissot'),
(12, 'Longines'),
(13, 'Bulova'),
(14, 'Casio'),
(15, 'Timex'),
(16, 'Panerai'),
(17, 'Jaeger-LeCoultre'),
(18, 'IWC Schaffhausen'),
(19, 'Vacheron Constantin'),
(20, 'Bell & Ross');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `Id_Photo` int(11) NOT NULL,
  `nom_fichier` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ref`
--

CREATE TABLE `ref` (
  `Id_marque` int(11) NOT NULL,
  `Id_ref` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ref`
--

INSERT INTO `ref` (`Id_marque`, `Id_ref`, `Nom`) VALUES
(1, 1, 'Submariner'),
(1, 2, 'Datejust'),
(1, 3, 'Daytona'),
(1, 4, 'GMT-Master II'),
(1, 5, 'Explorer'),
(2, 6, 'Speedmaster Professional'),
(2, 7, 'Seamaster Diver 300M'),
(2, 8, 'Constellation'),
(2, 9, 'De Ville'),
(2, 10, 'Seamaster Aqua Terra'),
(3, 11, 'Carrera'),
(3, 12, 'Monaco'),
(3, 13, 'Aquaracer'),
(3, 14, 'Formula 1'),
(3, 15, 'Autavia'),
(4, 16, 'Nautilus'),
(4, 17, 'Calatrava'),
(4, 18, 'Aquanaut'),
(4, 19, 'Complications'),
(4, 20, 'Grand Complications'),
(5, 21, 'Tank'),
(5, 22, 'Santos de Cartier'),
(5, 23, 'Ballon Bleu de Cartier'),
(5, 24, 'Drive de Cartier'),
(5, 25, 'Panthère de Cartier');

-- --------------------------------------------------------

--
-- Structure de la table `signalement`
--

CREATE TABLE `signalement` (
  `Id_signalement` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `Id_annonce` int(11) NOT NULL,
  `idplaignant` int(11) NOT NULL,
  `idsignaler` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `signalement`
--

INSERT INTO `signalement` (`Id_signalement`, `description`, `Id_annonce`, `idplaignant`, `idsignaler`) VALUES
(1, 'cqscq', 2, 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `mdp` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`iduser`, `nom`, `prenom`, `email`, `adresse`, `mdp`) VALUES
(1, 'NomUtilisateur', 'PrenomUtilisateur', 'admin@hotmail.com', '0', 'admin'),
(7, 'BENMOUNA JAYET', 'mehdi', 'sbenmounmehdi@hotmail.com', '7 avenue de', 'root'),
(10, 'root', 'root', 'root', 'root', 'root'),
(11, 'Obertis', 'Alexis', 'Obertis@hotmail.com', 'cheppa', 'Obertis');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`Id_annonce`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`Id_marque`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`Id_Photo`);

--
-- Index pour la table `ref`
--
ALTER TABLE `ref`
  ADD PRIMARY KEY (`Id_marque`,`Id_ref`);

--
-- Index pour la table `signalement`
--
ALTER TABLE `signalement`
  ADD PRIMARY KEY (`Id_signalement`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `Id_annonce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `Id_marque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `Id_Photo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `signalement`
--
ALTER TABLE `signalement`
  MODIFY `Id_signalement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ref`
--
ALTER TABLE `ref`
  ADD CONSTRAINT `ref_ibfk_1` FOREIGN KEY (`Id_marque`) REFERENCES `marque` (`Id_marque`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
