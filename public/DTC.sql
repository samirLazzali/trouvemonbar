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
  unite varchar(255),
  PRIMARY KEY (id)
);

--
-- Déchargement des données de la table `Ingredient`
--

INSERT INTO Ingredient (nom, description, unite) VALUES
('crozets au sarrasin', '', 'g'),
('lardons', '', 'g'),
('creme fraiche', '', 'cL'),
('oignon', '', ''),
('reblochon', '', ''),
('poivre', '', ''),
('sel', '', ''),
('oeufs', '', ''),
('sucre roux', '', 'g'),
('mascarpone', '', 'g'),
('jus_citron', '', 'c.a.c'),
('marsalas', '', 'c.a.s'),
('biscuit cuillere', '', ''),
('café', '', 'cL'),
('cacao poudre', '', ''),
('fettucine', '', 'g'),
('crevettes', '', 'g'),
('beurre', '', 'g'),
('huile olive', '', 'c.a.s'),
('oignon nouveau', '', ''),
('gousse ail', '', ''),
('creme liquide', '', 'cL'),
('persil', '', ''),
('pates de lasagnes', '', 'g'),
('branche de céleri', '', ''),
('carotte', '', ''),
('boeuf haché', '', 'g'),
('purée de tomates', '', 'g'),
('eau', '', 'cL'),
('vin rouge', '', 'cL'),
('feuille de laurier', '', ''),
('thym', '', ''),
('basilic', '', ''),
('muscade râpée', '', ''),
('fromage râpé', '', 'g'),
('parmesan', '', 'g'),
('farine', '', 'g'),
('lait', '', 'cL'),
('blancs oeufs', '', ''),
('sucre en poudre', '', 'g'),
('maïzena', '', 'g'),
('vinaigre de vin blanc', '', 'c.a.c'),
('veau', '', 'kg'),
('bouillon de legume', '', 'cube'),
('bouillon de poule', '', ''),
('champignons', '', 'g'),
('citron', '', ''),
('jaune d oeuf', '', ''),
('vin blanc', '', 'cL'),
('filets mignons de porc', '', ''),
('pâtes feuilletées', '', ''),
('jambon blanc', '', 'tranche'),
('gruyère râpé', '', 'g'),
('boeuf', '', 'g'),
('ail', '', 'gousse'),
('bouquet garni', '', ''),
('purée', '', 'g'),
('tomate', '', ''),
('herbes de Provence', '', 'pincée'),
('parmesan', '', 'g'),
('poulet', '', ''),
('poivrons', '', 'g'),
('curry', '', 'c.a.c'),
('lentilles vertes', '', 'g'),
('saucisses', '', ''),
('magrets de canard', '', ''),
('miel', '', 'c.a.s'),
('vinaigre balsamique', '', 'c.a.f'),
('courgettes', '', ''),
('pommes de terre', '', ''),
('kiris', '', ''),
('moutarde', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `Membre`
--

CREATE TABLE Membre (
  id SERIAL NOT NULL,
  login varchar(255) NOT NULL,
  firstname varchar(255),
  lastname varchar(255),
  birthday date,
  password varchar(255) NOT NULL,
  email text NOT NULL,
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
  photo text,
  PRIMARY KEY (id)
);

--
-- Déchargement des données de la table `Recette`
--

INSERT INTO Recette (nom, description, cout, difficulte, temps, photo) VALUES
('tiramisu', '/Etape    Attention : préparer la veille de la dégustation!    /Etape    Séparer les blancs des jaunes d oeufs. Mettre les jaunes et le sucre roux dans un mixer. Battre le mélange pendant quelques instants, le temps que le mélange soit bien homogène et fluide (environ une minute). Verser dans une jatte.    /Etape    Ajouter le mascarpone (que vous pouvez trouver au rayon fromage de votre supermarché) cuillerée par cuillerée. Mettre les blancs d oeufs dans le mixer propre (ne pas mettre en contact avec le jaune) et les battre pour les faire monter en neige.    /Etape    Possibilité d ajouter deux gouttes de jus de citron pour les faire tenir. Incorporer au mélange de sucre et d oeufs doucement de manière à ne pas casser les oeufs en neige. La préparation doit maintenant être aérée et légère. Ajouter le jus de citron.    /Etape    Mélanger dans un petit récipient le café fort froid avec le cognac ou le Marsala (ne pas abuser du cognac pour que le gâteau ne soit pas trop alcoolisé).    /Etape    Passer les biscuits rapidement dans le mélange de café et d alcool. Ne pas les laisser tremper, une seconde suffit amplement pour leur transmettre le goût du mélange.    /Etape    Tapisser des biscuits imbibés le fond d un plat large et profond. Recouvrir de la moitié de la préparation. Tapisser la préparation d une deuxième couche de biscuits puis recouvrir du reste de préparation. Lisser avec une cuillière.    /Etape    Saupoudrer de cacao amer et mettre au réfrigérateur pendant une nuit.', 1, 1, '00:30:00', 'photo/tiramisu.jpg'),
('croziflette', '/Etape    Faire cuire les crozets dans l eau bouillante salée pendant 20 minutes.    /Etape    Au bout de 10 minutes de cuisson des crozets, couper l oignon et le faire revenir dans du beurre.Faites la caraméliser.    /Etape    Mettre les oignons de coté et faire revenir les lardons.    /Etape    Mettre les oignons cuits lardons crème dans la poêle et faire réduire.    /Etape    Égoutter les crozets.    /Etape    Mettre dans le plat à gratin une couche de crozet, une couche de crème/lardons/oignons.    /Etape    Remplir le plat de cette manière et mettre au dessus le reblochon coupé en 2.    /Etape    Faire cuire au four pendant 20 minutes à 200°C', 2, 2, '01:10:00', 'photo/croziflette.jpg'),
('Crevettes à la crème et aux fettucine', '/Etape    Cuire les pâtes à l eau bouillante salée jusqu à ce qu elles soient al dente. Les égoutter et les remettre dans la casserole.    /Etape    Pendant que les fettucine cuisent, décortiquer et ôter la veine des crevettes. Chauffer le beurre et l huile dans une poêle et faire revenir l oignon et l ail 1 minute à feu doux.    /Etape    Ajouter les crevettes et les cuire 2 à 3 minutes, jusqu à ce qu elles changent de couleur. Retirer les crevettes de la poêle et les réserver. Mettre la crème dans la poêle et porter à ébullition.    /Etape    Baisser le feu et laisser mijoter jusqu à ce que la sauce commence à épaissir. Remettre les crevettes dans la poêle, saler, poivrer, et prolonger la cuisson d une minute.    /Etape    Verser les crevettes et la sauce sur les pâtes chaudes et remuer délicatement.    /Etape    Servir avec du persil haché.', 1, 1, '00:45:00', 'photo/Crevettes à la crème et aux fettucine.jpg'),
('Lasagne à la bolognaise', '/Etape    Emincer les oignons. Ecraser les gousses d ail. Hacher finement carotte et céleri. Faire revenir gousses d ail et oignons dans un peu d huile d olive.    /Etape    Ajouter la carotte et la branche de céleri hachée    /Etape    puis la viande et faire revenir le tout.    /Etape    Au bout de quelques minutes, ajouter le vin rouge. Laisser cuire jusqu à évaporation.    /Etape    Ajouter la purée de tomates, l eau et les herbes.    /Etape    Saler, poivrer, puis laisser mijoter à feu doux 45 minutes.    /Etape    Préparer la béchamel : faire fondre le beurre,    /Etape    puis, hors du feu, ajouter la farine d un coup.    /Etape    Remettre sur le feu et remuer avec un fouet jusqu à l obtention d un mélange bien lisse.    /Etape    Ajouter le lait peu à peu.    /Etape    Remuer sans cesse, jusqu à ce que le mélange s épaississe.    /Etape    Ensuite, parfumer avec la muscade, saler, poivrer. Laisser cuire environ 5 minutes, à feu très doux, en remuant. Réserver.    /Etape    Préchauffer le four à 200°C (thermostat 6-7). Huiler le plat à lasagnes. Poser une fine couche de béchamel puis :    /Etape    des feuilles de lasagnes,    /Etape    de la bolognaise,    /Etape   de la béchamel    /Etape   et du parmesan,    /Etape    et cela 3 fois de suite.    /Etape    Sur la dernière couche de lasagnes, ne mettre que de la béchamel et recouvrir de fromage râpé. Parsemer quelques noisettes de beurre.    /Etape    Enfourner pour environ 25 minutes de cuisson.    /Etape    Déguster', 2, 3, '02:15:00', 'photo/Lasagne à la bolognaise.jpg'),
('Meringue', '/Etape    Préchauffez le four à 150°C (thermostat 5).    /Etape    Mettez les blancs et le sel dans un saladier.    /Etape    Fouettez de plus en plus vite.    /Etape    Quand la mousse est très blanche et épaisse, ajoutez progressivement et délicatement le sucre, sans cesser de fouetter jusqu à obtenir une mousse très ferme et brillante.    /Etape    Incorporez le vinaigre et la maïzena tamisée.    /Etape    Formez aussitôt des tas sur une plaque anti-adhésive.    /Etape     Enfournez pour 1 heure de cuisson. Les meringues doivent être blond très clair, sèches dessus et dessous.    /Etape    Laissez refroidir puis décollez-les du papier cuisson.', 1, 3, '01:30:00', 'photo/meringue.jpg'),
('Blanquette de veau', '/Etape    Faire revenir la viande dans un peu de beurre doux jusqu à ce que les morceaux soient un peu dorés.    /Etape    Saupoudrer de 2 cuillères de farine. Bien remuer.    /Etape    Ajouter 2 ou 3 verres d eau, les cubes de bouillon, le vin et remuer. Ajouter de l eau si nécessaire pour couvrir.    /Etape    Couper les carottes en rondelles et émincer les oignons puis les incorporer à la viande, ainsi que les champignons.    /Etape    Laisser mijoter à feu très doux environ 1h30 à 2h00 en remuant.    /Etape    Si nécessaire, ajouter de l eau de temps en temps.    /Etape    Dans un bol, bien mélanger la crème fraîche, le jaune d’oeuf et le jus de citron. Ajouter ce mélange au dernier moment, bien remuer et servir tout de suite.', 2, 1, '02:15:00', 'photo/blanquette_de_veau.jpg'),
('Filet mignon en croute', '/Etape    Peler et émincer les oignons.    /Etape    Les faire revenir dans une sauteuse avec 20 g de beurre pendant 3 minutes environ. Les retirer de la sauteuse et les réserver.    /Etape    Dans la même sauteuse, faire revenir les filets mignons de chaque côté.    /Etape    Laisser cuire 10 minutes à feu doux.    /Etape    Réincorporer les oignons. Poursuivre la cuisson pendant 5 minutes. Saler, poivrer. Réserver.    /Etape    Dérouler les pâtes feuilletées.    /Etape    Déposer sur chaque pâte deux tranches de jambon et 100 g de gruyère. Saler et poivrer.    /Etape    Y déposer un filet sur chaque pâte garnie et napper de sauce aux oignons.    /Etape    Replier la pâte autour de la viande et souder les bords à l aide du jaune d oeuf préalablement battu et d un pinceau alimentaire.    /Etape    Enfourner pour 45 minutes de cuisson à 200°C (thermostat 6-7).', 1, 1, '01:00:00', '/photo/filet_mignon_en_coroute.jpg'),
('Boeuf bourgignon', '/Etape    Hacher les oignons. Peler l ail.    /Etape    Dans une cocotte minute, faire roussir la viande et les lardons dans l’huile ou le beurre.    /Etape    Ajouter les oignons, les champignons égouttés et saupoudrer de fariner. Mélanger et laisser dorer un instant.    /Etape    Mouiller avec le vin rouge qui doit recouvrir la viande.    /Etape    Saler et poivrer.    /Etape    Ajouter l’ail et le bouquet garni.    /Etape    Fermer la cocotte minute.    /Etape    Laisser cuire doucement 60 min à partir de la mise en rotation de la soupape.', 2, 1, '01:10:00', '/photo/boeuf_bourgignon.jpg'),
('Hachis parmentier', '/Etape    Hacher l oignon et l ail. Les faire revenir dans le beurre jusqu à ce qu ils soient tendres.    /Etape    Ajouter les tomates coupées en dés, la viande hachée, la farine, du sel, du poivre et les herbes de Provence.    /Etape    Quand tout est cuit, couper le feu et ajouter le jaune d oeuf et un peu de parmesan. Bien mélanger.    /Etape    Préchauffer le four à 200°C (thermostat 6-7). Etaler au fond du plat à gratin. Préparer la purée. L étaler au dessus de la viande. Saupoudrer de fromage râpé et faire gratiner.', 1, 2,  '00:45:00', '/photo/hachis_parmentier.jpg'),
('Poulet basquaise', '/Etape    Hacher l oignon et l ail. Couper les tomates en morceaux et détailler les poivrons en lanières.    /Etape    Faire chauffer 4 cuillères à soupe d huile dans une cocotte. Y faire dorer les oignons, l ail et les poivron. Laisser cuire 5 min.    /Etape    Ajouter les tomates à la cocotte, saler, poivrer. Couvrir et laisser mijoter 20 min.    /Etape    Dans une sauteuse, faire dorer dans l huile d olive les morceaux de poulet salés et poivrés.    /Etape    Lorsqu ils sont dorés, les ajouter aux légumes, couvrir, ajouter le bouquet garni et le vin blanc et c est parti pour 35 min de cuisson.', 2, 2, '01:20:00', '/photo/poulet_basquaise.jpg'),
('Crevettes au curry', '/Etape    Décortiquer les crevettes. Les faire revenir très rapidement dans l huile d olive en les saupoudrant de curry.    /Etape    Ajouter la crème et mélanger le tout.    /Etape    Servir immédiatement avec du riz thaï.', 2, 1, '00:15:00', '/photo/crevettes_au_curry.jpg'),
('Saucisses lentilles', '/Etape    Piquer les saucisses avec une fourchette.    /Etape    Après mettez-les dans 1,5 litre d eau froide, avec le bouquet garni et la carotte coupée en rondelles. Faites cuire à gros bouillons pendant 15 à 20 min.    /Etape    Pendant ce temps, faites revenir les lardons dans une poêle, juste pour qu ils soient légèrement dorés et croquants.    /Etape    Ajoutez les lardons, les oignons blancs et les lentilles dans le faitout des saucisses. Ne salez pas, les lardons le feront.    /Etape    Couvrez et faites cuire le tout à feu doux de 20 à 25 min.    /Etape    Égouttez, retirez le bouquet garni, disposez sur un plat avec un peu de persil haché et servez aussitôt.', 1, 2, '00:55:00', '/photo/saucisses_lentilles.jpg'),
('Magrets de canard au miel', '/Etape    Inciser les magrets côté peau en quadrillage sans couper la viande.    /Etape    Cuire les magrets à feu vif dans une cocotte en fonte, en commençant par le coté peau.    /Etape    Le temps de cuisson dépend du fait qu on aime la viande plus ou moins saignante. Compter environ 5 min de chaque côté. Retirer régulièrement la graisse en cours de cuisson.    /Etape    Réserver les magrets au chaud (au four, couverts par une feuille d aluminium).    /Etape    Déglacer la cocotte avec le miel et le vinaigre balsamique. Ne pas faire bouillir, la préparation tournerait au caramel. Bien poivrer.    /Etape    Mettre en saucière accompagnant le magret coupé en tranches.    /Etape    Comme accompagnement, je suggère des petits navets glacés (cuits à l eau puis passés au beurre avec un peu de sucre).', 3, 2, '00:20:00', '/photo/magret_canard_au_miel'), 
('Carottes à la carbonara', '/Etape    Eplucher les carottes et les couper en rondelles.    /Etape    Découper les oignons en petits morceaux.    /Etape    Mettre une noix de beurre dans une sauteuse et y faire revenir les 2 légumes durant 3 mn à feu fort.    /Etape    Ajouter 20 cl d eau, baisser le feu, couvrir et laisser cuire une dizaine de minutes (vérifier que cela n attache pas et ajouter de l eau si nécessaire).    /Etape    Quand c est cuit, ajouter les lardons ; les faire cuire 2-3 mn puis sur feu très doux ajouter les jaunes d oeuf mélangés à la crème.    /Etape    Saler légèrement, poivrez.    /Etape    Laisser chauffer 3 mn en remuant et servir.', 1, 1, '00:25:00', '/photo/carottes_carbonara.jpg'),
('Crême de courgettes', '/Etape    Couper les courgettes en morceaux sans les peler.    /Etape    Peler les pommes de terre et les couper également en morceaux.    /Etape    Faire cuire le tout dans un bouillon de votre choix pendant 30 mn.    /Etape    Une fois les légumes cuits, les égoutter, ajouter le Kiri et le sel.    /Etape    Passer le tout au mixer.', 1, 1, '00:35:00', '/photo/creme_courgette.jpg'), 
('Baked potatoes', '/Etape    Emballer les pommes de terre dans du papier d aluminium et les mettre dans le four préchauffé à 250°C pendant environ 30 min.    /Etape    Pendant ce temps préparer la crème :    /Etape    Mélanger dans un bol, un pot de crème fraîche avec une cuillère à café de moutarde, un peu de jus de citron, du sel, du poivre et ajouter de la ciboulette fraîche et du persil.    /Etape    Les pommes de terre, une fois cuites, seront ouvertes en deux et nappées de la sauce.', 1, 1, '00:35:00', '/photo/baked_potatoes.jpg');

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
(2, 7, NULL),
(3, 16, 500),
(3, 17, 500),
(3, 18, 30),
(3, 19, 1),
(3, 20, 2),
(3, 21, 1),
(3, 22, 25),
(3, 23, NULL),
(4, 24, 500),
(4, 4, 3),
(4, 21, 2),
(4, 25, 1),
(4, 26, 1),
(4, 27, 600),
(4, 28, 800),
(4, 29, 15),
(4, 30, 20),
(4, 31, 2),
(4, 32, NULL),
(4, 33, NULL),
(4, 34, NULL),
(4, 35, 70),
(4, 36, 130),
(4, 37, 100),
(4, 18, 125),
(4, 38, 100),
(5, 39, 2),
(5, 40, 120),
(5, 41, 5),
(5, 42, 1),
(5, 7, NULL),
(6, 43, 1),
(6, 44, 1),
(6, 45, 1),
(6, 26, 2),
(6, 4, 1),
(6, 46, 250),
(6, 22, 1),
(6, 47, 1),
(6, 48, 1),
(6, 37, 100),
(6, 49, 25),
(6, 7, NULL),
(6, 6, NULL),
(7, 50, 2),
(7, 51, 2),
(7, 52, 4),
(7, 53, 200),
(7, 8, 2),
(7, 4, 2),
(8, 54, 800),
(8, 2, 100),
(8, 18, 50),
(8, 30, 100),
(8, 4, 2),
(8, 55, 1),
(8, 37, 20),
(8, 56, 1),
(8, 46, 250),
(8, 7, NULL),
(8, 6, NULL),
(9, 54, 400),
(9, 57, 300),
(9, 4, 2),
(9, 55, 2),
(9, 58, 2),
(9, 37, 10),
(9, 59, 1),
(9, 48, 1),
(9, 60, 30),
(9, 18, 30),
(9, 53, 50),
(9, 7, NULL),
(9, 6, NULL),
(10, 61, NULL),
(10, 58, 8),
(10, 62, 700),
(10, 4, 3),
(10, 55, 3),
(10, 49, 20),
(10, 56, 1),
(10, 19, 6),
(10, 7, NULL),
(10, 6, NULL),
(11, 17, 300),
(11, 3, 10),
(11, 63, 1),
(11, 62, 8),
(12, 64, 250),
(12, 65, 4),
(12, 4, 1),
(12, 26, 1),
(12, 2, 100),
(12, 56, 1),
(13, 66, NULL),
(13, 67, 3),
(13, 68, 3),
(13, 7, NULL),
(14, 26, 6),
(14, 48, 2),
(14, 4, 1),
(14, 3, 40),
(14, 2, 100),
(14, 7, NULL),
(14, 6, NULL),
(15, 69, 4),
(15, 70, 2),
(15, 71, 4),
(15, 44, 1),
(15, 7, NULL),
(16, 70, 2),
(16, 3, 30),
(16, 23, NULL),
(16, 47, NULL),
(16, 72, NULL),
(16, 7, NULL),
(16, 6, NULL);





