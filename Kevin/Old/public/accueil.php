<?php
session_start();
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
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new User\UserRepository($connection);
$amisRepository = new Amis\AmisRepository($connection);
$tweetRepository = new Tweet\TweetRepository($connection);
$messageRepository = new Message\MessageRepository($connection);
$tweets=$tweetRepository->fetchAll();
$tweetManager = new Tweet\TweetManager($connection);


?>



<html>
<body>

<style>
    #err{
      color: red;
      font-size: 11px;
    }
</style>
<script>

        var Tweets =  <?php
                    $sth = $connection->prepare('SELECT tweet.id,auteur,contenu,date_envoie FROM "amis" JOIN "tweet" ON personne1=auteur WHERE personne2=\''.$_SESSION['prénom'].'\' UNION SELECT tweet.id,auteur,contenu,date_envoie FROM "amis" JOIN "tweet" ON personne2=auteur WHERE personne1=\''.$_SESSION['prénom'].'\'  ');
                    $sth->execute();
                    $result = $sth->fetch(PDO::FETCH_OBJ);
                    echo '[';
                    while($result){
                        echo "[\"$result->auteur\",\"$result->contenu\",\"$result->date_envoie\",\"$result->id\"]";
                        $result = $sth->fetch(PDO::FETCH_OBJ);
                        if($result){
                            echo ",";
                        }
                       
                     }
                    echo ']';

                    ?> ;



         var FriendList = <?php
                    $sth = $connection->prepare('SELECT * FROM "amis" WHERE personne1=\''.$_SESSION['prénom'].'\' OR personne2=\''.$_SESSION['prénom'].'\' ');
                    $sth->execute();
                    $result = $sth->fetch(PDO::FETCH_OBJ);
                    echo '[';
                    while($result){
                        echo '"';
                        if($result->personne1 == $_SESSION['prénom']){
                            echo "$result->personne2" ;
                        }
                        else{
                             echo "$result->personne1" ;
                        }
                        echo '"';
                        $result = $sth->fetch(PDO::FETCH_OBJ);
                        if($result){
                             echo ',';
                        }
                     }
                    echo ']';
                    ?> ;

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


                /************************** AJOUT DE KEVIN ****************************/
    function nbLike(id){
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
                document.getElementById('like_'+id).innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "nbLike.php?T_id="+id , true);
        xhttp.send();
    }
    function Liker(T_id){
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
                alert("Tweet Liké");
            }
        };
        xhttp.open("GET", "Liker.php?pseudo_id=<?php echo $_SESSION['id']; ?>+T_id="+T_id, true);
        xhttp.send();
    }

    function tweets(){
        document.write("Derniers Tweets :<br/><br/>");
        for(var i=0; i<Tweets.length;i++){
             document.write(Tweets[i][0] + " a tweeté à " + Tweets[i][2] +" : <br/>"+ Tweets[i][1]+"<br/>" );
             document.write("<button id=\""+ Tweets[i][3] + "\" onclick=\"Liker("+Tweets[i][3]+")\">J'aime</button> Nb de J'aimes : <span id=\"like_"+ Tweets[i][3]+"\"></span><br/><br/>");
             nbLike(Tweets[i][3])
        }
    }

        /**************************************** FIN AJOUT *************************************/


    function EcrireTweet(){
       var ok = document.getElementById("ok");
       ok.type="submit";
       var textarea = document.getElementById("textarea");
       textarea.style="display";

        

    }

    function ConfirmationTweet(){
        alert("Tweet Envoyé");
    }

    function liste_amis(){
        document.write("<p>Vos amis:</p>");
        for(var i=0;i<FriendList.length;i++){
            document.write("<a href=\"profil.php?pseudo=" + FriendList[i] + "\">" + FriendList[i] + "</a><br/>");
        }
        document.write("<br/>");
    }
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

   



</script>
Bienvenue <?php echo $_SESSION['prénom'] ?> ! </br>

Rechercher un # :</br>
<form method='post' action="hashtag.php">
  <input list="hashtags" name="hashtag">
  <datalist id="hashtags">
</datalist>
  <input id="afficherhashtag" type="submit" value="Afficher le Hashtag">
</form>
Rechercher un @ :</br>
<form method='post' action="profil.php">
  <input list="pseudos" name="pseudo" onblur="verifPseudo(this)">
  <datalist id="pseudos">
  <script >liste_pseudos()</script>
  </datalist>
  <input type="hidden" id="visite" name="visite" value="Visiter le profil">
</form>
<p id="err"></p>
<form method='post' action=<?php echo "edition.php?pseudo=".$_SESSION['prénom'] ?>>
<input type="submit" name="editio" value="Personnaliser ...">
</form>

<button onclick="EcrireTweet()">Ecrire un tweet</button>

<form method='post' action="ecriretweet.php">
<input type="hidden" name="pseudo" value="<?php echo $_SESSION['prénom'] ?>"></input><br/>
<textarea  name= "textarea" id="textarea" style="display: none" placeholder="Exprimez vous..." rows="5" cols="50"></textarea>
<input id="ok" onclick="ConfirmationTweet()" type="hidden" value="Envoyer">
</form>



<!-- AJOUT DE KEVIN-->
<a href="Msg_Ecrire.php">Écrire un message</a></br>


<script >
    liste_amis();
    tweets();
   // document.getElementById('1').innerHTML = "MDR";
</script>


</body>
</html>

