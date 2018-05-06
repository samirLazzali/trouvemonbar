


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
            <label for="schedule"> Horaires proposés : </label>


            <button href="" class="btn btn-primary btn-sm"> Ajouter une date </button>
            <button href="" class="btn btn-primary btn-sm"> Ajouter un horaire régulier </button> <br>

                <!-- ADD A SCHEDULE -->
                <form id="oneshot" class="" action="">

                    <!-- form for adding one-time session
                    todo : finish and improve. create js function for the button -->
                    <input type="date" name="date"/>
                    <button type="submit" class="btn btn-primary btn-sm"> Ok </button>

                </form>

                <!-- form for adding  reccurent sessions
                todo : finish and impprove. create js function for the button-->
                <form id="reccurent_session" class="" action="">

                    <!-- DAY OF WEEK -->
                    <div class="form-group">
                        <select id="dayofweek" class="">
                            <option value="lundi" selected> Lundi</option>
                            <option value="mardi" > Mardi</option>
                            <option value="mercredi"> Mercredi</option>
                            <option value="jeudi"> Jeudi</option>
                            <option value="vendredi"> Vendredi </option>
                            <option value="samedi"> Samedi</option>
                            <option value="dimanche"> Dimanche</option>
                        </select>


                        <!-- RECURRENCE -->
                        <select id="reccurence">
                            <!-- todo : list of all recurrence available in the database. remove test value-->
                            <option value="1"> Toutes les semaines </option>
                            <option value="2"> Une fois toutes les deux semaines</option>
                        </select>

                        <!-- STARTING HOUR -->
                        <label for="starttime"> Début: </label>
                        <input type="time" id="starttime" name="starttime" value="20:00"/>

                        <!-- ENDING HOUR -->
                        <label for="endtime"> Fin: </label>
                        <input type="time" id="endtime" name="endtime" value="00:00"/>

                        <!-- SUBMIT -->
                        <button type="submit" class="btn btn-primary btn-sm"> Ok </button>

                    </div>
                </form>

            <ul>
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


</div>