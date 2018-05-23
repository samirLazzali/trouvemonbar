<?php

/* include */
use Controller\Aside;
use Controller\Content;
use Controller\Footer;
use Controller\Header;
use Controller\Navbar;
use Controller\Sidebar;
use Controller\Toastbar;
use Model\ULC\BDD\BDD;
use Model\ULC\Utilisateur\Utilisateur;

require ('../vendor/autoload.php');
define ( 'PROJECT_ROOT', realpath ( dirname ( __FILE__ ) . "/../" ) );
define ( 'VIEW_FOLDER', PROJECT_ROOT . "/src/View" );

/* les éléments de la page (afficher dans l'ordre naturel du tableau) */
$pageElementsClass = [ 
		Header::class,
		Toastbar::class,
		Navbar::class,
		Sidebar::class,
		Content::getContent (),
		Aside::class,
		Footer::class 
];

/* recupere la base de données */
$bdd = BDD::instance ();

/* recupere l'utilisateur */
$user = Utilisateur::instance ();

/* instancie puis affiche chaque element de la page */
foreach ( $pageElementsClass as $pageElementClass ) {
	$pageElement = new $pageElementClass ( $bdd, $user );
	$pageElement->afficher ();
}

