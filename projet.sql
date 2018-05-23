Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `assos`
--

CREATE TABLE IF NOT EXISTS `assos` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_admin` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `assos`
--

INSERT INTO `assos` (`id`, `nom`, `id_admin`) VALUES
(1, 'BDE', 2),
(2, 'bar', 1),
(3, 'AS', 4);

-- --------------------------------------------------------

--
-- Structure de la table `faire_partie_de`
--

CREATE TABLE IF NOT EXISTS `faire_partie_de` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_asso` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `faire_partie_de`
--

INSERT INTO `faire_partie_de` (`id`, `id_user`, `id_asso`) VALUES
(1, 2, 1),
(2, 1, 2),
(3, 4, 3),
(4, 3, 2),
(5, 5, 1),
(6, 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `participer_a`
--

CREATE TABLE IF NOT EXISTS `participer_a` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_reunion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `participer_a`
--

INSERT INTO `participer_a` (`id`, `id_user`, `id_reunion`) VALUES
(1, 1, 2),
(2, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reunion`
--

CREATE TABLE IF NOT EXISTS `reunion` (
  `id` int(11) NOT NULL,
  `nom_reunion` varchar(11) NOT NULL,
  `date` date NOT NULL,
  `id_asso` int(11) NOT NULL COMMENT 'id_asso correspondante',
  `statut` varchar(255) DEFAULT NULL COMMENT 'oui/non ou Null quand on ne sait pas encore',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reunion`
--

INSERT INTO `reunion` (`id`, `nom_reunion`, `date`, `id_asso`, `statut`) VALUES
(1, 'réunion org', '2018-05-31', 3, NULL),
(2, 'pub fin ann', '2018-06-01', 2, 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL COMMENT 'mot de passe',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table des élèves';

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `mdp`) VALUES
(1, 'Pierre', 'pedro'),
(2, 'Pauline', 'paula'),
(3, 'Jean', 'jeannot'),
(4, 'Paul', 'paulo'),
(5, 'Boris', 'boriso');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
