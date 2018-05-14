<?php

require_once("../config.php");

$u = getUserFromCookie();

if ($u == null)
{
    header("Location: /login");
    die();
}

if (isset($_GET['tag']))
    $tag = $_GET['tag'];
else
{
    header("Location: /");
    die();
}
if ($tag == "")
{
    header("Location: /");
    die();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>
        Vitz - #<?= $tag ?>
    </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="/assets/styles/feed.css" />
    <script src="/assets/js/general.js"><</script>
    <script src="/assets/js/post.js"><</script>
</head>
<body>
<?php require "menu.php"; ?>
<div class="column-wrapper">
    <h1>
        - #<?= $tag ?> - Derniers -
    </h1>

    <?php
    $posts = Post::fromHashtag($tag);
    ?>
    <div class="post-feed">
        <?php
        foreach ($posts as $post){
            affichePost($post);
        }
        ?>
    </div>
</div>
</body>
</html>