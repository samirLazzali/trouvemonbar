<?php
require_once('../config.php');

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

$responses = $p->getResponsesTo();

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Publication de <?=$author?></title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="/assets/styles/general.css" />
    <link rel="stylesheet" href="/assets/styles/post.css" />
    <script src="/assets/js/post.js"></script>
    <script src="/assets/js/general.js"></script>
</head>
<body>
    <div class="column-wrapper">
        <h1>
            - Discussion -
        </h1>
        <div class="post-feed">
            <?php affichePost($p) ?>
        </div>
        <div class="splitter">

        </div>
        <div class="post-feed">
            <?php foreach ($responses as $item)
                {
                    affichePost($item);
                } ?>
        </div>
    </div>
</body>
</html>
