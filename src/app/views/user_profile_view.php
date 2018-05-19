
<h2> <?php echo $user->getNick() ; ?></h2>

    <?php echo $user->getFirstname()." ".$user->getLastname(); ?><br/>

    <div>
        <?php
    $mail =  $user->getMail();
    echo "<a href='mailto:$mail' > $mail </a>";
    ?>
    </div>

    <!-- USER IS A GM FOR : -->
    <div class="container-fluid">

        <?php
            if(empty($games)) echo "<div class='font-weight-bold'> Cet utilisateur n'est MJ pour aucune table </div>";
            else {
                echo "<div class='font-weight-bold'> MJ pour :  </div>";
                echo "<ul class='list-group'>";
                foreach($games as $game)
                    echo "<li> <a href=view_game.php?id=$game->gameid> $game->gamename </a> </li>";
                echo "</ul>";
            }
        ?>
    </div>

    <!-- USER IS A PLAYER FOR -->
    <div class="container-fluid">

        <?php
        if(empty($participations)) echo "<div class='font-weight-bold'> Cet utilisateur ne joue encore sur aucune table </div>";
        else {
            echo "<div class='font-weight-bold'> Joueur sur :  </div>";
            echo "<ul class='list-group'>";
            foreach($participations as $participation)
                echo "<li> <a href=view_game.php?id=$participation->gameid> $participation->gamename </a> </li>";
            echo "</ul>";
        }
        ?>
    </div>

    <div class="container-fluid">
     <a class="btn-primary btn" href="user_files.php?user=<?=$user->getId()?>" > Ses fichiers </a>
    </div>

    <!--OPTION TO EDIT PROFILE FOR THE OWNER -->
    <?php
        if($isOwner)
            echo "<div class='container-fluid m-1'>
                    <a class='btn btn-primary' href='edit_profile.php'> Editer mon prolile </a>
                    </div>";
    ?>




















