<?php
include_once('../modele/DataUser.class.php');
include_once('../modele/ProfilUser.class.php');
include_once('../controleur/secure.php');
include_once('controleur/checkStatut.php');

include_once('controleur/header.php');

$tags_list = [
	"Anxieux(se)",
	"Belliqueux(se)",
	"Bourlingueur(se)",
	"Bourru(e)",
	"Calme",
	"Coquin(e)",
	"Coupable",
	"Débordé(e)",
	"Dégoûté(e)",
	"Déprimé(e)",
	"Dérangé(e)",
	"Docile",
	"Envieux(se)",
	"Faux(sse)",
	"Fidèle",
	"Fier(e)",
	"Fourbe",
	"Frustré(e)",
	"Gai(e)",
	"Gêné(e)",
	"Gentil(le)",
	"Heureux(se)",
	"Horrible",
	"Hystérique",
	"Indisposé(e)",
	"Jovial(e)",
	"Méchant(e)",
	"Pacifique",
	"Perturbé(e)",
	"Plein(e)-d'espoir",
	"Prétentieux(se)",
	"Prudent(e)",
	"Rieur(se)",
	"Sociable",
	"Solitaire",
	"Soucieux(se)",
	"Souffrant(e)",
	"Soupçonneux(se)",
	"Sûr(e)-de-soi",
	"Tchatcheur(se)",
	"Timide",
	"Tranquille",
	"Triste",
	"Troublé(e)"
];

$user = new ProfilUser($bdd, $_SESSION['id']);

if (isset($_POST['s'])) {
	$sexe = secureData($_POST['s']);
	if (in_array($sexe, ['H', 'F', 'D']))
		$user->setSexeSearch($sexe);
}

if (isset($_POST['tags'])) {
	$tags = "";
	foreach ($_POST['tags'] as $tag) {
		if (in_array($tag, $tags_list))
			$tags .= (secureData($tag).' ');
	}
	$user->setTags($tags);
}else if(isset($_POST['clear_tag']))
	$user->setTags('');

$sexe = $user->getSexeSearch()->fetch()['search_sexe'];
$tags = explode(' ', $user->getTags()->fetch()['tags']);



include_once('vue/profil.php');
