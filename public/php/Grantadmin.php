<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 21/05/18
 * Time: 22:25
 */

session_start();
require '../../vendor/autoload.php';
include("Vue.php");
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

entete() ;
bandeau();

$userRepository = new \User\UsersRepository($connection);
$users = $userRepository->fetchAll();
?>

<h2> ATTENTION DANGEREUX</h2>
<p>Grant admin rights to the users : </p>

<p>
<form action="Grantform.php" method="post">
    <?php

    foreach ($users as $user) : ?>

        <?php

        if( $user->getAdmin()!= 1 ) {
            echo $user->getPseudo() ;
            echo '<input type="checkbox" name="togrant[]" value="'.$user->getPseudo().'" class="ouicheck" >';
            echo '<br/>' ;
        }

        ?>

    <?php endforeach; ?>
    <br/>
    <input type="submit" value="Grant admin rights" onclick="allcheck()" id="submit"/>
    <input type="reset" value="Reset selection" onclick="allcheck()" />
</form>
</p>
<p id="warning" style="display: none" >Aucun utilisateur n'a été sélectionné</p>

<br/><br/>
<?php
echo '<h2>Admins</h2><br/>' ;
foreach ($users as $user) : ?>

    <?php

    if( $user->getAdmin()== 1 ) {
        echo $user->getPseudo() ;
        echo '<br/>' ;
    }

    ?>

<?php endforeach; ?>

<?php pied() ?>

<script>
    function allcheck(){

        var oui = document.getElementsByClassName("ouicheck") ;
        var test = 0 ;
        var i ;

        for( i=0 ; i<oui.length ; i++)
        {
            if( oui[i].checked )
            {
                test = 1 ;
            }
        }                       /** test vaut 0 si aucune box n'est cochée */

        if( test == 0 )
        {
            document.getElementById("submit").addEventListener("click", function(event){
                event.preventDefault();
            });
            $("#submit").click(function(e){e.preventDefault() ;});
            document.getElementById("warning").style.display = "inline-block";
            alert("Personne à faire disparaitre ?") ;
            event.stopPropagation() ;

        }
        else
        {
            document.getElementById("warning").style.display = "none";
        }

    }
</script>