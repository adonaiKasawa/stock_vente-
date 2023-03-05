-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 08 nov. 2022 à 21:46
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mipro`
--

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

DROP TABLE IF EXISTS `actions`;
CREATE TABLE IF NOT EXISTS `actions` (
  `action_id` int(11) NOT NULL AUTO_INCREMENT,
  `action_nom` varchar(225) NOT NULL,
  `action_description` text NOT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `actions`
--

INSERT INTO `actions` (`action_id`, `action_nom`, `action_description`) VALUES
(1, 'lancer_commande', 'approvisionnement du stock'),
(2, 'connexion_au_systeme', 'La connexion d\'un utilisateur au systeme');

-- --------------------------------------------------------

--
-- Structure de la table `action_privilege`
--

DROP TABLE IF EXISTS `action_privilege`;
CREATE TABLE IF NOT EXISTS `action_privilege` (
  `action_privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_action` int(11) DEFAULT NULL,
  `id_privilege` int(11) DEFAULT NULL,
  PRIMARY KEY (`action_privilege_id`),
  KEY `action_privilege_ibfk_1` (`id_action`),
  KEY `action_privilege_ibfk_2` (`id_privilege`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `action_privilege`
--

INSERT INTO `action_privilege` (`action_privilege_id`, `id_action`, `id_privilege`) VALUES
(3, 1, 1),
(4, 2, 1),
(5, 1, 2),
(6, 2, 2),
(7, 1, 3),
(8, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `agent_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_agent` varchar(200) NOT NULL,
  `postnom_agent` varchar(200) NOT NULL,
  `prenom_agent` varchar(200) NOT NULL,
  `adresse_agent` text NOT NULL,
  `telephone_agent` varchar(20) NOT NULL,
  PRIMARY KEY (`agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`agent_id`, `nom_agent`, `postnom_agent`, `prenom_agent`, `adresse_agent`, `telephone_agent`) VALUES
(1, 'Tshientu', 'Mputu', 'GloDi', 'chez glo', '0840036474'),
(2, 'Mbula', 'Muvudizi', 'Adonai', 'chez Hack', '0819664909');

-- --------------------------------------------------------

--
-- Structure de la table `bon_livraison`
--

