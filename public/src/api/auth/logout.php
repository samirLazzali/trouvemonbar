<?php
/**
 * Déconnecte l'utilisateur actuel.
 * Méthode : GET
 */


require_once("../../config.php");

log_out();
success_die("Logged out.");