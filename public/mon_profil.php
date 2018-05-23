<?php

session_start();
include("vue.php");
include("config.php");
enTete("Mon Profil");
page_accueil();

echo '

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                     <strong><label>Mail</label></strong>
                     <p class=\'form-control-static\'>'.$_SESSION['mail'].'</p>
                </div>
                <div class="form-group">
                     <strong><label>Nom</label></strong>
                     <p class=\'form-control-static\'>'.$_SESSION["nom"].'</p>
                </div>
                <div class="form-group">
                    <strong><label>Prénom</label></strong>
                    <p class=\'form-control-static\'>'.$_SESSION["prenom"].'</p>
                </div>                
                <div class="form-group">
                    <strong><label>Pseudo</label></strong>
                   <p class=\'form-control-static\'>'.$_SESSION["pseudo"].'</p>
                </div>                
                <div class="form-group">
                   <strong><label>Promo</label></strong>
                   <p class=\'form-control-static\'>'.$_SESSION["promo"].'</p>
                </div>                
                <div class="form-group">
                  <strong><label>Téléphone</label></strong>
                  <p class=\'form-control-static\'>'.$_SESSION["telephone"].'</p>
               </div>
            </div>

        </div>

    </div>';

echo '<form name="modifier" action="modif_profil.php" method="post" class="formulaire" align = "center">
    <input type="submit" value="Modifier" name="modifier">
    </form>';


pied();
