<?php
if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/config.php');
require_once(__ROOT__ . '/classes/Trend.php');

$trends = Trend::getTrends();

$tags = array_keys($trends);


?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <div>
        </div>
        <div class="column-wrapper">
            <h1>
                - tendances -
            </h1>
            <div id="trend-types">
                <a onClick="updateTrends('hashtags');" id="trend-selector-hashtags" class="trend-type-wrapper selected" href="#">
                    Hashtags
                </a>
                <a onClick="updateTrends('likes');" id="trend-selector-likes" class="trend-type-wrapper" href="#">
                    Les plus aimés
                </a>
                <a onClick="updateTrends('fights');" id="trend-selector-fights" class="trend-type-wrapper" href="#">
                    Fights
                </a>
                <a onClick="updateTrends('controversial');" id="trend-selector-controversial" class="trend-type-wrapper" href="#">
                    Controversé
                </a>
            </div>
            <div id="most-tweeted-hashtags">
                <div class="hashtags">
                    <?php
                    foreach ($tags as $tag)
                    {
                    ?>
                    <div class="hashtag-in-list">
                        <a onclick="htagList('<?= $tag ?>')" href="#" class="hashtag-link">
                            <?= $tag ?>,
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="post-feed">
            </div>
        </div>
    </body>
</html>





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
echo $post->toHtml();
echo "<br />";
}

/* TODO
* script js qui permet de changer la valeur de $posts et de réexécuter l'affichage de $post
* (déclenchement on click sur un tag)
*/
?>