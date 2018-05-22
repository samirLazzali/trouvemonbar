<?php

/*Ce fichier détruit les variables de session avant la déconnexion.*/
session_start() ;

session_destroy() ;

header('Location: index.php');


?>