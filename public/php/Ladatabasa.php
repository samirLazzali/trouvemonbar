<?php
session_start();
require '../../vendor/autoload.php';
include("Vue.php");
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UsersRepository($connection);
$users = $userRepository->fetchAll();

entete() ;
bandeau();

?>

   <p>
        <form action="DeleteUser.php" method="post">
            <?php

            foreach ($users as $user) : ?>

                <?php

                if( $user->getAdmin()!= 1 ) {
                    echo $user->getPseudo() ;
                    echo '<input type="checkbox" name="todelete[]" value="'.$user->getPseudo().'" class="ouicheck" >';

                    echo '<br/>' ;
                }

                ?>

            <?php endforeach; ?>

            <input type="submit" value="Erase existence" onclick="allcheck()" id="submit"/>
            <input type="reset" value="Reset selection" onclick="allcheck()" />
        </form>
    </p>
    <p id="warning" style="display: none" >Aucun utilisateur n'a été sélectionné</p>

<?php pied() ?>
<!--
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

-->
