<div class="container">

    <!--search bar -->
    <label for="form_search" class="font-weight-bold"> Rechercher par : </label>
    <form id="form_search" action="search_user.php" method="get">
        <label for="name"> Nom : </label> <input id="name" type="text" name="lastname" size="10"/>
        <label for="nick"> Pseudo: </label> <input id="nick" type="text" name="nick" size="10"/>
        <label for="gamename"> Table： </label> <input id="gamename"type="text" name="gamename" size="10" />
        <label for"system"> Système meujeuté :</label> <input type="text" id="system" name="gamesystem" size="10"/>
        <input type="submit" value="Rechercher" class="btn btn-primary  ml-3">
    </form>

    <!-- userlist -->
    <table id='userlist' class="table mt-2">


        <thead class="">
            <th scope="col">Pseudo</th>
        </thead>
        <tbody>
        <?php
            foreach ($userlist as $user)
            {

                echo "<tr>";
                echo "    <th scope='row'> <a href=\"user_profile.php?user=$user->userid\"> $user->nick </a> </th>";
                echo "</tr>";
            }
    ?>
        </tbody>
    </table>

</div>
