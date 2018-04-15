<?php
/**
 * auth/get.php
 * Renvoie l'authentification actuelle en JSON
 * Exemple :
 *   {
 *     "log_status" : "logged_out",
 *     "user" : null
 *   }
 * Ou
 *   {
 *     "log_status" : "logged_in",
 *     "user" : <User sérialisé>
 *   }
 */


require_once("../../config.php");

$user = getUserFromCookie();
if ($user == null)
    $result = array("log_status" => "logged_out", "user" => null);
else
    $result = array("log_status" => "logged_in", "user" => $user);

success_die($result);