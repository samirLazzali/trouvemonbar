<?php
session_start();


$_SESSION['admin'] = "1";


$_SESSION['nom'] = "King";
$_SESSION['prénom'] = "Jaime";
$_SESSION['id'] = 7;
$_SESSION['birthday'] = "1967-11-22";

function config() {
    global $nom_hote, $nom_user, $nom_base, $mdp;
    $_SESSION['nomhote'] = $nom_hote;
    $_SESSION['nombase'] = $nom_base;
    $_SESSION['nomuser'] = $nom_user;
    $_SESSION['mdp'] = $mdp;
}


require '../vendor/autoload.php';
require_once 'Vue.php';


//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new User\UserRepository($connection);
//$amisRepository = new Amis\AmisRepository($connection);
//$tweetRepository = new Tweet\TweetRepository($connection);
//$messageRepository = new Message\MessageRepository($connection);
//$tweets=$tweetRepository->fetchAll();
$tweetManager = new Tweet\TweetManager($connection);






enTete("Accueil", "CSS/style.css");

?>



<!-- <html>
<head>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
-->



<script>
      /*  function nbLike(id){
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
                    document.getElementById('like_'+id).innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "nbLike.php?T_id="+id , true);
            xhttp.send();
        }*/

      /*  var Tweets =  /*php
                    $sth = $connection->prepare('SELECT tweet.id,auteur,contenu,date_envoie FROM "amis" JOIN "tweet" ON personne1=auteur WHERE personne2=\''.$_SESSION['id'].'\' UNION SELECT tweet.id,auteur,contenu,date_envoie FROM "amis" JOIN "tweet" ON personne2=auteur WHERE personne1=\''.$_SESSION['id'].'\'  ');
                    $sth->execute();
                    $result = $sth->fetch(PDO::FETCH_OBJ);
                    echo '[';
                    while($result){
                        $likes_res = $connection->prepare('SELECT count(tweet_id) AS nb FROM "like" WHERE tweet_id='.$result->id);
                        $likes_res->execute();
                        $likes = $likes_res->fetch(PDO::FETCH_OBJ);

                        echo "[\"".prenom_user($result->auteur)."\",\"$result->contenu\",\"$result->date_envoie\",\"$result->id\",\"".$likes->nb."\"]";
                        $result = $sth->fetch(PDO::FETCH_OBJ);
                        if($result){
                            echo ",";
                        }
                       
                     }
                    echo ']';*/


      /*  var FriendList = </*?php
                    $sth = $connection->prepare('SELECT * FROM "amis" WHERE personne1=\''.$_SESSION['id'].'\' OR personne2=\''.$_SESSION['id'].'\' ');
                    $sth->execute();
                    $result = $sth->fetch(PDO::FETCH_OBJ);
                    echo '[';
                    while($result){
                        echo '["';
                        if($result->personne1 == $_SESSION['id']){
                            echo $result->personne2."\",\"".prenom_user($result->personne2) ;
                        }
                        else{
                            echo $result->personne1."\",\"".prenom_user($result->personne1) ;
                        }
                        echo '"]';
                        $result = $sth->fetch(PDO::FETCH_OBJ);
                        if($result){
                             echo ',';
                        }
                     }
                    echo ']';
                    ?> ;*/

        var AtList = 
                <?php
                    $sth = $connection->prepare('SELECT firstname FROM "user"');
                    $sth->execute();
                    $result = $sth->fetch(PDO::FETCH_OBJ);
                    echo '[';
                    while($result){
                        echo '"';
                        echo "$result->firstname" ;
                        echo '"';
                        $result = $sth->fetch(PDO::FETCH_OBJ);
                        if($result){
                             echo ',';
                        }
                     }
                    echo ']';
                    ?> ;


</script>
<script src="fonctionsJS.js"></script>



<?php
afficheMenu();
//titreH1("Accueil");

?>

<div class="recherche">
    <ul id="recherches">
        <li>
                 Rechercher un # :
            <form method='post' action="hashtag.php">
              <input list="hashtags" name="hashtag">
              <datalist id="hashtags">
            </datalist>
              <input id="afficherhashtag" type="submit" value="Afficher le Hashtag">
            </form>
        </li>
        <li>
             Rechercher un @ :
            <form method='post' action="profil.php">
              <input list="pseudos" name="pseudo" onblur="verifPseudo(this)">
              <datalist id="pseudos">
              <script >//liste_pseudos()</script>
              </datalist>
              <input type="hidden" id="visite" name="visite" value="Visiter le profil">
            </form>
            <p id="err"></p>
       </li>
    </ul>
</div>



<div class="conteneur">

<div class="writetweets">
    <p class="writetweetstext">Ecrire un tweet</p>
    <form method='post' action="ecriretweet.php">
    <input type="hidden" name="pseudo" value="<?php echo $_SESSION['prénom'] ?>"></input><br/>
    <textarea  name= "textarea" id="textarea"  placeholder="Exprimez vous..." rows="5" cols="50"></textarea>
    <input id="ok" onclick="ConfirmationTweet()" type="submit" value="Envoyer">
    </form>
</div>
<!-- AJOUT DE KEVIN-->

    <script >
        //liste_amis();
       // tweets();
        // document.getElementById('1').innerHTML = "MDR";
    </script>



<?php
afficheListeTweets(getTweetAmis($_SESSION['id']));
$friendList = get_friendList($_SESSION['id']);
afficheListeAmis($friendList);
?>

</div>




<?php
footer();
pied();
?>