DROP TABLE IF EXISTS `bon_livraison`;
CREATE TABLE IF NOT EXISTS `bon_livraison` (
  `bon_livraison_id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_bon` varchar(225) NOT NULL,
  `date_livraison` datetime NOT NULL,
  `lien_bon_image` varchar(225) DEFAULT NULL,
  `id_fournisseur` int(11) DEFAULT NULL,
  `id_commande` int(11) DEFAULT NULL,
  PRIMARY KEY (`bon_livraison_id`),
  UNIQUE KEY `numero_bon` (`numero_bon`),
  KEY `id_fournisseur` (`id_fournisseur`),
  KEY `id_commande` (`id_commande`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bon_livraison`
--

INSERT INTO `bon_livraison` (`bon_livraison_id`, `numero_bon`, `date_livraison`, `lien_bon_image`, `id_fournisseur`, `id_commande`) VALUES
(29, '39852714', '2022-09-23 13:10:00', 'MC LOGO.png', 1, NULL),
(30, '1472537', '2022-09-23 13:11:00', 'istockphoto-852809306-612x612.jpg', 1, NULL),
(31, '1745235', '2022-09-27 12:20:00', 'recu-caisse_98292-6918.jpg', 1, NULL),
(32, '9876563123', '2022-09-27 14:50:00', 'AdobeStock_105081326_Preview.jpeg', 1, NULL),
(33, '6548523126', '2022-10-05 10:14:00', 'Limoblaze-For-The-Love.jpg', 1, NULL),
(34, '3213546876543245', '2022-10-06 10:15:00', 'graacd-itunes-2-e1568799312660-968637321-1.jpg', 1, 5),
(35, '3215582134549', '2022-10-27 11:01:00', 'Bon 2-12102022124448jpg_Page1_Image1.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `designation_cat` varchar(225) NOT NULL,
  `description_cat` text NOT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `designation_cat`, `description_cat`) VALUES
(1, 'CATEGORIE 1', 'Produit pour l\'impression'),
(2, 'CATEGORIE 2', 'nicdjnkxjcnc'),
(3, 'CATEGORIE 3', 'nkjfvnfjk  kfdjkjfd jkfdzprgr'),
(4, 'CATEGORIE 4', 'hjkjhgjhkj');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `commande_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_commande` datetime NOT NULL,
  `numero_commande` varchar(200) NOT NULL,
  `etape_commande` enum('en_cours','validee','satisfaite','annulee') NOT NULL DEFAULT 'en_cours',
  `id_fournisseur` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`commande_id`),
  UNIQUE KEY `unique_num_commande` (`numero_commande`),
  KEY `id_fournisseur` (`id_fournisseur`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`commande_id`, `date_commande`, `numero_commande`, `etape_commande`, `id_fournisseur`, `id_utilisateur`) VALUES
(3, '2022-10-03 16:23:00', '20221003302', 'en_cours', 1, 2),
(4, '2022-10-03 16:23:00', '20221003940', 'validee', 1, 2),
(5, '2022-10-04 16:30:00', '20221003295', 'satisfaite', 1, 2),
(6, '2022-10-21 17:18:00', '20221021146', 'validee', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `commande_produit`
--

DROP TABLE IF EXISTS `commande_produit`;
CREATE TABLE IF NOT EXISTS `commande_produit` (
  `commande_produit_id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite_commande_produit` int(11) NOT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `id_commande` int(11) DEFAULT NULL,
  PRIMARY KEY (`commande_produit_id`),
  KEY `id_commande` (`id_commande`),
  KEY `commande_produit_ibfk_2` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande_produit`
--

INSERT INTO `commande_produit` (`commande_produit_id`, `quantite_commande_produit`, `id_produit`, `id_commande`) VALUES
(5, 1500, 1, 3),
(6, 2000, 3, 3),
(7, 1500, 1, 4),
(8, 2000, 3, 4),
(9, 300, 1, 5),
(10, 500, 3, 5),
(11, 4545, 1, 6),
(12, 78987, 3, 6);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `details_bon`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `details_bon`;
CREATE TABLE IF NOT EXISTS `details_bon` (
`detail_bon_id` int(11)
,`quantite_detail_bon` int(11)
,`id_bon_livraison` int(11)
,`id_produit` int(11)
,`id_utilisateur` int(11)
,`produit_id` int(11)
,`designation` varchar(225)
,`barcode` varchar(50)
,`caracteristique` varchar(225)
,`nbre_par_pq` int(11)
,`id_categorie` int(11)
,`categorie_id` int(11)
,`designation_cat` varchar(225)
,`description_cat` text
,`bon_livraison_id` int(11)
,`numero_bon` varchar(225)
,`date_livraison` datetime
,`lien_bon_image` varchar(225)
,`id_fournisseur` int(11)
,`id_commande` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la table `detail_bon_livraison`
--

DROP TABLE IF EXISTS `detail_bon_livraison`;
CREATE TABLE IF NOT EXISTS `detail_bon_livraison` (
  `detail_bon_id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite_detail_bon` int(11) NOT NULL,
  `id_bon_livraison` int(11) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`detail_bon_id`),
  KEY `id_bon_livraison` (`id_bon_livraison`),
  KEY `id_produit` (`id_produit`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `detail_bon_livraison`
--

INSERT INTO `detail_bon_livraison` (`detail_bon_id`, `quantite_detail_bon`, `id_bon_livraison`, `id_produit`, `id_utilisateur`) VALUES
(47, 500, 29, 1, 2),
(48, 400, 29, 3, 2),
(49, 500, 30, 1, 2),
(50, 500, 30, 3, 2),
(51, 800, 31, 1, 2),
(52, 1500, 32, 1, 2),
(53, 2000, 32, 3, 2),
(54, 500, 33, 1, 2),
(55, 5000, 34, 3, 2),
(56, 1000, 35, 1, 2),
(57, 50, 35, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `fournisseur_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fournisseur` text NOT NULL,
  `tel_fournisseur` varchar(20) NOT NULL,
  `email_fournisseur` varchar(100) NOT NULL,
  `adresse_fournisseur` text NOT NULL,
  PRIMARY KEY (`fournisseur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`fournisseur_id`, `nom_fournisseur`, `tel_fournisseur`, `email_fournisseur`, `adresse_fournisseur`) VALUES
(1, 'USCT', '+2438199110010', 'info@usctcongo.com', 'Gombe');

-- --------------------------------------------------------

--
-- Structure de la table `privilege`
--

DROP TABLE IF EXISTS `privilege`;
CREATE TABLE IF NOT EXISTS `privilege` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_privilege` varchar(225) NOT NULL,
  `description_privilege` text NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `privilege`
--

INSERT INTO `privilege` (`privilege_id`, `nom_privilege`, `description_privilege`) VALUES
(1, 'super_admin', 'L\'admin qui peut créer les autres users'),
(2, 'admin', 'admin mais sans la possibilité de créer les autres users'),
(3, 'logisticien', 'le logisticien');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `produit_id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(225) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `caracteristique` varchar(225) NOT NULL,
  `nbre_par_pq` int(11) NOT NULL,
  `id_categorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`produit_id`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`produit_id`, `designation`, `barcode`, `caracteristique`, `nbre_par_pq`, `id_categorie`) VALUES
(1, 'CARBURANT', 'treret', 'retretreter', 14, 1),
(3, 'FARINE', '7897887', 'zererrert', 12, 1);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `projet_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_projet` varchar(225) NOT NULL,
  `description_projet` text NOT NULL,
  PRIMARY KEY (`projet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`projet_id`, `libelle_projet`, `description_projet`) VALUES
(1, 'ESU', 'impression des cartes étudiants pour étudiants'),
(2, 'FP', 'impression cartes fonctionnaires');

-- --------------------------------------------------------

--
-- Structure de la table `province`
--

DROP TABLE IF EXISTS `province`;
CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_province` varchar(200) NOT NULL,
  `chef_lieu` varchar(225) NOT NULL,
  `langues` varchar(225) NOT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `province`
--

INSERT INTO `province` (`province_id`, `nom_province`, `chef_lieu`, `langues`) VALUES
(1, 'Bas-Uele', 'Buta', ''),
(2, 'Equateur', 'Mbandaka', ''),
(3, 'Haut-Katanga', 'Lubumbashi', ''),
(4, 'Haut-Lomami', 'Kamina', ''),
(5, 'Haut-Uele', 'Isiro', ''),
(6, 'Ituri', 'Bunia', ''),
(7, 'Kasaï', 'Tshikapa', ''),
(8, 'Kasaï central', 'Kananga', ''),
(9, 'Kasaï oriental', 'Mbuji-Mayi', ''),
(10, 'Kinshasa', 'Kinshasa', ''),
(11, 'Kongo-Central', 'Matadi', ''),
(12, 'Kwango', 'Kenge', ''),
(13, 'Kwilu', 'Bandundu', ''),
(14, 'Lomami', 'Kabinda', ''),
(15, 'Lualaba', 'Kolwezi', ''),
(16, 'Mai-Ndombe', 'Inongo', ''),
(17, 'Maniema', 'Kindu', ''),
(18, 'Mongala', 'Lisala', ''),
(19, 'Nord-Kivu', 'Goma', ''),
(20, 'Nord-Ubangi', 'Gbadolite', ''),
(21, 'Sankuru', 'Lusambo', ''),
(22, 'Sud-Kivu', 'Bukavu', ''),
(23, 'Sud-Ubangi', 'Gemena', ''),
(24, 'Tanganyika', 'Kalemie', ''),
(25, 'Tshopo', 'Kisangani', ''),
(26, 'Tshuapa', 'Boende', '');

-- --------------------------------------------------------

--
-- Structure de la table `rapport_agent`
--

DROP TABLE IF EXISTS `rapport_agent`;
CREATE TABLE IF NOT EXISTS `rapport_agent` (
  `rapport_agent_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_rapport_agent` datetime NOT NULL,
  `nbre_imprimees` int(11) NOT NULL,
  `nbre_ratees` int(11) NOT NULL,
  `id_agent` int(11) DEFAULT NULL,
  `id_site` int(11) DEFAULT NULL,
  PRIMARY KEY (`rapport_agent_id`),
  KEY `id_site` (`id_site`),
  KEY `rapport_agent_ibfk_2` (`id_agent`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rapport_agent`
--

INSERT INTO `rapport_agent` (`rapport_agent_id`, `date_rapport_agent`, `nbre_imprimees`, `nbre_ratees`, `id_agent`, `id_site`) VALUES
(4, '2022-09-29 00:00:00', 123, 7, 1, NULL),
(5, '2022-09-29 00:00:00', 123, 7, 1, NULL),
(6, '2022-09-28 00:00:00', 200, 9, 2, NULL),
(7, '2022-10-21 00:00:00', 100, 2, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE IF NOT EXISTS `site` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_site` varchar(225) NOT NULL,
  `id_province` int(11) NOT NULL,
  `id_projet` int(11) DEFAULT NULL,
  PRIMARY KEY (`site_id`),
  KEY `projet_id` (`id_projet`),
  KEY `id_province` (`id_province`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `site`
--

INSERT INTO `site` (`site_id`, `libelle_site`, `id_province`, `id_projet`) VALUES
(5, 'Cours de Cassation PG', 10, NULL),
(6, 'Budget SG', 10, NULL),
(7, 'DPS', 10, NULL),
(8, 'Droits humains', 10, NULL),
(9, 'Francophonie', 10, NULL),
(10, 'Budget DGRAD', 10, NULL),
(11, 'Conseil d\'état PG', 10, NULL),
(12, 'Fonction Publique 2', 10, NULL),
(13, 'Fonction Publique 1', 10, NULL),
(14, 'Cours de Cassation GRF', 10, NULL),
(15, 'Finance', 10, NULL),
(16, 'Relation avec le parlement', 10, NULL),
(17, 'Budget / Contrôle', 10, NULL),
(18, 'Primature', 10, NULL),
(19, 'Présidence', 10, NULL),
(20, 'Fonction Publique', 10, NULL),
(21, 'Assemblée nationale', 10, NULL),
(22, 'Recherche scientifique', 10, NULL),
(23, 'Secrétariat Francophonie', 10, NULL),
(24, 'Décentralisation', 10, NULL),
(25, 'conseil économique', 10, NULL),
(26, 'relation avec les partis politiques', 10, NULL),
(27, 'Commerce extérieur', 10, NULL),
(28, 'relations avec les partis politiques', 10, NULL),
(29, 'PTNTIC', 10, NULL),
(30, 'Formation professionnelle et métier', 10, NULL),
(31, 'IGF', 10, NULL),
(32, 'Ministère justice', 10, NULL),
(33, 'Prévoyance social', 10, NULL),
(34, 'ministère de la jeunesse', 10, NULL),
(35, 'DGDA', 10, NULL),
(36, 'Hydrocarbures', 10, NULL),
(37, 'IGTER', 10, NULL),
(38, 'Culture et Art', 10, NULL),
(39, 'urbanisme et habitat', 10, NULL),
(40, 'Emploi et travail', 10, NULL),
(41, 'cours constitutionnelle GRF', 10, NULL),
(42, 'affaires étrangères', 10, NULL),
(43, 'environnement', 10, NULL),
(44, 'ITPR', 10, NULL),
(45, 'Transport', 10, NULL),
(46, 'Hydraulique', 10, NULL),
(47, 'Senapi', 10, NULL),
(48, 'Intérieur et sécurité', 10, NULL),
(49, 'Fonction Publique', 10, NULL),
(50, 'Développement rural', 10, NULL),
(51, 'Anciens combattants', 10, NULL),
(52, 'Agriculture', 10, NULL),
(53, 'Affaires sociales', 10, NULL),
(54, 'Défense Nationale', 10, NULL),
(55, 'Genre Famille et enfant', 10, NULL),
(56, 'Industrie', 10, NULL),
(57, 'Intégration régionale', 10, NULL),
(58, 'PME', 10, NULL),
(59, 'IGT', 10, NULL),
(60, 'Com et média', 10, NULL),
(61, 'Reconstruction', 10, NULL),
(62, 'UNESCO', 10, NULL),
(63, 'Pêche et élevage', 10, NULL),
(64, 'ESU', 10, NULL),
(65, 'EPST', 10, NULL),
(66, 'DGRAD', 10, NULL),
(67, 'Santé', 10, NULL),
(68, 'Actions humanitaires', 10, NULL),
(69, 'Matadi', 11, NULL),
(70, 'Kasangulu', 11, NULL),
(71, 'Madimba (kinsatu)', 11, NULL),
(72, 'Mbanza-Ngungu', 11, NULL),
(73, 'Songololo (kimpese)', 11, NULL),
(74, 'Luozi', 11, NULL),
(75, 'Kimvula', 11, NULL),
(76, 'Boma', 11, NULL),
(77, 'Moanda', 11, NULL),
(78, 'Lukula', 11, NULL),
(79, 'Tshela', 11, NULL),
(80, 'Seke-Banza (kinzau)', 11, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sortie_stock`
--

DROP TABLE IF EXISTS `sortie_stock`;
CREATE TABLE IF NOT EXISTS `sortie_stock` (
  `sortie_stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_sortie` datetime NOT NULL,
  `qte_sortie` int(11) NOT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_agent` int(11) DEFAULT NULL,
  `id_projet` int(11) DEFAULT NULL,
  `id_site` int(11) DEFAULT NULL,
  `id_stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`sortie_stock_id`),
  KEY `id_agent` (`id_agent`),
  KEY `id_projet` (`id_projet`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `sortie_stock_ibfk_2` (`id_produit`),
  KEY `id_site` (`id_site`)
) ENGINE=InnoDB AUTO_INCREMENT=2009 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sortie_stock`
--

INSERT INTO `sortie_stock` (`sortie_stock_id`, `date_sortie`, `qte_sortie`, `id_produit`, `id_utilisateur`, `id_agent`, `id_projet`, `id_site`, `id_stock`) VALUES
(1992, '2022-09-23 12:10:50', 500, 1, 2, 1, 1, 5, 46),
(1993, '2022-09-23 12:10:50', 100, 1, 2, 1, 1, 5, 48),
(1994, '2022-09-23 13:46:42', 400, 3, 2, 2, 2, 5, 47),
(1995, '2022-09-23 13:46:42', 100, 3, 2, 2, 2, 5, 49),
(1996, '2022-09-27 13:49:22', 100, 1, 2, 1, 1, 5, 48),
(1997, '2022-09-27 13:49:22', 20, 3, 2, 2, 2, 5, 49),
(1998, '2022-09-28 11:17:54', 300, 1, 2, 1, 1, 5, 48),
(1999, '2022-09-28 11:17:54', 800, 1, 2, 1, 1, 5, 50),
(2000, '2022-09-28 11:17:54', 1450, 1, 2, 1, 1, 5, 51),
(2001, '2022-09-30 11:59:49', 1, 1, 2, 1, 1, 5, 51),
(2002, '2022-10-06 12:19:58', 49, 1, 2, 1, 2, 69, 51),
(2003, '2022-10-06 12:19:58', 1, 1, 2, 1, 2, 69, 53),
(2004, '2022-10-06 12:19:58', 100, 1, 2, 2, 2, 70, 53),
(2005, '2022-10-21 16:46:33', 12, 1, 2, 1, 1, 69, 53),
(2006, '2022-10-21 16:46:33', 40, 3, 2, 2, 2, 78, 49),
(2007, '2022-10-27 09:49:58', 20, 1, 2, 1, 1, 72, 53),
(2008, '2022-10-27 09:49:58', 10, 3, 2, 2, 2, 76, 49);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `quantite_sortie` int(11) NOT NULL DEFAULT '0',
  `date_operation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_produit` int(11) DEFAULT NULL,
  `id_bon_livraison` int(11) DEFAULT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `id_produit` (`id_produit`),
  KEY `id_bon_livraison` (`id_bon_livraison`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`stock_id`, `quantite`, `quantite_sortie`, `date_operation`, `id_produit`, `id_bon_livraison`) VALUES
(46, 500, 500, '2022-09-23 12:09:51', 1, 29),
(47, 400, 400, '2022-09-23 12:09:51', 3, 29),
(48, 500, 500, '2022-09-23 12:10:23', 1, 30),
(49, 500, 170, '2022-09-23 12:10:23', 3, 30),
(50, 800, 800, '2022-09-27 11:21:29', 1, 31),
(51, 1500, 1500, '2022-09-27 13:48:13', 1, 32),
(52, 2000, 0, '2022-09-27 13:48:13', 3, 32),
(53, 500, 133, '2022-10-05 10:15:01', 1, 33),
(54, 5000, 0, '2022-10-05 10:15:47', 3, 34),
(55, 1000, 0, '2022-10-27 09:48:07', 1, 35),
(56, 50, 0, '2022-10-27 09:48:07', 3, 35);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `stock_pro_somme`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `stock_pro_somme`;
CREATE TABLE IF NOT EXISTS `stock_pro_somme` (
`som_entree` decimal(32,0)
,`som_sortie` decimal(32,0)
,`id_produit` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(225) NOT NULL,
  `postnom_user` varchar(225) NOT NULL,
  `prenom_user` varchar(225) NOT NULL,
  `telephone_user` varchar(20) NOT NULL,
  `email_user` varchar(225) NOT NULL,
  `sexe_user` varchar(10) NOT NULL,
  `login_user` varchar(225) NOT NULL,
  `password_user` varchar(225) NOT NULL,
  `etat_user` varchar(10) NOT NULL DEFAULT 'inactif',
  `id_privilege` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `id_privilege` (`id_privilege`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `nom_user`, `postnom_user`, `prenom_user`, `telephone_user`, `email_user`, `sexe_user`, `login_user`, `password_user`, `etat_user`, `id_privilege`) VALUES
(2, 'Ntambua', 'Luboya', 'Elysee', '0819664909', 'nel7luboya@gmail.com', 'M', 'nel7luboya@gmail.com', 'nel', 'actif', 1),
(3, 'Mubake', 'Wala', 'Jonathan', '0816565431', 'jn@gmail.com', 'M', 'jn@gmail.com', 'john', 'inactif', 2);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vw_journal_stock`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vw_journal_stock`;
CREATE TABLE IF NOT EXISTS `vw_journal_stock` (
`PRODUIT` int(11)
,`QTE` int(11)
,`DTE` datetime
,`TYPE_OP` varchar(6)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vw_union`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vw_union`;
CREATE TABLE IF NOT EXISTS `vw_union` (
`ID` varchar(1)
,`DTE` datetime
);

-- --------------------------------------------------------

--
-- Structure de la vue `details_bon`
--
DROP TABLE IF EXISTS `details_bon`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `details_bon`  AS  select `d`.`detail_bon_id` AS `detail_bon_id`,`d`.`quantite_detail_bon` AS `quantite_detail_bon`,`d`.`id_bon_livraison` AS `id_bon_livraison`,`d`.`id_produit` AS `id_produit`,`d`.`id_utilisateur` AS `id_utilisateur`,`p`.`produit_id` AS `produit_id`,`p`.`designation` AS `designation`,`p`.`barcode` AS `barcode`,`p`.`caracteristique` AS `caracteristique`,`p`.`nbre_par_pq` AS `nbre_par_pq`,`p`.`id_categorie` AS `id_categorie`,`c`.`categorie_id` AS `categorie_id`,`c`.`designation_cat` AS `designation_cat`,`c`.`description_cat` AS `description_cat`,`bon`.`bon_livraison_id` AS `bon_livraison_id`,`bon`.`numero_bon` AS `numero_bon`,`bon`.`date_livraison` AS `date_livraison`,`bon`.`lien_bon_image` AS `lien_bon_image`,`bon`.`id_fournisseur` AS `id_fournisseur`,`bon`.`id_commande` AS `id_commande` from (((`detail_bon_livraison` `d` left join `produit` `p` on((`d`.`id_produit` = `p`.`produit_id`))) left join `categorie` `c` on((`p`.`id_categorie` = `c`.`categorie_id`))) left join `bon_livraison` `bon` on((`d`.`id_bon_livraison` = `bon`.`bon_livraison_id`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `stock_pro_somme`
--
DROP TABLE IF EXISTS `stock_pro_somme`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stock_pro_somme`  AS  select sum(`stock`.`quantite`) AS `som_entree`,sum(`stock`.`quantite_sortie`) AS `som_sortie`,`stock`.`id_produit` AS `id_produit` from `stock` group by `stock`.`id_produit` ;

-- --------------------------------------------------------

--
-- Structure de la vue `vw_journal_stock`
--
DROP TABLE IF EXISTS `vw_journal_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_journal_stock`  AS  select `sortie_stock`.`id_produit` AS `PRODUIT`,`sortie_stock`.`qte_sortie` AS `QTE`,`sortie_stock`.`date_sortie` AS `DTE`,'Sortie' AS `TYPE_OP` from `sortie_stock` union select `detail_bon_livraison`.`id_produit` AS `PRODUIT`,`detail_bon_livraison`.`quantite_detail_bon` AS `QTE`,`bon_livraison`.`date_livraison` AS `DTE`,'Entrée' AS `TYPE_OP` from (`detail_bon_livraison` join `bon_livraison`) where (`bon_livraison`.`bon_livraison_id` = `detail_bon_livraison`.`id_bon_livraison`) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vw_union`
--
DROP TABLE IF EXISTS `vw_union`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_union`  AS  (select '1' AS `ID`,now() AS `DTE`) ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `action_privilege`
--
ALTER TABLE `action_privilege`
  ADD CONSTRAINT `action_privilege_ibfk_1` FOREIGN KEY (`id_action`) REFERENCES `actions` (`action_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `action_privilege_ibfk_2` FOREIGN KEY (`id_privilege`) REFERENCES `privilege` (`privilege_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `bon_livraison`
--
ALTER TABLE `bon_livraison`
  ADD CONSTRAINT `bon_livraison_ibfk_1` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`fournisseur_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `bon_livraison_ibfk_2` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`commande_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`fournisseur_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD CONSTRAINT `commande_produit_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`commande_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `commande_produit_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`produit_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `detail_bon_livraison`
--
ALTER TABLE `detail_bon_livraison`
  ADD CONSTRAINT `detail_bon_livraison_ibfk_1` FOREIGN KEY (`id_bon_livraison`) REFERENCES `bon_livraison` (`bon_livraison_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `detail_bon_livraison_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`produit_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `detail_bon_livraison_ibfk_3` FOREIGN KEY (`id_utilisateur`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`categorie_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `rapport_agent`
--
ALTER TABLE `rapport_agent`
  ADD CONSTRAINT `rapport_agent_ibfk_1` FOREIGN KEY (`id_site`) REFERENCES `site` (`site_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `rapport_agent_ibfk_2` FOREIGN KEY (`id_agent`) REFERENCES `agent` (`agent_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_ibfk_1` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`projet_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `site_ibfk_2` FOREIGN KEY (`id_province`) REFERENCES `province` (`province_id`);

--
-- Contraintes pour la table `sortie_stock`
--
ALTER TABLE `sortie_stock`
  ADD CONSTRAINT `sortie_stock_ibfk_1` FOREIGN KEY (`id_agent`) REFERENCES `agent` (`agent_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `sortie_stock_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`produit_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `sortie_stock_ibfk_3` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`projet_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `sortie_stock_ibfk_4` FOREIGN KEY (`id_utilisateur`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `sortie_stock_ibfk_5` FOREIGN KEY (`id_site`) REFERENCES `site` (`site_id`);

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`produit_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`id_bon_livraison`) REFERENCES `bon_livraison` (`bon_livraison_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_privilege`) REFERENCES `privilege` (`privilege_id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
