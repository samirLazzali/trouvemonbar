<?php
if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/config.php');
require_once(__ROOT__ . '/classes/Post.php');
/**
 * Created by PhpStorm.
 * User: yeti
 * Date: 21/04/18
 * Time: 16:01
 */

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
    <div class="feed-wrapper">
        <div class="post-wrapper">
            <div class="post-header">
                <a class="author-name-link" href="profile/<?=$author?>">
                     <span class="author-name">
                        <?=$author?>
                     </span>
                </a>
                <span class="post-date">
                    <?=$date?>
                </span>
            </div>
            <div class="post-content">
                <?=$content?>
            </div>
            <div class="post-options">
                <ul>
                    <li class="action">
                        <a href="#" class="action-repost">Repost</a>
                    </li>
                    <li class="action">
                        <a href="#" class="action-like">Like</a>
                    </li>
                    <li class="action">
                        <a href="#" class="action-dislike">Dislike</a>
                    </li>
                </ul>
            </div>
        </div>
            <h2>Réponses</h2>
            <?php
                foreach ($array as $item)
                {
                    $author = $item->getAuthor()->getUsername() ;
                    $content = $item->toHtml();
                    $date = $item->getTimestamp();?>
        <div class="responses-wrapper">
                    <div class="post-header">
                        <a class="author-name-link" href="profile/<?=$author ?>">
                             <span class="author-name">
                                <?=$author ?>
                             </span>
                        </a>
                        <span class="post-date">
                            <?=$date ?>
                        </span>
                    </div>
                    <div class="post-content">
                        <?=$content ?>
                    </div>
                    <div class="post-options">
                        <ul>
                            <li class="action">
                                <a href="#" class="action-repost">Repost</a>
                            </li>
                            <li class="action">
                                <a href="#" class="action-like">Like</a>
                            </li>
                            <li class="action">
                                <a href="#" class="action-dislike">Dislike</a>
                            </li>
                        </ul>
                    </div>
        </div>
                    <?php
                }
            ?>

    </div>
</body>
</html>
