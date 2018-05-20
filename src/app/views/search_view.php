
<!--search bar -->
<div align="center">
    <form id="form_search" action="search_user.php" method="get" class="mt-2">
        <label for=""> Nom : </label> <input id="name" type="text" name="lastname" value="" size="8"/>
        <label for=""> Pseudo: </label> <input id="nick" type="text" name="nick" value="" size="8"/>
        <label for=""> Table： </label> <input id="gamename"type="text" name="gamename" value="" size="8"/>
        <label for"system"> Système meujeuté :</label> <input type="text" id="system" name="gamesystem" size="10"/>
        <input type="submit" value="Rechercher" class="btn btn-primary">
    </form>
<br/>

<!--a table for the result-->
    <label for="search_result">  <span class="font-weight-bold"> Recherche pour : </span>
        <?php
        $list=array();
        if(isset($lastname)) $list[] = '"'.$lastname.'"';
        if(isset($nick)) $list[] = '"'.$nick.'"';
        if(isset($gamename)) $list[]='"'.$gamename.'"';
        if(isset($gamesystem)) $list[]='"'.$gamesystem.'"';
        echo implode(',', $list);
        ?>
    </label>
<table border="1" width="500" class="table" id="search_result" >
    <thead>
        <th scope="col">Pseudo</th>
    </thead>
    <tbody>
    <?php foreach ($result as $u){?>
        <tr>
            <td scope="row"><a href="user_profile.php?user=<?php echo $u->userid ?>"> <?php echo $u->nick ?></a> </td>
            <!--<td><a href="view_game.php?id=<?=$u->gameid ?>"> <?=$u->gamename ?></a> </td>-->

        </tr>
    <?php }?>
    </tbody>

</table>
</div>