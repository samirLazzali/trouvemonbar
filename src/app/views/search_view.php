
<!--search bar -->
<div align="center">
<form id="form_search" action="search_user.php" method="get">
    nom：<input type="text" name="lastname" value="" size="8">
    pseudo:<input type="text" name="nick" value="" size="8">
    jeu de rôle：<input type="text" name="gamename" value="" size="8">
    <input type="submit" value="search">
</form>
<br/>
<!--a table for the result-->
<table border="1" width="500" >
    <tr>
        <td>nom</td>
        <td>pseudo</td>
        <td>jeu de rôle</td>
    </tr>
    <?php foreach ($result as $u){?>
        <tr>
            <td><?php echo $u->lastname ?></td>
            <td><a href="user_profile.php?user=<?php echo $u->userid ?>"> <?php echo $u->nick ?></a> </td>
            <td><a href="view_game.php?id=<?php echo $u->gameid ?>"> <?php echo $u->gamename ?></a> </td>
        </tr>
    <?php }?>

</table>
</div>