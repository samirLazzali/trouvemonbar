<?php
session_start();




function config() {
    $_SESSION['admin'] = "TRUE";

    $_SESSION['nom'] = "King";
    $_SESSION['prénom'] = "Jaime";
    $_SESSION['id'] = 7;
    $_SESSION['birthday'] = "1967-11-22";
    $_SESSION['mdp'] = '123';
}

config();

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




<script src="fonctionsJS.js"></script>

<script>
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

        function liste_pseudos(){
            for(var i=0;i<AtList.length;i++){
                document.write("<option value='"+AtList[i]+"' id='"+AtList[i]+"'>");
            }
        }
        function surligne(champ, erreur){
            if(erreur) champ.style.backgroundColor = "#fba";
            else champ.style.backgroundColor = "";
        }
        function is_in_list(value){
            for(var i=0;i<AtList.length;i++){
                if(value==AtList[i]){
                    return true;
                }
            }
            return false;
        }
        function verifPseudo(champ){
            var err = document.getElementById("err");
            var visite = document.getElementById("visite");
            if(champ.value.length==0){
                surligne(champ, false);
                err.innerHTML="";
                return true;
            }
            else if(!(is_in_list(champ.value))){
                surligne(champ, true);
                err.innerHTML="Entrez un pseudo valide";
                visite.type="hidden";
                return false;
            }
            else{
                surligne(champ, false);
                err.innerHTML="";
                visite.type="submit";
                return true;
            }
        }

        function EcrireTweet(){
            var ok = document.getElementById("ok");
            ok.type="submit";
            var textarea = document.getElementById("textarea");
            textarea.style="display";
        }

        function ConfirmationTweet(){
            alert("Tweet Envoyé");
        }


</script>



<?php
afficheMenu();
//titreH1("Accueil");

?>

<div class="recherche">
    <ul id="recherches">
        <li>
                 Rechercher un # :
            <form method='post' action="hashtagTweet.php">
                <input list="hashtags" name="hashtag" onkeyup="suggestionHashtag(this.value)">
                <datalist id="hashtags">

                </datalist>
                <input type="submit" value="Afficher le Hashtag"></br>

            </form>
        </li>
        <li>
             Rechercher un @ :
            <form method='post' action="profil.php">
              <input list="pseudos" name="pseudo" onblur="verifPseudo(this)">
              <datalist id="pseudos">
              <script>liste_pseudos()</script>
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
    <form method='post' action="ecriretweet.php" id="ecriretweet">
    <input type="hidden" name="pseudo" value="<?php echo $_SESSION['prénom'] ?>"></input><br/>
    <textarea  name= "textarea" id="textarea"  placeholder="Exprimez vous..." onkeypress="if(event.keyCode==13){ConfirmationTweet();document.getElementById('ecriretweet').submit();}"></textarea>
    <input id="ok" onclick="ConfirmationTweet()" type="submit" value="Envoyer">
    </form>
</div>




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
