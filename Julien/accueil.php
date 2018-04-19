<?php
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
$pseudo = "YouChama";
?>


<html>
<body>
<script type="text/javascript">
    function AtResearch(){
        var r = document.getElementById("@research");
        if(r.value==""){
            r.value="@"
        }
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

        var content = r.value.toString();
        var l = content.length;
        content = content.substr(1, l-1); 
        var result = document.getElementById("result");
        if(l!=1){
            result.innerHTML = "Résultats :<br";
            for(var i = 0; i < AtList.length; i++){
                if(AtList[i].substr(0, l-1) == content){
                    result.innerHTML += " " + '<a href="profil.php?id=' +AtList[i] +'">' +  AtList[i]+"</a><br>" ;
                }
             } 
        }

        else{
             result.innerHTML = "";
        }
    }
    function HashTagResearch(){
        var r = document.getElementById("#research");
        if(r.value==""){
            r.value="#"
        }
    }
</script>
Bienvenue <?php echo $pseudo ?> ! 
<form>
    Rechercher un # :<br>
    <input type="text" id="#research" onkeyup=HashTagResearch()  value="#"><br>
    Rechercher un @:<br>
    <input type="text" id="@research" onkeyup=AtResearch() value="@"><br>
    <p id="result"></p>
</form>
<button>Ecrire un Tweet</button>
<button>Ecrire un message</button>
<a href='<?php echo "edition.php?id=$pseudo" ?>'>Personnaliser ...</a><br>
Derniers Tweets :
<form>

</form>
</body>
</html>

