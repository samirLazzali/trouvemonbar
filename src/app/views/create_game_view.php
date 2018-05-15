


<div class="container-fluid">
    <h3> Créer une nouvelle table</h3>
</div>

<div class="container-fluid">


    <form id="form_game" action="actions/create_game_action.php" name="form_game" method="post">
        <input type="hidden" name="creator" value="<?=$_SESSION['user']?> "/>

        <div class="form-group">
            <label for="gamename"> Nom: </label>
            <input type="text" id="gamename" name="gamename" placeholder="Nom de la table" /> <br>
        </div>

        <!-- GAME SYSTEM SELECTION -->
        <div class="form-group">
            <label for="gamesystem"> Système: </label>
            <select id="gamesystem" name="gamesystem" class="">
                <?php
                if(!$gamesystems) echo "<option value='0' disabled selected> No options found </option>";
                else {
                    foreach ($gamesystems as $gamesystem)
                    {
                        echo "<option value='".$gamesystem->getGamesystemid()."'> ".$gamesystem->getSystemname()." </option>";
                    }
                }
                ?>

                <!-- todo : add an add system option-->
            </select>
        </div>

        <!-- ESTIMATED DURAION-->
        <div class="form-group">
            <label for="duration"> Nombre de séances estimé : </label>
            <input type="number" id="duration" name="duration"/>
        </div>
        <!--SCHEDULE SELECTION -->
        <div class="form-group">
            <label for="schedule"> Horaires proposés : </label> <br>

            <!-- ADD A SCHEDULE -->


            <!-- ADD A ONE-TIME SESSION -->

            <div id="oneshot">
                <label for="dateoneshot"> Date:</label>
                <input id="dateoneshot" type="date" name="date"/>


                <label for="starttimeoneshor"> Début:</label>
                <input type="time" name="starttimeoneshot" id="starttimeoneshot" value="20:00"/>


                <label for="endtimeoneshot"> Fin: </label>
                <input type="time" name="endtime" id="endtimeoneshot" value="00:00"/>

                <button type="button" class="btn btn-primary btn-sm" onclick="add_one_shot()"> Ajouter une date</button>

            </div>
            <br>


            <!-- ADD RECCURENT SESSSIONS -->


            <!-- day of week -->
            <select class="" id="dayofweek">
                <option value="1" selected> Lundi</option>
                <option value="2"> Mardi</option>
                <option value="3"> Mercredi</option>
                <option value="4"> Jeudi</option>
                <option value="5"> Vendredi</option>
                <option value="6"> Samedi</option>
                <option value="0"> Dimanche</option>
            </select>


            <!-- reccurence -->
            <select id="reccurence">
                <?php
                if(!$reccurrences) echo "<option value='0' disabled selected> No options found </option>";
                else {
                    foreach ($reccurrences as $reccurrence)
                    {
                        echo "<option value='".$reccurrence->getReccurrenceid()."'> ".$reccurrence->getReccurrencename()." </option>";
                    }
                }
                ?>
            </select>

            <!-- starting hour todo: use timepicker library instead -->
            <label for="starttimereccurence"> Début: </label>
            <input type="time" id="starttimereccurence" name="starttime" value="20:00"/>

            <!-- ending hour -->
            <label for="endtimereccurence"> Fin: </label>
            <input type="time" id="endtimereccurence" name="endtime" value="00:00"/>

            <!-- submit -->
            <button type="button" class="btn btn-primary btn-sm" onclick="add_reccurent()"> Ajouter un horaire
                récurrent
            </button>


            <!-- list of schedules added so far -->
            <!-- todo : option pour supprimer les horaires errones -->
            <ul id="listSchedules">

            </ul>


        </div>

        <!-- DESCRIPTION -->
        <div class="form-group">
            <label for="gamedesc"> Description: </label>
            <textarea form="form_game" class="form-control" rows="3" id="gamedesc" name="gamedesc" placeholder="Description de la table"> </textarea>
        </div>

        <!-- todo : add functionality : link a file from user's collection to this game -->

        <!-- SUBMIT -->
        <!-- todo : add functionality ; send a mail to guiile mailing list when submitted -->
        <div class="form-group">
            <button type="submit" value="submit" class="btn btn-primary"> Créer la table </button>
        </div>
    </form>

    <script src="js/add_schedule_script.js"></script>

</div>