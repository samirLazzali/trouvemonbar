

<div class="container-fluid gamelist mt-2">
    <?php
    if(empty($gamelist)) echo "Il n'y a aucune table proposée pour le moment !";
    foreach($gamelist as $game) {
        echo "<div> <a href='view_game.php?id=$game->gameid'> $game->gamename </a>";

        //the admin can remove a game
        if ($isAdmin)
            echo "<a href='actions/remove_game_action.php?game=$game->gameid' class='btn btn-sm btn-danger'> X </a> ";

        echo "</div>";
    }

    ?>
</div>

<div class="container-fluid">
    <a href="create_game.php" class="btn bg-success text-white <?=$disabled?>"> Créer une table  </a>
</div>