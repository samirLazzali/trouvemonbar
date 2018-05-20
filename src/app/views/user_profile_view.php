<div class="container-fluid ml-2">
<h2 class="mt-4"> <?php echo $user->getNick() ; ?>
    <!--OPTION TO EDIT PROFILE FOR THE OWNER -->
        <?php
        if($isOwner)
            echo "<a class='m-md-auto btn-sm btn btn-primary' href='edit_profile.php'> Éditer mon profil </a>";
        ?>
</h2>
    <p><?php echo $user->getFirstname()." ".$user->getLastname(); ?></p>

    <div>
        <?php
    $mail =  $user->getMail();

    echo " <div class='mt-2'>
                <div class='font-weight-bold '> E-mail :  </div>
                <a href='mailto:$mail'class='list-group' > $mail </a>
            </div>";
    ?>
    </div>

    <!-- USER IS A GM FOR : -->
    <div class="">

        <?php
            if(empty($games)) echo "<div class='mt-2 font-weight-bold'> Cet utilisateur n'est MJ pour aucune table </div>";
            else {
                echo "<div class='font-weight-bold mt-2'> MJ pour :  </div>";
                echo "<ul class='list-group-flush'>";
                foreach($games as $game)
                    echo "<li> <a href=view_game.php?id=$game->gameid> $game->gamename </a> </li>";
                echo "</ul>";
            }
        ?>
    </div>

    <!-- USER IS A PLAYER FOR -->
    <div class="">

        <?php
        if(empty($participations)) echo "<div class='font-weight-bold'> Cet utilisateur ne joue encore sur aucune table. </div>";
        else {
            echo "<div class='font-weight-bold'> Joueur sur :  </div>";
            echo "<ul class='list-group'>";
            foreach($participations as $participation)
                echo "<li class='list-group-item'> <a href=view_game.php?id=$participation->gameid> $participation->gamename </a> </li>";
            echo "</ul>";
        }
        ?>
    </div>

    <!-- USER CAN GM : -->
    <?php
        if(empty($systems)) echo "<div class='mt-2 font-weight-bold'> Cet utilisateur n'est pas maître du jeu. </div>";
        else {
            echo "<div class='font-weight-bold mt-2'> Cet utilisateur peut meujeuter : </div>";
            echo "<ul class='list-group'>";
            foreach($systems as $system)
                echo "<li class='list-group-item'> $system->systemname </li>";
            echo "</ul>";
        }
    ?>

     <a class="btn-primary btn mt-4" href="user_files.php?user=<?=$user->getId()?>" > <?=$isOwner ? "M" : "S"?>es fichiers </a>


</div>





















