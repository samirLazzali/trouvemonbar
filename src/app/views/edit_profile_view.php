
<h2>Editer mon profile</h2>



<form action="actions/edit_profile_action.php?userid=<?php echo $user->getId()?>" method="post">

    pseudo: <input type='text' name='nick' value="<?php echo $user->getNick()?>"></br>
       nom: <input type='text' name='lastname' value="<?php echo $user->getLastname()?>"></br>
    prénom: <input type='text' name='firstname' value="<?php echo $user->getFirstname()?>"></br>
    e-mail: <input type='text' name='mail' value="<?php echo $user->getMail()?>"></br>


    <label for="gamesystem"> Système: </label></br>
    <div class="form-group">

        <select id="gamesystem" name="gamesystem[]" class="">
            <?php
            if(!$gamesystems) echo "<option value='0' disabled selected> No options found </option>";
            else {
                foreach ($gamesystems as $gamesystem)
                {
                    echo "<option value='".$gamesystem->getGamesystemid()."'> ".$gamesystem->getSystemname()." </option>";
                }
            }
            ?>
        </select>
        <button  type="button" onclick="add_tr(this)" >Aouter</button>
        <button type="button"   value="Suprimer" onclick="del_tr(this)">Supprimer</button>
            </br>
    </div>

    mot de passe: <input id="ps" type="hidden" name="password" placeholder="Password"/>
                <button  type="button" onclick='$("#ps").attr("type","password")'>Editer</button></br>
    <input class="btn bg-success text-white" type="submit" name="Changer mon profile" value="change mon profile"/>
</form>


<script src="js/edit_script.js"></script>