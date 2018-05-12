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
require_once 'Vue.php';


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
<head>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
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

        var Tweets =  <?php
                    $sth = $connection->prepare('SELECT tweet.id,auteur,contenu,date_envoie FROM "amis" JOIN "tweet" ON personne1=auteur WHERE personne2=\''.$_SESSION['id'].'\' UNION SELECT tweet.id,auteur,contenu,date_envoie FROM "amis" JOIN "tweet" ON personne2=auteur WHERE personne1=\''.$_SESSION['id'].'\'  ');
                    $sth->execute();
                    $result = $sth->fetch(PDO::FETCH_OBJ);
                    echo '[';
                    while($result){
                        /********************** AJOUT POUR RECUPERER NB DE LIKES *******************************/
                        $likes_res = $connection->prepare('SELECT count(tweet_id) AS nb FROM "like" WHERE tweet_id='.$result->id);
                        $likes_res->execute();
                        $likes = $likes_res->fetch(PDO::FETCH_OBJ);

                        echo "[\"".prenom_user($result->auteur)."\",\"$result->contenu\",\"$result->date_envoie\",\"$result->id\",\"".$likes->nb."\"]";
                        $result = $sth->fetch(PDO::FETCH_OBJ);
                        if($result){
                            echo ",";
                        }
                       
                     }
                    echo ']';

                    ?> ;

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


                /************************** AJOUT DE KEVIN ****************************/

    function Liker(T_id){
        document.location.href = 'Likes/Liker.php?T_id='+T_id+'&pseudo_id=<?php echo $_SESSION['id']; ?>';
       /* var xhttp;

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
                if (this.responseText == -1){

                    var xhttp2;
                    xhttp2 = new XMLHttpRequest();
                    xhttp2.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
                            alert("Tweet Disliké");
                            document.location.reload(true);
                        }
                    };
                    xhttp2.open("GET", "Likes/Dislike.php?pseudo_id=<//?php echo $_SESSION['id']; ?>&T_id="+T_id, true);
                    xhttp2.send();
                }
                else{
                    alert("Tweet Liké");
                    document.location.reload(true);
                }
            }
        };
        xhttp.open("GET", "Likes/Liker.php?pseudo_id=<//?php echo $_SESSION['id']; ?>&T_id="+T_id, true);
        xhttp.send();*/
    }

    function deja_liker(T_id){

        document.getElementById(T_id).innerHTML="Je n'aime plus";

    }

    function tweets(){
        document.write("<div class=\"alltweets\">Derniers Tweets :<br/><br/>");
        for(var i=0; i<Tweets.length;i++){
             document.write("<div class=\"tweets\">" + Tweets[i][0] + " a tweeté à " + Tweets[i][2] +" : <br/>"+ Tweets[i][1]+"<br/>" );
             document.write("<button id=\""+ Tweets[i][3] + "\" onclick=\"Liker("+Tweets[i][3]+")\">J'aime</button> Nb de J'aimes :"+ Tweets[i][4] +"</br>");
            document.write("<button id=\"Comment\">Afficher les commentaires</button></div><br/><br/>");

        }
        document.write("</div");

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
        document.write("<div class=\"amis\">Vos amis:<br/>");
        for(var i=0;i<FriendList.length;i++){
            document.write("<a href=\"profil.php?pseudo=" + FriendList[i][1] + "\">@" + FriendList[i][1] + "</a><br/>");
        }
        document.write("</div>");
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
    
   /* function suggestionHashtag(){

    }
    function suggestionUser(){

    }*/




</script>




<?php
afficheMenu()
?>


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
              <script >liste_pseudos()</script>
              </datalist>
              <input type="hidden" id="visite" name="visite" value="Visiter le profil">
            </form>
            <p id="err"></p>
       </li>
    </ul>

    




<span class="writetweetstext">Ecrire un tweet</span>
<form class="writetweets" method='post' action="ecriretweet.php">
<input type="hidden" name="pseudo" value="<?php echo $_SESSION['prénom'] ?>"></input><br/>
<textarea  name= "textarea" id="textarea"  placeholder="Exprimez vous..." rows="5" cols="50"></textarea>
<input id="ok" onclick="ConfirmationTweet()" type="submit" value="Envoyer">
</form>

<!-- AJOUT DE KEVIN-->


<?php
$friendList = get_friendList($_SESSION['id']);
afficheListeAmis($friendList);
?>
<script >
    tweets();
   // document.getElementById('1').innerHTML = "MDR";
</script>


</body>
</html>

