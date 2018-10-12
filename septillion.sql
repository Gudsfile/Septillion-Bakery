-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  ven. 12 oct. 2018 à 10:25
-- Version du serveur :  10.1.35-MariaDB
-- Version de PHP :  7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `septillion`
--

-- --------------------------------------------------------

--
-- Structure de la table `CATEGORY`
--

CREATE TABLE `CATEGORY` (
  `ID_CATEGORY` int(11) NOT NULL,
  `NAME` varchar(20) DEFAULT NULL,
  `DESCRIPTION` varchar(20) DEFAULT NULL,
  `ICON` varchar(20) DEFAULT NULL,
  `CREATED_BY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `CLIENT`
--

CREATE TABLE `CLIENT` (
  `ID_CLIENT` int(11) NOT NULL,
  `MAIL` varchar(20) DEFAULT NULL,
  `PASSWORD` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(20) DEFAULT NULL,
  `LAST_NAME` varchar(20) DEFAULT NULL,
  `ADDRESS` varchar(20) DEFAULT NULL,
  `PHONE_NUMBER` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `EMPLOYEE`
--

CREATE TABLE `EMPLOYEE` (
  `ID_EMPLOYEE` int(11) NOT NULL,
  `MAIL` varchar(20) DEFAULT NULL,
  `PASSWORD` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(20) DEFAULT NULL,
  `LAST_NAME` varchar(20) DEFAULT NULL,
  `ADDRESS` varchar(20) DEFAULT NULL,
  `PHONE_NUMBER` varchar(20) DEFAULT NULL,
  `ROLE` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `FEEDBACK`
--

CREATE TABLE `FEEDBACK` (
  `ID_PRODUCT` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `GRADE` int(11) DEFAULT NULL,
  `COMMENT` varchar(500) DEFAULT NULL,
  `SUBMIT_DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `IS_ORDERED`
--

CREATE TABLE `IS_ORDERED` (
  `ID_ORDER` int(11) NOT NULL,
  `ID_PRODUCT` int(11) NOT NULL,
  `QUANTITY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `MESSAGE`
--

CREATE TABLE `MESSAGE` (
  `ID_MESSAGE` int(11) NOT NULL,
  `OBJECT` varchar(20) DEFAULT NULL,
  `BODY` varchar(20) DEFAULT NULL,
  `ID_SENDER` int(11) DEFAULT NULL,
  `ID_RECEIVER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ORDER`
--

CREATE TABLE `ORDER` (
  `ID_ORDER` int(11) NOT NULL,
  `ORDER_DATE` date DEFAULT NULL,
  `DESCRIPTION` varchar(1000) DEFAULT NULL,
  `PRICE` float DEFAULT NULL,
  `VALIDATED` tinyint(1) DEFAULT NULL,
  `READY` tinyint(1) DEFAULT NULL,
  `COLLECTED` double DEFAULT NULL,
  `ID_CLIENT` int(11) DEFAULT NULL,
  `ID_EMPLOYEE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `PRODUCT`
--

CREATE TABLE `PRODUCT` (
  `ID_PRODUCT` int(11) NOT NULL,
  `NAME` varchar(20) DEFAULT NULL,
  `STOCK` int(11) DEFAULT NULL,
  `DESCRITPION` varchar(20) DEFAULT NULL,
  `PRICE` decimal(10,0) DEFAULT NULL,
  `IMAGE` varchar(20) DEFAULT NULL,
  `CREATED_BY` int(11) DEFAULT NULL,
  `LAST_UPDATED_BY` int(11) DEFAULT NULL,
  `ID_CATEGORY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD PRIMARY KEY (`ID_CATEGORY`),
  ADD KEY `par_ind` (`CREATED_BY`) USING BTREE;

--
-- Index pour la table `CLIENT`
--
ALTER TABLE `CLIENT`
  ADD PRIMARY KEY (`ID_CLIENT`);

--
-- Index pour la table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`ID_EMPLOYEE`);

--
-- Index pour la table `FEEDBACK`
--
ALTER TABLE `FEEDBACK`
  ADD PRIMARY KEY (`ID_PRODUCT`,`ID_CLIENT`) USING BTREE,
  ADD KEY `par_cli` (`ID_PRODUCT`,`ID_CLIENT`),
  ADD KEY `ID_CLIENT` (`ID_CLIENT`);

--
-- Index pour la table `IS_ORDERED`
--
ALTER TABLE `IS_ORDERED`
  ADD PRIMARY KEY (`ID_ORDER`,`ID_PRODUCT`),
  ADD KEY `par_order` (`ID_ORDER`,`ID_PRODUCT`),
  ADD KEY `ID_Product` (`ID_PRODUCT`);

--
-- Index pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD PRIMARY KEY (`ID_MESSAGE`),
  ADD KEY `parS_ind` (`ID_SENDER`),
  ADD KEY `parR_ind` (`ID_RECEIVER`);

--
-- Index pour la table `ORDER`
--
ALTER TABLE `ORDER`
  ADD PRIMARY KEY (`ID_ORDER`),
  ADD KEY `fk_employee_id` (`ID_EMPLOYEE`),
  ADD KEY `fk_client_id` (`ID_CLIENT`) USING BTREE;

--
-- Index pour la table `PRODUCT`
--
ALTER TABLE `PRODUCT`
  ADD PRIMARY KEY (`ID_PRODUCT`),
  ADD KEY `par_created` (`CREATED_BY`),
  ADD KEY `par_update` (`LAST_UPDATED_BY`),
  ADD KEY `par_category` (`ID_CATEGORY`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  MODIFY `ID_CATEGORY` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `CLIENT`
--
ALTER TABLE `CLIENT`
  MODIFY `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  MODIFY `ID_EMPLOYEE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  MODIFY `ID_MESSAGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ORDER`
--
ALTER TABLE `ORDER`
  MODIFY `ID_ORDER` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `PRODUCT`
--
ALTER TABLE `PRODUCT`
  MODIFY `ID_PRODUCT` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD CONSTRAINT `CATEGORY_ibfk_1` FOREIGN KEY (`CREATED_BY`) REFERENCES `EMPLOYEE` (`ID_Employee`) ON DELETE CASCADE;

--
-- Contraintes pour la table `FEEDBACK`
--
ALTER TABLE `FEEDBACK`
  ADD CONSTRAINT `FEEDBACK_ibfk_1` FOREIGN KEY (`ID_CLIENT`) REFERENCES `CLIENT` (`ID_CLIENT`) ON DELETE CASCADE,
  ADD CONSTRAINT `FEEDBACK_ibfk_2` FOREIGN KEY (`ID_Product`) REFERENCES `PRODUCT` (`ID_PRODUCT`) ON DELETE CASCADE;

--
-- Contraintes pour la table `IS_ORDERED`
--
ALTER TABLE `IS_ORDERED`
  ADD CONSTRAINT `IS_ORDERED_ibfk_1` FOREIGN KEY (`ID_ORDER`) REFERENCES `ORDER` (`ID_ORDER`) ON DELETE CASCADE,
  ADD CONSTRAINT `IS_ORDERED_ibfk_2` FOREIGN KEY (`ID_Product`) REFERENCES `PRODUCT` (`ID_PRODUCT`) ON DELETE CASCADE;

--
-- Contraintes pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD CONSTRAINT `MESSAGE_ibfk_1` FOREIGN KEY (`ID_SENDER`) REFERENCES `EMPLOYEE` (`ID_Employee`) ON DELETE CASCADE,
  ADD CONSTRAINT `MESSAGE_ibfk_2` FOREIGN KEY (`ID_RECEIVER`) REFERENCES `EMPLOYEE` (`ID_Employee`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ORDER`
--
ALTER TABLE `ORDER`
  ADD CONSTRAINT `ORDER_ibfk_1` FOREIGN KEY (`ID_client`) REFERENCES `CLIENT` (`ID_CLIENT`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_employee_id` FOREIGN KEY (`ID_employee`) REFERENCES `EMPLOYEE` (`ID_Employee`);

--
-- Contraintes pour la table `PRODUCT`
--
ALTER TABLE `PRODUCT`
  ADD CONSTRAINT `PRODUCT_ibfk_1` FOREIGN KEY (`CREATED_BY`) REFERENCES `EMPLOYEE` (`ID_Employee`) ON DELETE CASCADE,
  ADD CONSTRAINT `PRODUCT_ibfk_2` FOREIGN KEY (`LAST_UPDATED_BY`) REFERENCES `EMPLOYEE` (`ID_Employee`) ON DELETE CASCADE,
  ADD CONSTRAINT `PRODUCT_ibfk_3` FOREIGN KEY (`ID_Category`) REFERENCES `CATEGORY` (`ID_Category`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
