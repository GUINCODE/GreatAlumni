-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 18 juin 2021 à 11:06
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `greatalumni_1`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `titre` longtext,
  `texts` longtext,
  `media` text,
  `id_user` int(30) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COMMENT='contient tous les articles rediger par les users';

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `texts`, `media`, `id_user`, `date`) VALUES
(47, '', 'Sur cette photo, deux femmes,\r\nmême prénom, même nom, même passion !!! Elle s\'appelle Emma Bamba Camara et est Cheffe service entreprenariat numérique à Orange Guinée.\r\nMerci au Salon des Entrepreneurs de\r\nGuinée de permettre la mise en relation des Emma au carré !!!\r\nUne belle rencontre professionnelle :-)', '../images/medias_article/18_06_21_10_40_14_femme.jpg', 1, '2021-06-18 12:40:14'),
(48, 'INNOVATION', 'Un jeune guinée crée un jeux vidéo mettant en valeur la culture alfricaine, le projet à été bien acceuilli ', '../images/medias_article/18_06_21_10_44_56_thade.jpg', 1, '2021-06-18 12:44:56'),
(49, '#MAGNIFIQUE', '', '../images/medias_article/18_06_21_10_47_11_toghether.jpg', 10, '2021-06-18 12:47:11'),
(50, '', 'Bientôt le HEALTHSCAN (Version Pro-Max), une clinique portable qui permet les examens médicaux et la télésanté partout : maisons, villages, ambulances, avions, bateaux ... !\r\n#telesante #telemedicine #worldbankgroup #banquemondiale #PNUD #UNICEF #WHO #OMS #USAID #GIZ #UE', NULL, 10, '2021-06-18 12:47:58'),
(51, '', 'Très heureux et fier de vous annoncer la grande nouvelle  pour aider nos clients des services financiers dans l’accélération et le développement de leurs projets de #transformation à grande échelle . ', '../images/medias_article/18_06_21_10_50_34_heurux.jpg', 20, '2021-06-18 12:50:34'),
(52, '', '', '../images/medias_article/18_06_21_10_52_04_1624010367486.jpg', 20, '2021-06-18 12:52:04'),
(53, '', '????', '../images/medias_article/18_06_21_10_54_05_1623654058487.jpg', 20, '2021-06-18 12:54:05'),
(54, '', 'Quelle technologie et quelle architecture les entreprises aident-elles à devenir agiles à grande échelle ?\r\n Rejoignez lynskarp-séminaire mercredi 23.06, 12-12.30! https://lnkd.in/en_Vxug\r\n', NULL, 2, '2021-06-18 12:56:01'),
(55, '', 'Les jeunes dans les études commerciales en alternance et souhaitent découvrir les belles entreprises technologiques ? Brest Business School leur offre des belles opportunités avec son super réseau de partenaires notamment\r\nLes jeunes dans les études commerciales en alternance et souhaitent découvrir les belles entreprises technologiques ? Brest Business School leur offre des belles opportunités avec son super réseau de partenaires notamment', NULL, 2, '2021-06-18 12:57:03');

-- --------------------------------------------------------

--
-- Structure de la table `article_votes`
--

