

<div class="container-fluid gamelist">
    <?php
    if(empty($gamelist)) echo "Il n'y a aucune table proposée pour le moment !";
    foreach($gamelist as $game)
        echo "<p href='view_game.php?id=$game->id'> $game->gamename </p> "
    ?>
</div>

<div class="container-fluid">
    <a href="create_game.php" class="btn bg-success text-white <?=$disabled?>"> Créer une table  </a>
</div>