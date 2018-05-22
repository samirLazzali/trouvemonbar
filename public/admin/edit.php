<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();

if(isset($_SESSION['id_user']))
{
    header('Location: '.ROOTPATH.'/index.php');
    exit();
}

include('topCrud.php');

$titre = 'Inscription';
?>
        <script> 
        function verifNum(valeur){
            for (var i=0; i<valeur.length; i++){
                var caractere=valeur.substring(i,i+1);
                if (caractere < ”0” || caractere > ”9”) {
                    return false; 
                }
            }
            return true;
        }
        </script>
        
        <div id="contenu">


            
            <h1>Formulaire de modification</h1>
            <p>Bienvenue sur la page de modification.<br/>
            Merci de remplir ces champs pour continuer.</p>
            <form action="champs_edit.php" method="post" name="Inscription">
                <?php
                $id_modif=$_GET['id_modif'];
                ?>
                <fieldset><legend>Renseignements</legend>
                <table>
                    <tr>

                    <?php

                    $dbName = getenv('DB_NAME');
                    $dbUser = getenv('DB_USER');
                    $dbPassword = getenv('DB_PASSWORD');
                    $connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
                    $resultat=$connexion->query("SELECT id_user, login, mail,phone_number FROM Utilisateur WHERE id_user = '".$_GET['id_modif']."'");
                    $fetch = $resultat -> fetch(PDO::FETCH_OBJ);

                    ?>


                    <td><label for="pseudo" class="float">Nom d'utilisateur :</label></td>

                    <?php
                    echo '<td><input type="text" name="login" value='.$fetch->login. ' id="login" size="30" /></td>'
                    ?>



                    <td><em> (compris entre 3 et 32 caractères)</em></td>
                    </tr>
                    
                    <tr>
                    
                    <td><label for="mail" class="float">Mail :</label></td>

                    <?php
                    echo '<td><input type="text" name="mail" value='.$fetch->mail. ' id="mail" size="30" /></td>'
                    ?>

                    <td></td>
                    </tr>
                    <tr>
                    <td><label for="mail_verif" class="float">Mail (vérification) :</label></td>

                    <?php
                    echo '<td><input type="text" name="mail_verif" value='.$fetch->mail. ' id="mail_verif" size="30" /></td>'
                    ?>

                    <td></td>
                    </tr>
                    <tr>
                    <td><label for="phone_number" class="float">Numéro de téléphone :</label></td>
                    
                    <?php
                    echo '<td><input type="integer" name="phone_number" value='.$fetch->phone_number. ' id="phone_number" size="30" /></td>'
                    ?>

                    <td></td>
                    </tr>

                    <?php echo "<tr><input type='hidden' name='id_modif' value='".$_GET['id_modif']."'/></tr>" ?>



                </table>
                    <input type="submit" value="Valider" />
                </fieldset>
            </form>
        </div>

<?php
        include('../includes/bottom.php');
        ?>