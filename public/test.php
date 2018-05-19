<?php
include "Config.php";
function chargerClasse($classe)
{
  require $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
}
spl_autoload_register('chargerClasse'); 

$eMan = new EvenementsManager($DB);
// $e = new Evenement();
// $e->nom = 'First Event';
// $e->organisateur = 1;
// $e->lieu = 'Chez moi';
// $e->date = date("Y-m-d H:i:s");
// $e->prix = 0;
// $e->categorie = 1;

// $eMan->add($e);

$u = new User();
$u->id = 1;
$u->firstname = 'Martin';
print_r($u);
$e = $eMan->getAll()[1];
echo $eMan->getMusique($e->musique), $eMan->getMusique($e->musique);
print_r($eMan->uMan->getId($e->organisateur));
// print_r($eMan->pMan->getAll($e->table_participants));
?>
