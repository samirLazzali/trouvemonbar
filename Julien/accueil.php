<?php
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
$messages=$messageRepository->fetchAll();



$pseudo = "Jaime";
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
                    $sth = $connection->prepare('SELECT auteur,contenu,date_envoie FROM "amis" JOIN "tweet" ON personne1=auteur WHERE personne2=\''.$pseudo.'\' UNION SELECT auteur,contenu,date_envoie FROM "amis" JOIN "tweet" ON personne2=auteur WHERE personne1=\''.$pseudo.'\'  ');
                    $sth->execute();
                    $result = $sth->fetch(PDO::FETCH_OBJ);
                    echo '[';
                    while($result){
                        echo "[\"$result->auteur\",\"$result->contenu\",\"$result->date_envoie\"]";
                        $result = $sth->fetch(PDO::FETCH_OBJ);
                        if($result){
                            echo ",";
                        }
                       
                     }
                    echo ']';

                    ?> ;



         var FriendList = <?php
                    $sth = $connection->prepare('SELECT * FROM "amis" WHERE personne1=\''.$pseudo.'\' OR personne2=\''.$pseudo.'\' ');
                    $sth->execute();
                    $result = $sth->fetch(PDO::FETCH_OBJ);
                    echo '[';
                    while($result){
                        echo '"';
                        if($result->personne1 == $pseudo){
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


    function tweets(){
        document.write("Derniers Tweets :<br/><br/>");
        for(var i=0; i<Tweets.length;i++){
             document.write(Tweets[i][0] + " a tweeté à " + Tweets[i][2] +" : <br/>"+ Tweets[i][1]+"<br/>" );
             document.write("<button>J'aime</button> Nb de J'aimes : "+  "<br/><br/>");

        }
    }

    function EcrireTweet(){
        var tweet = prompt("Exprimez vous : ");
    }


    function liste_amis(){
        document.write("<p>Vos amis:</p>");
        for(var i=0;i<FriendList.length;i++){
            document.write(FriendList[i]+"<br/>");
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
Bienvenue <?php echo $pseudo ?> ! <br>

Rechercher un # :<br>
<form method='post' action="hashtag.php">
  <input list="hashtags" name="hashtag">
  <datalist id="hashtags">
</datalist>
  <input id="afficherhashtag" type="submit" value="Afficher le Hashtag">
</form>
Rechercher un @ :<br>
<form method='post' action="profil.php">
  <input list="pseudos" name="pseudo" onblur="verifPseudo(this)">
  <datalist id="pseudos">
  <script >liste_pseudos()</script>
  </datalist>
  <input type="hidden" id="visite" value="Visiter le profil">
</form>
<p id="err"></p>
<button onclick="EcrireTweet()">Ecrire un Tweet</button>
<button>Ecrire un message</button>
<form method='post' action="edition.php">
<input type="hidden" name="pseudo" value="<?php echo "".$pseudo."" ?>"></input>
<input type="submit" value="Personnaliser ...">
</form>
<script >
    liste_amis();
    tweets();
</script>


</body>
</html>