DROP TABLE IF EXISTS `article_votes`;
CREATE TABLE IF NOT EXISTS `article_votes` (
  `id` int(35) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=203 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article_votes`
--

INSERT INTO `article_votes` (`id`, `id_article`, `id_user`) VALUES
(202, 53, 1),
(201, 55, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `texts` varchar(255) NOT NULL,
  `id_article` int(30) NOT NULL,
  `id_user` int(30) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `texts`, `id_article`, `id_user`, `date`) VALUES
(71, 'hh', 40, 8, '2021-05-25 13:39:47'),
(72, 'nice bro', 40, 8, '2021-05-29 22:43:45'),
(73, 'mal', 42, 8, '2021-05-30 00:41:20'),
(74, 'nice jo', 39, 25, '2021-06-06 12:03:18'),
(75, 'yess', 39, 1, '2021-06-06 12:12:51'),
(76, 'j\'aime ce truc', 44, 20, '2021-06-06 12:52:40'),
(77, 'on est de dans 000h', 44, 1, '2021-06-06 13:02:50'),
(78, 'banal', 44, 8, '2021-06-09 23:40:53'),
(79, 'ggsgs', 44, 1, '2021-06-10 12:31:54'),
(80, 'ohhh my gog', 39, 1, '2021-06-10 13:37:00'),
(81, 'my darkl ife ', 45, 1, '2021-06-10 13:39:52'),
(82, 'ohhh cool', 45, 10, '2021-06-13 20:08:12'),
(83, 'cool', 55, 1, '2021-06-18 13:02:48');

-- --------------------------------------------------------

--
-- Structure de la table `cursusscolaire`
--

DROP TABLE IF EXISTS `cursusscolaire`;
CREATE TABLE IF NOT EXISTS `cursusscolaire` (
  `id` int(35) NOT NULL AUTO_INCREMENT,
  `id_user` int(35) NOT NULL,
  `annee` int(35) NOT NULL,
  `formation` varchar(255) NOT NULL,
  `etablissement` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cursusscolaire`
--

INSERT INTO `cursusscolaire` (`id`, `id_user`, `annee`, `formation`, `etablissement`) VALUES
(1, 10, 2016, 'Baccalaureat S', 'GLC'),
(2, 10, 2019, 'BTS SIO SLAM 2', 'ENSITECH G'),
(3, 10, 2020, 'Master Ingenieri logiciel', 'ESSIA'),
(5, 10, 2015, 'Baccalaureat Sc', 'Lycee General Lansana'),
(6, 20, 2017, 'Igenierie logicielle ', 'GREATCOM +'),
(9, 1, 2021, 'Bachelor developpeur web et mobile ', 'INTECH'),
(10, 1, 2020, 'BTS SSII', 'ENSITECH');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `titre` longtext NOT NULL,
  `sub_titre` longtext NOT NULL,
  `descriptions` longtext NOT NULL,
  `image_path` text,
  `dates` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id`, `titre`, `sub_titre`, `descriptions`, `image_path`, `dates`) VALUES
(26, 'RENCONTRE ENTREPRISES ET ETUDIANS', 'L’IMPACT DE DEUX PROJETS DE SESSION SUR LES PERCEPTIONS ET INTENTIONS ENTREPRENEURIALES D’ÉTUDIANTS EN ADMINISTRATION', 'Bien qu’il existe une tradition de l’enseignement de l’entrepreneuriat au Canada, l’impact des différentes méthodes utilisées pour cet enseignement reste méconnu. La présente étude vise à vérifier dans quelle mesure deux approches pédagogiques différentes, soit un plan d’affaires et l’étude/terrain d’une PME, peuvent avoir un impact d’une part, sur les perceptions des étudiants de la désirabilité et de la faisabilité de créer leur propre entreprise et, d’autre part, sur leur intention de partir en affaires. Les résultats démontrent qu’il n’y a pas de différence en termes de changement de perceptions mais que le plan d’affaires a davantage d’impact sur l’intention de partir en affaires, cet impact étant toutefois négatif. Par contre, on note une amélioration de la perception de faisabilité chez l’ensemble des étudiants. Un des bénéfices de ce cours serait de ramener à un niveau plus près de la réalité les perceptions des étudiants face à une carrière entrepreneuriale.', '../images/medias_evenement/18_06_21_10_25_15_Afterwork-recrutement-BBA-INSEEC.jpg', '2021-08-06'),
(25, 'L\'ADEMEC SE JOINT AUX FESTIVITÉS DU BICENTENAIRE DE L\'ÉCOLE DES CHARTES, ET ORGANISE SON HACKATHON LES 25 ET 26 SEPTEMBRE 2021 !', 'À L’OCCASION DU BICENTENAIRE DE L’ÉCOLE NATIONALE DES CHARTES, L’ASSOCIATION DES DIPLÔMÉS DES MASTERS (ADEMEC), EN PARTENARIAT ET AVEC L’AIDE DE L’ÉCOLE, VOUS CONVIE AU “HACKATHON BICENTENAIRE” !', 'À l’occasion du bicentenaire de l’École nationale des chartes, l’association des diplômés des masters (ADEMEC), en partenariat et avec l’aide de l’École, vous convie au “Hackathon bicentenaire” !\r\n\r\nVotre challenge, si vous l’acceptez : Archives, publications, témoignages de l’activité passée ou récente de l’École seront mis à la disposition des participants. Votre défi ? Valoriser, diffuser, ou tout simplement découvrir l’histoire de l’École au travers des jeux de données sélectionnés.', '../images/medias_evenement/18_06_21_10_23_02_hackathon.png', '2021-07-15'),
(27, 'PROMENADE DANS LA FORÊT   BOIS D\'ARCY ', 'RANDONNÉE : LE TOUR DE LA FORÊT DE BOIS D\'ARCY 18 KM', 'Le rendez vous est à 11h à la sortie de la gare de villepreux, le train est à 10h20 en gare Montparnasse et il se trouve en general entre les quais 10 et 17, arrêt \"Villepreux\". Vous pouvez tous vous retrouver dans le 1er compartiment du train en arrivant sur le quai. Pour ceux qui viennent en voiture il y a un parking gratuit à la gare. C\'est une boucle, le retour se fera à la gare de Villepreux\r\n\r\nPassage par :\r\n- le parc de Diane de Poitiers\r\n- les vestiges du château des Clayes sous bois\r\n- l\'arbre de Diane\r\n- la foret de Bois d\'Arcy\r\n- l\'étang de la Cranne\r\n.... et plein d\'autres endroits\r\n4 villes : Les Clayes sous bois, Villepreux, Bois d\'arcy, Plaisir\r\n\r\nUn peu d\'histoire... Diane de Poitiers : https://www.lefigaro.fr/sciences-technologies/2009/12/23/01030-20091223ARTFIG00013-diane-de-poitiers-morte-d-avoir-voulu-rester-jeune-.php\r\n\r\nRythme : 4,5 à 4,9 km heure minimum (ni lent, ni rapide). Attention c\'est une randonnée pas une promenade\r\n\r\nSi vous avez un pass navigo le transport est gratuit\r\n\r\nDépart : Gare de Villepreux Les Clayes\r\nRetour : Gare de Villepreux Les Clayes\r\n\r\nIl ne faut pas oublier son pique nique\r\n\r\nPrice / Prix : 8 euros ***\r\n(si possible il faut avoir la monnaie)\r\n(Tarif étudiant(e)s âgé(e)s de 18/25 ans de 5 euros sur justificatif)\r\n\r\nVous pouvez aussi nous rejoindre sur le Groupe whatsapp[masked] pour recevoir le programme de la semaine ou du mois et pour obtenir des informations avant, pendant et après l\' événement, comme par exemple la localisation du groupe quand il se déplace. Cela peut-être important si vous arrivez en retard et c\'est idéal pour obtenir des photos après la sortie des autres participants :\r\nhttps://chat.whatsapp.com/ETcdDpOtZSO7Dj7wQG8AXT\r\n1700 membres\r\n\r\nSur le Groupe Facebook :\r\nhttps://www.facebook.com/groups/623810244672702/?source_id=502794083233420\r\n9300 membres\r\n\r\nSur la Page Facebook :\r\nhttps://www.facebook.com/christophemeetup/\r\n1200 suiveurs / suiveuses\r\n\r\nSur Instagram pour voir les photos des événements passés :\r\nhttps://www.instagram.com/pariseventsmeetup/?hl=fr', '../images/medias_evenement/18_06_21_10_30_21_ae8a480fce-50160782-environnement-naturel-baisse-stress-3.jpg', '2021-06-24'),
(28, 'PARCOURSUP', 'PARCOURSUP : OUVERTURE DE LA PHASE COMPLÉMENTAIRE MERCREDI 16 JUIN À 14 HEURES (HEURE DE PARIS)\r\n', 'Destinée en particulier aux candidats n\'ayant pas encore reçu de proposition d\'admission, la phase complémentaire permet aux candidats qui le souhaitent de formuler de nouveaux vœux dans des formations qui ont des places disponibles et de recevoir des propositions d’admission au fur et à mesure des candidatures. Dès le 16 juin, ils pourront consulter, via le moteur de recherche Parcoursup, les formations proposées en phase complémentaire et formuler jusqu’à 10 nouveaux vœux. \r\n\r\nLe nombre de formations disponibles va augmenter progressivement. Dès aujourd’hui, près de 4 200 formations seront proposées. La liste des formations proposant des places sera actualisée chaque jour. En 2020, plus de 85 000 candidats avaient pu recevoir une proposition d’admission dans une formation de leur choix dans le cadre de la phase complémentaire.\r\n\r\nPar ailleurs, il est rappelé que plus de 6 000 formations en apprentissage sont proposées sur la plateforme pour lesquelles les candidats peuvent formuler jusqu’à 10 vœux depuis le 20 janvier et être accompagnés afin de trouver un employeur.\r\n\r\nDes ressources sur la phase complémentaire sont mises à disposition de tous : ', '../images/medias_evenement/18_06_21_10_36_57_conference-de-presse-de-rentree-2019-2020-1600x640.jpg', '2021-06-23');

-- --------------------------------------------------------

--
-- Structure de la table `hobbies`
--

DROP TABLE IF EXISTS `hobbies`;
CREATE TABLE IF NOT EXISTS `hobbies` (
  `id` int(35) NOT NULL AUTO_INCREMENT,
  `id_user` int(35) NOT NULL,
  `hobbie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `hobbies`
--

INSERT INTO `hobbies` (`id`, `id_user`, `hobbie`) VALUES
(1, 10, 'Jeux videos'),
(2, 10, 'Natation'),
(3, 10, 'FootBall'),
(6, 1, 'Lecture'),
(7, 1, 'jeux videos');

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

DROP TABLE IF EXISTS `messagerie`;
CREATE TABLE IF NOT EXISTS `messagerie` (
  `id` int(35) NOT NULL AUTO_INCREMENT,
  `texts` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` enum('lus','non_lus') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non_lus',
  `id_expeditaire` int(35) NOT NULL,
  `id_destinataire` int(35) NOT NULL,
  `dates` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `texts`, `statut`, `id_expeditaire`, `id_destinataire`, `dates`) VALUES
(1, 'Bonjour Mec, j\'ais fini de coder la partie back-end du projet, tu sera disponible le soir , pourque je te montre ceque j\'ai fais', 'lus', 3, 8, '2021-05-26 20:30:03'),
(2, 'salut', 'lus', 9, 8, '2021-05-26 20:33:15'),
(3, 'on a terminer mon gars', 'lus', 9, 8, '2021-05-26 20:33:15'),
(4, 'salut bro', 'non_lus', 1, 2, '2021-05-28 10:57:31'),
(5, 'ouui mec', 'lus', 2, 1, '2021-05-28 10:57:31'),
(6, 'ok mec c genial, big up', 'lus', 8, 3, '2021-05-28 11:49:26'),
(7, 'je serais disponible a 15h jeune', 'lus', 8, 3, '2021-05-28 11:59:31'),
(8, 'ok jeune, suis dispo apartir de 15 wessshhhs', 'lus', 8, 3, '2021-05-28 12:00:03'),
(9, 'cela me va jeune roi', 'lus', 3, 8, '2021-05-28 12:00:29'),
(10, 'suis là pote, tu es ouuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu', 'lus', 8, 3, '2021-05-28 12:01:55'),
(11, 'wait 30 seconde please', 'lus', 3, 8, '2021-05-28 12:02:44'),
(12, 'ok, mais envoi mois le truc, je vais regarder en attendant jeune roi.\r\nNe fais pas le connnnnnnnn ...\r\nwesssH....\r\n', 'lus', 8, 3, '2021-05-28 12:30:31'),
(13, 'salut nass', 'lus', 8, 10, '2021-05-28 15:14:18'),
(35, 'alloh', 'lus', 8, 1, '2021-05-30 13:04:25'),
(34, '???', 'non_lus', 8, 3, '2021-05-30 12:47:38'),
(33, 'tu blague', 'non_lus', 8, 3, '2021-05-30 12:20:25'),
(17, 'yeahh how are u', 'lus', 3, 8, '2021-05-29 00:52:09'),
(18, 'come on mc', 'non_lus', 8, 9, '2021-05-29 00:54:20'),
(19, 'on est chaud............', 'lus', 10, 8, '2021-05-29 02:39:05'),
(20, 'hay tu as remarque nn', 'lus', 10, 8, '2021-05-29 02:39:58'),
(21, 'ah ouais je te le dis pas hein\nfaut sciencé solomangt', 'lus', 8, 10, '2021-05-29 02:41:24'),
(22, 'tu reponds quoi toi', 'lus', 3, 8, '2021-05-29 13:05:19'),
(23, 'mec un test de tri', 'lus', 9, 8, '2021-05-29 13:06:33'),
(24, 'jojo de oro milieu', 'lus', 10, 8, '2021-05-29 13:08:00'),
(25, 'tu racontes quoi meme', 'lus', 8, 10, '2021-05-29 13:17:43'),
(26, 'Alors on dit quoi', 'lus', 8, 1, '2021-05-29 14:47:02'),
(27, 'je suis la jeune', 'lus', 8, 1, '2021-05-29 18:58:45'),
(32, 'hahah', 'non_lus', 8, 3, '2021-05-30 12:01:59'),
(29, 'ohh yes calmos', 'lus', 10, 8, '2021-05-29 19:02:47'),
(30, 'waittttttttttttttttttt', 'lus', 8, 3, '2021-05-29 19:06:08'),
(31, 'on est ensemble bro', 'lus', 3, 8, '2021-05-29 19:08:07'),
(36, 'yes', 'non_lus', 8, 3, '2021-05-30 23:19:47'),
(37, 'yis', 'non_lus', 8, 9, '2021-05-30 23:20:54'),
(38, 'dad', 'non_lus', 8, 9, '2021-05-30 23:21:24'),
(39, 'konkon\n', 'lus', 8, 1, '2021-05-31 01:17:04'),
(40, 'CAVA', 'non_lus', 1, 2, '2021-06-06 17:14:49'),
(41, 'YES', 'lus', 1, 8, '2021-06-06 17:15:38'),
(42, 'salut', 'lus', 8, 1, '2021-06-09 22:55:00'),
(43, 'ouai c comment', 'lus', 1, 8, '2021-06-09 22:55:20'),
(44, 'tranquil jeune ', 'lus', 8, 1, '2021-06-09 22:55:53'),
(45, 'quoi de bon', 'lus', 1, 8, '2021-06-09 22:56:08'),
(46, 'gg', 'lus', 8, 1, '2021-06-09 23:12:13'),
(47, 'salut', 'non_lus', 1, 25, '2021-06-10 12:38:26'),
(48, 'salut', 'lus', 20, 10, '2021-06-18 10:51:21'),
(49, 'comment tu va ', 'lus', 10, 20, '2021-06-18 10:51:49');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `resume` varchar(255) NOT NULL,
  `type` enum('message','evenement','autre') NOT NULL DEFAULT 'autre',
  `id_user` int(30) NOT NULL,
  `vue` enum('oui','non') NOT NULL DEFAULT 'non',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `resume`, `type`, `id_user`, `vue`, `date`) VALUES
(82, 'notif eve', 'evenement', 21, 'non', '2021-06-18 12:25:15'),
(81, 'notif eve', 'evenement', 20, 'non', '2021-06-18 12:25:15'),
(80, 'notif eve', 'evenement', 19, 'non', '2021-06-18 12:25:15'),
(79, 'notif eve', 'evenement', 18, 'non', '2021-06-18 12:25:15'),
(78, 'notif eve', 'evenement', 17, 'non', '2021-06-18 12:25:15'),
(77, 'notif eve', 'evenement', 16, 'non', '2021-06-18 12:25:15'),
(76, 'notif eve', 'evenement', 10, 'non', '2021-06-18 12:25:15'),
(75, 'notif eve', 'evenement', 9, 'non', '2021-06-18 12:25:15'),
(74, 'notif eve', 'evenement', 8, 'non', '2021-06-18 12:25:15'),
(73, 'notif eve', 'evenement', 3, 'non', '2021-06-18 12:25:15'),
(72, 'notif eve', 'evenement', 2, 'non', '2021-06-18 12:25:15'),
(71, 'notif eve', 'evenement', 26, 'non', '2021-06-18 12:23:02'),
(70, 'notif eve', 'evenement', 25, 'non', '2021-06-18 12:23:02'),
(69, 'notif eve', 'evenement', 24, 'non', '2021-06-18 12:23:02'),
(68, 'notif eve', 'evenement', 22, 'non', '2021-06-18 12:23:02'),
(67, 'notif eve', 'evenement', 21, 'non', '2021-06-18 12:23:02'),
(66, 'notif eve', 'evenement', 20, 'non', '2021-06-18 12:23:02'),
(65, 'notif eve', 'evenement', 19, 'non', '2021-06-18 12:23:02'),
(64, 'notif eve', 'evenement', 18, 'non', '2021-06-18 12:23:02'),
(63, 'notif eve', 'evenement', 17, 'non', '2021-06-18 12:23:02'),
(62, 'notif eve', 'evenement', 16, 'non', '2021-06-18 12:23:02'),
(61, 'notif eve', 'evenement', 10, 'non', '2021-06-18 12:23:02'),
(60, 'notif eve', 'evenement', 9, 'non', '2021-06-18 12:23:02'),
(59, 'notif eve', 'evenement', 8, 'non', '2021-06-18 12:23:02'),
(58, 'notif eve', 'evenement', 3, 'non', '2021-06-18 12:23:02'),
(57, 'notif eve', 'evenement', 2, 'non', '2021-06-18 12:23:02'),
(27, 'notif autre', 'autre', 1, 'oui', '2021-06-18 11:25:55'),
(28, 'notif autre', 'autre', 2, 'non', '2021-06-18 11:25:55'),
(29, 'notif autre', 'autre', 3, 'non', '2021-06-18 11:25:55'),
(30, 'notif autre', 'autre', 8, 'non', '2021-06-18 11:25:55'),
(31, 'notif autre', 'autre', 9, 'non', '2021-06-18 11:25:55'),
(32, 'notif autre', 'autre', 16, 'non', '2021-06-18 11:25:55'),
(33, 'notif autre', 'autre', 17, 'non', '2021-06-18 11:25:55'),
(34, 'notif autre', 'autre', 18, 'non', '2021-06-18 11:25:55'),
(35, 'notif autre', 'autre', 19, 'non', '2021-06-18 11:25:55'),
(36, 'notif autre', 'autre', 20, 'non', '2021-06-18 11:25:55'),
(37, 'notif autre', 'autre', 21, 'non', '2021-06-18 11:25:55'),
(38, 'notif autre', 'autre', 22, 'non', '2021-06-18 11:25:55'),
(39, 'notif autre', 'autre', 24, 'non', '2021-06-18 11:25:55'),
(40, 'notif autre', 'autre', 25, 'non', '2021-06-18 11:25:55'),
(41, 'notif autre', 'autre', 26, 'non', '2021-06-18 11:25:55'),
(42, 'notif eve', 'evenement', 2, 'non', '2021-06-18 11:53:23'),
(43, 'notif eve', 'evenement', 3, 'non', '2021-06-18 11:53:23'),
(44, 'notif eve', 'evenement', 8, 'non', '2021-06-18 11:53:23'),
(45, 'notif eve', 'evenement', 9, 'non', '2021-06-18 11:53:23'),
(46, 'notif eve', 'evenement', 10, 'oui', '2021-06-18 11:53:23'),
(47, 'notif eve', 'evenement', 16, 'non', '2021-06-18 11:53:23'),
(48, 'notif eve', 'evenement', 17, 'non', '2021-06-18 11:53:23'),
(49, 'notif eve', 'evenement', 18, 'non', '2021-06-18 11:53:23'),
(50, 'notif eve', 'evenement', 19, 'non', '2021-06-18 11:53:23'),
(51, 'notif eve', 'evenement', 20, 'non', '2021-06-18 11:53:23'),
(52, 'notif eve', 'evenement', 21, 'non', '2021-06-18 11:53:23'),
(53, 'notif eve', 'evenement', 22, 'non', '2021-06-18 11:53:23'),
(54, 'notif eve', 'evenement', 24, 'non', '2021-06-18 11:53:23'),
(55, 'notif eve', 'evenement', 25, 'non', '2021-06-18 11:53:23'),
(56, 'notif eve', 'evenement', 26, 'non', '2021-06-18 11:53:23'),
(83, 'notif eve', 'evenement', 22, 'non', '2021-06-18 12:25:15'),
(84, 'notif eve', 'evenement', 24, 'non', '2021-06-18 12:25:15'),
(85, 'notif eve', 'evenement', 25, 'non', '2021-06-18 12:25:15'),
(86, 'notif eve', 'evenement', 26, 'non', '2021-06-18 12:25:15'),
(87, 'notif eve', 'evenement', 2, 'non', '2021-06-18 12:30:21'),
(88, 'notif eve', 'evenement', 3, 'non', '2021-06-18 12:30:21'),
(89, 'notif eve', 'evenement', 8, 'non', '2021-06-18 12:30:21'),
(90, 'notif eve', 'evenement', 9, 'non', '2021-06-18 12:30:21'),
(91, 'notif eve', 'evenement', 10, 'non', '2021-06-18 12:30:21'),
(92, 'notif eve', 'evenement', 16, 'non', '2021-06-18 12:30:21'),
(93, 'notif eve', 'evenement', 17, 'non', '2021-06-18 12:30:21'),
(94, 'notif eve', 'evenement', 18, 'non', '2021-06-18 12:30:21'),
(95, 'notif eve', 'evenement', 19, 'non', '2021-06-18 12:30:21'),
(96, 'notif eve', 'evenement', 20, 'non', '2021-06-18 12:30:21'),
(97, 'notif eve', 'evenement', 21, 'non', '2021-06-18 12:30:21'),
(98, 'notif eve', 'evenement', 22, 'non', '2021-06-18 12:30:21'),
(99, 'notif eve', 'evenement', 24, 'non', '2021-06-18 12:30:21'),
(100, 'notif eve', 'evenement', 25, 'non', '2021-06-18 12:30:21'),
(101, 'notif eve', 'evenement', 26, 'non', '2021-06-18 12:30:21'),
(102, 'notif eve', 'evenement', 2, 'non', '2021-06-18 12:36:57'),
(103, 'notif eve', 'evenement', 3, 'non', '2021-06-18 12:36:57'),
(104, 'notif eve', 'evenement', 8, 'non', '2021-06-18 12:36:57'),
(105, 'notif eve', 'evenement', 9, 'non', '2021-06-18 12:36:57'),
(106, 'notif eve', 'evenement', 10, 'non', '2021-06-18 12:36:57'),
(107, 'notif eve', 'evenement', 16, 'non', '2021-06-18 12:36:57'),
(108, 'notif eve', 'evenement', 17, 'non', '2021-06-18 12:36:57'),
(109, 'notif eve', 'evenement', 18, 'non', '2021-06-18 12:36:57'),
(110, 'notif eve', 'evenement', 19, 'non', '2021-06-18 12:36:57'),
(111, 'notif eve', 'evenement', 20, 'non', '2021-06-18 12:36:57'),
(112, 'notif eve', 'evenement', 21, 'non', '2021-06-18 12:36:57'),
(113, 'notif eve', 'evenement', 22, 'non', '2021-06-18 12:36:57'),
(114, 'notif eve', 'evenement', 24, 'non', '2021-06-18 12:36:57'),
(115, 'notif eve', 'evenement', 25, 'non', '2021-06-18 12:36:57'),
(116, 'notif eve', 'evenement', 26, 'non', '2021-06-18 12:36:57');

-- --------------------------------------------------------

--
-- Structure de la table `parcousprofessionnel`
--

DROP TABLE IF EXISTS `parcousprofessionnel`;
CREATE TABLE IF NOT EXISTS `parcousprofessionnel` (
  `id` int(35) NOT NULL AUTO_INCREMENT,
  `id_user` int(35) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `post_occupe` varchar(255) NOT NULL,
  `type_emploi` varchar(255) NOT NULL,
  `entreprise` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `parcousprofessionnel`
--

INSERT INTO `parcousprofessionnel` (`id`, `id_user`, `date_debut`, `date_fin`, `post_occupe`, `type_emploi`, `entreprise`) VALUES
(1, 10, '2020-02-04', '2020-06-04', 'Developpeur web', 'stage', 'LARTECH'),
(2, 10, '2021-04-20', '2021-06-12', 'developpeur front-end ', 'CDD', 'GRAYSOFT'),
(3, 10, '2019-02-19', '2019-08-19', 'développeur front-end', 'stage', 'MARION HUB '),
(4, 1, '2021-04-21', '2021-06-08', 'developpeur web', 'stage/alternance', 'webforce'),
(5, 1, '2020-11-03', '2021-06-11', 'INGENIEUR DE SON', 'stage/alternance', 'GUICOPRES');

-- --------------------------------------------------------

--
-- Structure de la table `partages`
--

DROP TABLE IF EXISTS `partages`;
CREATE TABLE IF NOT EXISTS `partages` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `id_user` int(30) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `partages`
--

INSERT INTO `partages` (`id`, `id_user`, `titre`, `text`, `date`) VALUES
(6, 1, 'UNE EXPÉRIENCE DIFFÉRENTE DE TOUT CE QUI EXISTE PAR AILLEURS  THOMAS MENJOT S’EST LANCÉ DANS UNE EXPÉRIENCE DE CODÉVELOPPEMENT FRUCTUEUSE. IL EN TIRE UN VRAI BÉNÉFICE PROFESSIONNEL ET PERSONNEL ', 'Depuis 2 ans maintenant, notre groupe se retrouve dans le cadre du « codéveloppement ».\r\n\r\nC’est un moment d’échange entre un membre du groupe (le client) ayant un sujet précis et les autres participants.\r\n\r\nAprès avoir exposé son sujet et présenté son entreprise, guidés par un animateur, les membres du groupe devront questionner le client par un jeu de questions ouvertes, de reformulations et de « si j’étais à ta place, je ferais… ». Chacun prend la parole à tour de rôle, dans un respect mutuel.\r\n\r\nUn vrai enrichissement mutuel\r\n\r\n \r\n\r\nLe fruit de ces questions et mises en situation permettra au client de nourrir son sujet et de lui apporter non pas avec une solution à son sujet mais un ensemble de réflexions.\r\n\r\nMême si une réunion de codéveloppement traite un sujet particulier, on s’aperçoit qu’au terme de la séance, chacun des membres du groupe donne, mais reçoit aussi beaucoup.\r\n\r\nLes échanges et expériences vécues et partagées par chacun permettent un vrai moment d’enrichissement intellectuel.\r\n\r\n \r\n\r\nC’est constructif et très plaisant\r\n\r\nC’est un véritable moment d’expression, d’écoute, sans aucun jugement et très pragmatique ce qui change de beaucoup d’autres formations que l’on peut rencontrer.\r\n\r\nAprès deux années de codéveloppement, je peux dire avec un peu de recul que cette démarche est très bénéfique et permet à chaque participant de faire avancer certains sujets de manière très accélérée.\r\n\r\nC’est avec plaisir que je continue le codéveloppement, que j’ai plaisir à retrouver chaque membre du groupe et conseille à toute personne que cela intéresserait à participer à une séance.', '2021-06-18 13:01:58'),
(5, 10, 'SÉVERINE PONTEINS EST PARVENUE À LEVER LA TÊTE DU GUIDON GRÂCE À UNE EXPÉRIENCE DE CODÉVELOPPEMENT EXTRÊMEMENT CONSTRUCTIVE. ', 'Directrice d’hôtels restaurants durant 20 ans, j’ai bien connu ces moments de solitude et délicats qui font partis de la vie professionnelle et dans lesquels de nombreux managers ou dirigeants, dont j’ai fait partie, finissent par avoir la « tête dans le guidon » et se retrouvent bloqués pour prendre « la bonne décision » face à des situations problématiques. Je n’avais pas cette prise de recul objective et nécessaire à cette décision.\r\n\r\nDurant mon activité, j’ai participé à plusieurs ateliers de codéveloppement et à chaque fois, j’en suis ressortie riche en expérience et en partage même si la problématique du jour n’était pas la mienne.\r\n\r\n \r\n\r\nJe ne suis pas seule\r\n\r\nParticiper à ces codéveloppements et rencontrer d’autres personnes de divers milieux professionnels et ayant un cadre de références différent du mien, m’a permis plusieurs avancées. Dans un premier temps, j’ai pu constater que malgré nos environnements différents, nous pouvions rencontrer des problématiques similaires. Je me suis dit : « je ne suis pas la seule à vivre cela ». Dans un second temps, j’ai réalisé que « ma solution » n’était pas unique. Pour moi, le codéveloppement va plus loin que de simples échanges, c’est un outil d’entraide, de réflexion, de partage ou l’intelligence collective, au service de la problématique de chacun des participants.\r\n\r\nChacun est là pour apporter une solution, sa propre vision sur la situation mais surtout son soutien.\r\n\r\nCes échanges lucratifs, m’ont permis de revoir certaines de mes positions et d’élargir mon esprit à d’autres possibilités et de vaincre cet isolement.  C’est pour moi « La force du codéveloppement ».\r\n\r\nAujourd’hui, je suis formatrice en management et coach en entreprise. Je souhaite me former et me développer en tant qu’animatrice de codéveloppement, tant je trouve cet outil performant ', '2021-06-18 13:00:04');

-- --------------------------------------------------------

--
-- Structure de la table `reponse_sujet`
--

DROP TABLE IF EXISTS `reponse_sujet`;
CREATE TABLE IF NOT EXISTS `reponse_sujet` (
  `id` int(35) NOT NULL AUTO_INCREMENT,
  `id_sujet` int(35) NOT NULL,
  `reponse` longtext NOT NULL,
  `id_repondeur` int(35) NOT NULL,
  `date_rep` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reponse_sujet`
--

INSERT INTO `reponse_sujet` (`id`, `id_sujet`, `reponse`, `id_repondeur`, `date_rep`) VALUES
(1, 1, 'tape sur gooooooooooooogle riiiiir', 8, '2021-06-17 01:18:06'),
(2, 1, 'wesssh pdo rsr', 10, '2021-06-17 01:18:06'),
(3, 1, 'hoohp i dont know', 1, '2021-06-17 04:52:54'),
(4, 1, 'consulte ce lien https://www.php.net/manual/fr/book.pdo.php tu va trouver peut etre ta reposnse ', 8, '2021-06-17 05:04:51'),
(13, 3, 'Si vous avez un usage plus poussé avec l\'utilisation de fonctions comme la photo ou le multimédia, un smartphone moyen de gamme sera plus adapté (entre 200 et 400 €). Dotés de meilleurs capteurs et plus puissants, ils constituent un bon équilibre entre budget raisonné et performances.', 1, '2021-06-17 17:53:25'),
(14, 3, 'Ok merci \n', 20, '2021-06-17 18:08:02');

-- --------------------------------------------------------

--
-- Structure de la table `report_post`
--

DROP TABLE IF EXISTS `report_post`;
CREATE TABLE IF NOT EXISTS `report_post` (
  `id` int(35) NOT NULL AUTO_INCREMENT,
  `id_signaleur` int(35) NOT NULL,
  `id_auteur_post` int(35) NOT NULL,
  `id_post` int(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `report_user`
--

DROP TABLE IF EXISTS `report_user`;
CREATE TABLE IF NOT EXISTS `report_user` (
  `id` int(35) NOT NULL AUTO_INCREMENT,
  `id_signaleur` int(35) NOT NULL,
  `id_signaler` int(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sujet_forum`
--

DROP TABLE IF EXISTS `sujet_forum`;
CREATE TABLE IF NOT EXISTS `sujet_forum` (
  `id` int(35) NOT NULL AUTO_INCREMENT,
  `titre` longtext NOT NULL,
  `categorie` enum('emploi','stage','juridique','divers') NOT NULL DEFAULT 'divers',
  `id_auteur` int(11) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sujet_forum`
--

INSERT INTO `sujet_forum` (`id`, `titre`, `categorie`, `id_auteur`, `date_creation`) VALUES
(1, 'Difference entre PDO et l\'autre', 'divers', 1, '2021-06-17 01:16:44'),
(2, 'juris prudence a votre avis sert a quoi', 'juridique', 8, '2021-06-17 01:20:12'),
(3, 'Les appareils Android les plus répandus sont les smartphones et les tablettes. En cas de problème ou tout autre question ce forum accueille les sujets sur les appareils fonctionnant sous le système de Google.', 'divers', 1, '2021-06-17 13:33:16'),
(4, 'Comment choisir l\'appareil qui fera votre bonheur ? quelle config choisir ? Demandez conseils aux experts !', 'divers', 1, '2021-06-17 13:35:35'),
(5, 'Difference entre BAC PRO ET BAC SVP', 'divers', 10, '2021-06-18 11:24:57'),
(6, 'Difference entre BAC PRO ET BAC SVP ', 'divers', 10, '2021-06-18 11:25:55');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `Photo` text,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `Mail` varchar(255) DEFAULT NULL,
  `Departement` int(11) DEFAULT NULL,
  `Annee_promotion` int(10) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `campus` varchar(255) DEFAULT NULL,
  `Zone_de_texte` longtext,
  `Loginn` varchar(50) DEFAULT NULL,
  `Mdp` varchar(50) DEFAULT NULL,
  `Typee` enum('standard','admin') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `Photo`, `Nom`, `Prenom`, `Mail`, `Departement`, `Annee_promotion`, `profession`, `campus`, `Zone_de_texte`, `Loginn`, `Mdp`, `Typee`) VALUES
(1, '../images/medias_users/16_06_21_12_05_16_black.jpg', 'Mansour', 'Guisen', 'babab@gmailx.com', 78, 2019, 'Ingenieru Architecte', 'campus1', ' Si tu aimes la vie ne prodigue pas le temps, c\'est l\'étoffe dont la vie est faite. ', 'ADMIN', 'PSW', 'admin'),
(2, NULL, 'ERWAN', 'NIALON', 'erwan@gmail.com', 98, 2017, NULL, 'campus1', 'test zone de text test zone de text ', 'psw', 'erw@log', 'admin'),
(3, '../images/medias_users/pogba.png', 'POGBA', 'PAUL', 'only_ou@gmail.com', 75, 2014, 'Ingenieur de logiciel chez MARION UP', 'campus1', 'Si l\'humour doit séduire par sa forme, il doit aussi bien convaincre ou informer par son fond', 'paul', 'paul', 'standard'),
(8, NULL, 'VAN', 'VICKER', 'alpho@gmail.com', 91, 2002, NULL, 'campus2', 'ghdgd', 'thor', 'thor', 'admin'),
(9, NULL, 'Sankhon', 'Oumar', 'ferar@gmail.com', 92, 2019, NULL, 'campus2', 'ma zone de text mon oeil', 'sankhon', 'sankhon', 'admin'),
(10, '../images/medias_users/nasri_profil.jpg', 'SAMIR', 'TARECK', 'samir@gmail.com', 78, 2020, 'Ingenieur logiciel  chez FUNTECH 224', 'campus3', 'my citation is lost\r\n', 'samir', 'PSW', 'standard'),
(16, NULL, 'Djanii', 'Alpha', 'djani@gmail.com', NULL, 2001, NULL, 'campus2', NULL, 'DjaLog', 'password@hdhd', 'standard'),
(17, NULL, 'KANTE', 'NGOLO', 'kanate@golo.com', NULL, 2006, NULL, 'campus3', NULL, 'NKante', 'password@2021', 'admin'),
(18, NULL, 'DUPOND', 'CLEMENT', 'clem@gmail.com', NULL, 2020, NULL, NULL, NULL, 'Clems2021', 'password@2021', 'admin'),
(19, NULL, 'Djoumade', 'SANKARA', 'djouma@gmai.com', NULL, 2001, NULL, NULL, NULL, 'UPRs2$ecZC', 'h6CXkdc*kv', 'standard'),
(20, '../images/medias_users/15_06_21_09_41_41_taiss.jpg', ' THAIS ', 'DE LA SELL', 'thais@gmail.com', 94, 2018, ' communicante  interne chez ALL ZAQ', 'campus2', '“Impossible” est pour ceux qui ne veulent pas vraiment', 'STAND', 'STAND', 'standard'),
(21, NULL, 'Kathel', 'DUMOIS', 'kathel@gmail.com', NULL, 2020, NULL, NULL, NULL, '@PTM1ZUMc6', 'E7FiuGU#zL', 'standard'),
(22, NULL, 'Kathel', 'DUMOIS', 'ageeb007@gmail.com', NULL, 2020, NULL, NULL, NULL, '@PTM1ZUMc6', 'E7FiuGU#zL', 'standard'),
(24, NULL, 'TOURE', 'M\'Mah', 'touremmah@gmail.com', NULL, 2004, NULL, NULL, NULL, 'S7n7tav$hP', 'GEi&sbNntj', 'admin'),
(25, NULL, 'BARRY', 'Aguibou', 'barrybagata96@gmail.com', NULL, 2008, NULL, NULL, NULL, 'j1*TKdxsKW', 'x67LdQf@DU', 'admin'),
(26, NULL, 'PAUL', 'DADAD', 'clem7812@icloud.com', NULL, 2020, NULL, NULL, NULL, '6pc-a67P4r', 'w_KSQZP6DD', 'standard');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
