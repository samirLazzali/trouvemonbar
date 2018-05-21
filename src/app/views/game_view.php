<div class="container-fluid">

    <!-- GAME INFO -->
    <h2> <?php echo $game->getName(); ?></h2>
    <div class="mt-0">
        Une table de <?php echo "<a href=user_profile.php?user=".$creator->getId()."  >  ".$creator->getNick()."  </a>";  ?>
    </div>



    <div class="mt-2 font-italic">
         <?php echo $game->getDesc() ; ?>
    </div>


    <div class="mt-2">
         <span class="font-weight-bold"> Nombre de séances : </span> <?php echo $game->getDuration(); ?>
    </div>




    <!-- AVAILABLE SCHEDULES -->


    <ul class="list-group">
        <div class="font-weight-bold mt-4"> Horaires proposés : </div>
        <?php

        foreach($oneshots as $oneshot)
        {

            echo " <li class='list-group-item'> Le ".
                date("d/m/Y", strtotime($oneshot->date))
                ." de ".$oneshot->starttime." à ".$oneshot->endtime." </li>";
        }

        foreach ($reccurrents as $reccurrent)
        {
            $reccurrence = Reccurrence::id_to_reccurrence($reccurrent->reccurrenceid);
            echo "<li class='list-group-item'> Le ".int_to_dayofweek($reccurrent->day)." ".$reccurrence."
                     de ".$reccurrent->starttime." à ".$reccurrent->endtime." </li>";
        }
        ?>
    </ul>


    <!-- FILE LIST -->
    <label for="filelist" class="font-weight-bold mt-4"> Fichiers associés : </label>
    <ul id="filelist" class="list-group">
        <?php
        foreach($files as $file)
        {

            echo "<li class='list-group-item'>";
            File::download($file->filename, $file->fileid);
            echo "</li>";
        }
        ?>
    </ul>

    <!-- PLAYER LIST -->
    <label for="playerlist" class="font-weight-bold mt-4"> Joueurs : </label>
    <ul id="playerlist" class="list-group">
        <?php
        foreach ($players as $player)
        {
            echo "<li class='list-group-item'> 
                                <a href='user_profile.php?user=$player->userid'> $player->nick </a>
                          </li>";
        }

        ?>
    </ul>

    <!-- add game to google calendar, set status to "runnning" -->
    <?php
    if($isOwner)
        echo "<a class='btn btn-success disabled text-white mt-4'> Démarrer la table </a>";
    ?>


    <!-- COMMENT SECTION -->
    <div class="font-weight-bold mt-4">
        Commentaires des joueurs :
    </div>
    <ul class="list-group">
        <?php
        foreach($comments as $comment) {

            $userid = $comment->userid;
            $gameid = $comment->gameid;
            $commentid = $comment->commentid;
            echo "<li class='list-group-item'>  
                                <div>
                                    <a href='user_profile.php?user=$userid'> ". Comment::author($commentid)."</a><span>, le ". date("d/m/Y", strtotime($comment->commentdate)) ." : </span> ";

            //the owner can add players WHO ARE NOT YET PARTICIPATNG to the game with this button
            if($isOwner  && !Participation::is_participating($userid, $gameid))
                echo "<a class='btn-primary btn btn-sm' 
                                            href='actions/add_player.php?user=$userid&game=$gameid'
                                            data-toggle='tooltip'
                                            title='Ajouter ce joueur à cette table'
                                            data-placement='right'> 
                                + </a>";

            echo" </div>
                  <div>
                  $comment->content
                  </div>";
                              

            //an admin can remove the comment
            if($isAdmin)
            {
                echo "<a class='btn-danger btn btn-sm float-right'
                          href='actions/remove_comment_action.php?comment=$commentid&game=$gameid'>
                          Effacer
                      </a>";
            }
            echo "  </li>";
        }
        ?>
    </ul>
    <form id="add_comment" name="add_comment" action="actions/add_comment_action.php" method="post"
        <?= Auth::logged() ? "" : "hidden"?>>
        <input type="hidden" value="<?=$gameid?>" name="gameid"/>
        <textarea form="add_comment" placeholder="Mon commentaire..." name="content" class="form-control"></textarea>
        <input type="submit" value="Ajouter un commentaire"  class="btn btn-primary"/>
    </form>

    <?=Auth::logged() ? "" : "<span class='font-weight-bold'> 
                                          <a href='authentication.php'>  Connectez vous </a> pour répondre ! 
                                          
                                      </span>"; ?>




</div>












