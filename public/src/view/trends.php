<?php
if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/config.php');
require_once(__ROOT__ . '/classes/Trend.php');

$trends = Trend::getTrends();

$tags = array_keys($trends);


//TODO
/* afficher tous (cliquables) les tags + top likes/dislikes
 */

foreach ($tags as $tag)
{

}

/* TODO
 * on initialise la page avec les toplikes pour pas laisser de blancs
 */

$posts = Post::topLikes();


/* affichage des posts */

foreach ($posts as $post)
{
    /* TODO
     * écrire dans post.php la fonction qui écrit de code html correspondant à l'affichage d'un post
     * pour pouvoir l'appeler ici
     */
    $post->codeHtml();
}

/* TODO
 * script js qui permet de changer la valeur de $posts et de réexécuter l'affichage de $post
 * (déclenchement on click sur un tag)
 */