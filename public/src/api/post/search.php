<?php
/**
 * Recherche des posts.
 * Méthode : GET
 * Paramètres :
 * - term  : le(s) terme(s) de la recherche
 * - limit : le nombre maximal de posts à renvoyer (par défaut : 50)
 * Renvoie
 * - status = success, <Liste de <Post sérialisé>>
 * Détails :
 *     SELECT * FROM Post WHERE Content LIKE %term%
 */

require_once("../../config.php");
require_once("SearchHelper.php");

if (isset($_GET['term']))
    $term = $_GET['term'];
else
    error_die("term", ERROR_FieldMissing);

if (isset($_GET['limit']))
    $limit = $_GET['limit'];
else
    $limit = 50;

$results = Search::post($term, $limit);
success_die($results);