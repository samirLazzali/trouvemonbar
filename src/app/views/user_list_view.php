<div class="container">
    <table id='userlist' class="table">


        <thead class="thead-dark">
            <th scope="col">Pseudo</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
        </thead>
        <tbody>
        <?php
            foreach ($userlist as $user)
            {

                echo "<tr>";
                echo "    <th scope='row'> <a href=\"user_profile.php?user=$user->userid\"> $user->nick </a> </th>";
                echo "    <td> $user->firstname </td>";
                echo "    <td> $user->lastname </td>";
                echo "</tr>";
            }
    ?>
        </tbody>
    </table>
    <!--search bar -->
    <label for="form_search" class="font-weight-bold"> Rechercher par : </label>
    <form id="form_search" action="search_user.php" method="get">
        <label for=""> Nom : </label> <input id="name" type="text" name="lastname" value="" size="8"/>
        <label for=""> Pseudo: </label> <input id="nick" type="text" name="nick" value="" size="8"/>
        <label for=""> Table： </label> <input id="gamename"type="text" name="gamename" value="" size="8"/>
        <input type="submit" value="Rechercher" class="btn btn-primary">
    </form>
</div>
