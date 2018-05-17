<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:31
 */
 
<div class = "game_infos">


<h2>Table de : <?php echo $game_infos->gamename; ?></h2>
<span class="label_game">gamedesc</span> : <?php echo $game_infos->gamedesc ; ?><br/>
<span class="label_game">duration</span> : <?php echo $game_infos->duration; ?><br />
<span class="label_game">creator</span> : <?php echo $game_infos->nick; ?><br />
</div>

<div class="form_comment">
    <button type="add comment" value="submit" class="btn btn-primary"> Créer un commentaire</button>
</div>