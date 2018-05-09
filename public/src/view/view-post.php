<?php
if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/config.php');
require_once(__ROOT__ . '/classes/Post.php');

if (isset($_GET['id']))
    $id = $_GET['id'];
else
    error_die("id", ERROR_FieldMissing);

$u = verify_logged_in();

try {
    $p = Post::fromID($id);
}
catch (PostNotFoundException $e)
{
    error_die($e->getMessage(), ERROR_NotFound);
}

$array = $p->getResponsesTo();

$author = $p->getAuthor()->getUsername();
$content = $p->toHtml();
$date = $p->getTimestamp();

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Publication de <?=$author?></title>
    <link rel="stylesheet" type="text/css" href="/src/assets/styles/visu_tweet.css" />
    <meta charset="utf-8" />
</head>
<body>
    <?php require "menu.php"; ?>
    <div class="column-wrapper">
        <div class="post-feed">

        <?php
            affichePost($p)
            // TODO : afficher les likes, dislikes, etc.
        ?>

        </div>
    </div>
    <div class="column-wrapper">
        <h1>
            - Réponses -
        </h1>
        <div class="post-feed">
            <?php
            foreach ($array as $item)
                affichePost($item);
            ?>
        </div>
    </div>
</body>
</html>
