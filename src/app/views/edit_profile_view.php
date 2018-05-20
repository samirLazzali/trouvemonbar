<div class="container-fluid mt-2 ml-2">
<h2>Éditer mon profil</h2>

<form action="actions/edit_profile_action.php?userid=<?php echo $user->getId()?>" method="post" id="edit_profile" name="edit_profile">

    <div class="form-group">
        <label for="nick"> Pseudo: </label> <input type='text' name='nick' id="nick" value="<?php echo $user->getNick()?>"/>
    </div>

    <div class="form-group"> <label for="lastname">Nom:</label> <input id="lastname" type='text' name='lastname' value="<?php echo $user->getLastname()?>"/></div>
    <div class="form-group"><label for="firstname"> Prénom:</label> <input id="firstname" type='text' name='firstname' value="<?php echo $user->getFirstname()?>"/></div>
    <div class="form-group"> <label for="mail"> E-mail:</label> <input id="mail" type='text' name='mail' value="<?php echo $user->getMail()?>"/></div>

    <!-- select a new system to add -->
    <label for="select_system"> Je peux faire jouer les systèmes :  </label></br>
    <div class="form-group">

        <select id="select_system" name="gamesystem" onchange="update_select()" class="">
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
        <button  type="button" class="btn btn-primary btn-sm" onclick="add_system()"> Ajouter</button>

    </div>
    <!-- all current systems -->
    <label for="list_systems" class="font-weight-bold"> Les systèmes suivants vont être ajoutés :  </label>
    <ul class="list-group" id="list_systems">

    </ul>

    Mot de passe: <input id="ps" type="hidden" name="password" placeholder="Password"/>
                <button  type="button" class="btn btn-primary btn-sm" onclick='$("#ps").attr("type","password")'>Éditer</button></br>
    <input class="btn bg-success text-white mt-2" type="submit" name="Changer mon profil" value="Validerl"/>
</form>

</div>
<script src="js/edit_script.js"></script>