<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 18/05/2018
 * Time: 15:34
 */
echo "<table id='userlist'>
        <tr><th>Pseudo</th><th>Prénom</th><th>Nom</th></tr>";


foreach ($userlist as $user)
{

    echo "<tr>";
    echo "<th>";
    echo "<a href=\"user_profile.php?user=$user->userid\"> $user->nick </a> ";
    echo "</th>";
    echo "<th>";
    echo "$user->firstname ";
    echo "</th>";
    echo "<th>";
    echo "$user->lastname";
    echo "</th>";
    echo "</tr>";
}

echo "</table>";
?>
<!--search bar -->
<form action="search_action.php" method="get">
    nom：<input type="text" name="name" value="" size="8">
    pseudo:<input type="text" name="nick" value="" size="8">
    jeu de rôle：<input type="text" name="gamename" value="" size="8">
    <input type="submit" value="search">
</form>
<br/>
