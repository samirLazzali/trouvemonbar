--
-- Base de données :  `DTC`
--

-- --------------------------------------------------------

--
-- Structure de la table `Groupe`
--

CREATE TABLE Groupe (
  id int NOT NULL,
  nom varchar(255) NOT NULL,
  PRIMARY KEY (id)
);

--
-- Déchargement des données de la table `Groupe`
--

INSERT INTO Groupe (id, nom) VALUES
(1, 'membre'),
(2, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `Ingredient`
--

CREATE TABLE Ingredient (
  id SERIAL NOT NULL,
  nom varchar(255) NOT NULL,
  description text NOT NULL,
  recette_id int NOT NULL,
  unite varchar(255),
  PRIMARY KEY (id)
);

--
-- Déchargement des données de la table `Ingredient`
--

INSERT INTO Ingredient (id, nom, description, recette_id, unite) VALUES
(1, 'crozets au sarrasin', '', 2, 'g'),
(2, 'lardons', '', 2, 'g'),
(3, 'creme_fraiche', '', 2, 'cL'),
(4, 'oignon', '', 2, ''),
(5, 'reblochon', '', 2, ''),
(6, 'poivre', '', 2, ''),
(7, 'sel', '', 2, ''),
(8, 'oeufs', '', 1, ''),
(9, 'sucre_roux', '', 1, 'g'),
(10, 'mascarpone', '', 1, 'g'),
(11, 'jus_citron', '', 1, 'c.a.c'),
(12, 'marsalas', '', 1, 'c.a.s'),
(13, 'biscuit_cuillere', '', 1, ''),
(14, 'café', '', 1, 'cL'),
(15, 'cacao_poudre', '', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `Membre`
--

CREATE TABLE Membre (
  id SERIAL NOT NULL,
  login varchar(255) NOT NULL,
  firstname varchar(255) NOT NULL,
  lastname varchar(255) NOT NULL,
  birthday date NOT NULL,
  password varchar(255) NOT NULL,
  id_groupe int NOT NULL,
  PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Structure de la table `Recette`
--

CREATE TABLE Recette (
  id SERIAL NOT NULL,
  nom varchar(255) NOT NULL,
  description text NOT NULL,
  cout smallint NOT NULL,
  difficulte smallint NOT NULL,
  temps time NOT NULL,
  PRIMARY KEY (id)
);

--
-- Déchargement des données de la table `Recette`
--

INSERT INTO Recette (id, nom, description, cout, difficulte, temps) VALUES
(1, 'tiramisu', 'Etape 1    Attention : préparer la veille de la dégustation!    Etape 2    Séparer les blancs des jaunes d oeufs. Mettre les jaunes et le sucre roux dans un mixer. Battre le mélange pendant quelques instants, le temps que le mélange soit bien homogène et fluide (environ une minute). Verser dans une jatte.    Etape 3    Ajouter le mascarpone (que vous pouvez trouver au rayon fromage de votre supermarché) cuillerée par cuillerée. Mettre les blancs d oeufs dans le mixer propre (ne pas mettre en contact avec le jaune) et les battre pour les faire monter en neige.    Etape 4    Possibilité d ajouter deux gouttes de jus de citron pour les faire tenir. Incorporer au mélange de sucre et d oeufs doucement de manière à ne pas casser les oeufs en neige. La préparation doit maintenant être aérée et légère. Ajouter le jus de citron.    Etape 5    Mélanger dans un petit récipient le café fort froid avec le cognac ou le Marsala (ne pas abuser du cognac pour que le gâteau ne soit pas trop alcoolisé).    Etape 6    Passer les biscuits rapidement dans le mélange de café et d alcool. Ne pas les laisser tremper, une seconde suffit amplement pour leur transmettre le goût du mélange.    Etape 7    Tapisser des biscuits imbibés le fond d un plat large et profond. Recouvrir de la moitié de la préparation. Tapisser la préparation d une deuxième couche de biscuits puis recouvrir du reste de préparation. Lisser avec une cuillière.    Etape 8    Saupoudrer de cacao amer et mettre au réfrigérateur pendant une nuit.', 1, 1, '00:30:00'),
(2, 'croziflette', 'Etape 1    Faire cuire les crozets dans l eau bouillante salée pendant 20 minutes.    Etape 2    Au bout de 10 minutes de cuisson des crozets, couper l oignon et le faire revenir dans du beurre.Faites la caraméliser.    Etape 3    Mettre les oignons de coté et faire revenir les lardons.    Etape 4    Mettre les oignons cuits lardons crème dans la poêle et faire réduire.    Etape 5    Égoutter les crozets.    Etape 6    Mettre dans le plat à gratin une couche de crozet, une couche de crème/lardons/oignons.    Etape 7    Remplir le plat de cette manière et mettre au dessus le reblochon coupé en 2.    Etape 8    Faire cuire au four pendant 20 minutes à 200°C', 2, 2, '01:10:00');

-- --------------------------------------------------------

--
-- Structure de la table `Recette_Ingredient`
--

CREATE TABLE Recette_Ingredient (
  id_recette int NOT NULL,
  id_ingredient int NOT NULL,
  quantite int
);

--
-- Déchargement des données de la table `Recette_Ingredient`
--

INSERT INTO Recette_Ingredient (id_recette, id_ingredient, quantite) VALUES
(1, 8, 2),
(1, 9, 50),
(1, 10, 250),
(1, 11, 1),
(1, 12, 1),
(1, 13, 130),
(1, 14, 7.5),
(1, 15, NULL),
(2, 1, 300),
(2, 2, 200),
(2, 3, 20),
(2, 4, 1),
(2, 5, 1),
(2, 6, NULL),
(2, 7, NULL);