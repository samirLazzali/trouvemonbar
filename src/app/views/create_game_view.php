


<div class="container-fluid">
    <h3> Créer une nouvelle table</h3>
</div>

<div class="container-fluid">


    <form id="form" action="create_game_action.php" method="post">
        <input type="hidden" name="creator" value="<?=$_SESSION['user']?> "/>

        <div class="form-group">
            <label for="gamename"> Nom: </label>
            <input type="text" id="gamename" name="gamename" placeholder="Nom de la table" /> <br>
        </div>

        <!-- GAME SYSTEM SELECTION -->
        <div class="form-group">
            <label for="gamesystem"> Système: </label>
            <select id="gamesystem"  class="">
                <option value="pathfinder"> Pathfinder </option>
                <option value="l5r"> Legend of the Five Rings</option>
                <!-- todo : list of systems available in the db. Remove test value above
                        todo : add system option-->
            </select>
        </div>

        <!--SCHEDULE SELECTION -->
        <div class="form-group">
            <label for="schedule"> Horaires proposés : </label> <br>

                <!-- ADD A SCHEDULE -->


            <!-- ADD A ONE-TIME SESSION -->

            <form id="oneshot">
                <label for="dateoneshot"> Date:</label>
                <input  id="dateoneshot" type="date" name="date"/>


                <label for="starttimeoneshor"> Début:</label>
                <input type="time" name="starttimeoneshot" id="starttimeoneshot" value="20:00"/>


                <label for="endtimeoneshot"> Fin: </label>
                <input type="time"  name="endtime" id="endtimeoneshot" value="00:00"/>

                <button type="button" class="btn btn-primary btn-sm" onclick="add_one_shot()"> Ajouter une date</button>

            </form>
            <br>


            <!-- ADD RECCURENT SESSSIONS -->


                <!-- day of week -->
                <select class="" id="dayofweek">
                    <option value="lundi" selected> Lundi</option>
                    <option value="mardi"> Mardi</option>
                    <option value="mercredi"> Mercredi</option>
                    <option value="jeudi"> Jeudi</option>
                    <option value="vendredi"> Vendredi</option>
                    <option value="samedi"> Samedi</option>
                    <option value="dimanche"> Dimanche</option>
                </select>


                <!-- reccurence -->
                <select id="reccurence">
                    <!-- todo : list of all recurrence available in the database. remove test value-->
                    <option value="toutes les semaines"> Toutes les semaines</option>
                    <option value="toutes les deux semaines"> Toutes les deux semaines</option>
                </select>

                <!-- starting hour todo: use timepicker library instead -->
                <label for="starttimereccurence"> Début: </label>
                <input type="time" id="starttimereccurence" name="starttime" value="20:00"/>

                <!-- ending hour -->
                <label for="endtimereccurence""> Fin: </label>
                <input type="time" id="endtimereccurence"" name="endtime" value="00:00"/>

                <!-- submit -->
                <button type="button" class="btn btn-primary btn-sm" onclick="add_reccurent()"> Ajouter un horaire récurrent</button>



            <ul id="listSchedules">
                <!-- todo : liste of schedule added so far -->

            </ul>
        </div>

        <!-- DESCRIPTION -->
        <div class="form-group">
            <label for="gamedesc"> Description: </label>
            <textarea form="form" class="form-control" rows="3" id="gamedesc" placeholder="Description de la table"> </textarea>
        </div>

        <!-- todo : add functionality : link a file from user's collection to this game -->

        <!-- SUBMIT -->
        <!-- todo : add functionality ; send a mail to guiile mailing list when submitted -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary"> Créer la table </button>
        </div>
    </form>

    <script src="js/add_schedule_script.js"></script>

</div>