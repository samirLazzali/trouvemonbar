
<!--search bar -->
<div align="center">
    <form id="form_search" action="search_user.php" method="get">
        <label for=""> Nom : </label> <input id="name" type="text" name="lastname" value="" size="8"/>
        <label for=""> Pseudo: </label> <input id="nick" type="text" name="nick" value="" size="8"/>
        <label for=""> Table： </label> <input id="gamename"type="text" name="gamename" value="" size="8"/>
        <input type="submit" value="Rechercher" class="btn btn-primary">
    </form>
<br/>

<!--a table for the result-->
<table border="1" width="500" class="table" >
    <thead>
        <th scope="col">Pseudo</th>
        <th scope="col">Table</th>
        <th scope="col"> Nom </th>
        <th scope="col"> Prénom</th>
    </thead>
    <tbody>
    <?php foreach ($result as $u){?>
        <tr>
            <td scope="row"><a href="user_profile.php?user=<?php echo $u->userid ?>"> <?php echo $u->nick ?></a> </td>
            <td><a href="view_game.php?id=<?php echo $u->gameid ?>"> <?php echo $u->gamename ?></a> </td>
            <td><?php echo $u->firstname ?></td>
            <td><?php echo $u->lastname ?></td>
        </tr>
    <?php }?>
    </tbody>

</table>
</div>