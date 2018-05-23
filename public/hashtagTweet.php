<?php

session_start();
require '../vendor/autoload.php';
require_once 'Vue.php';
require_once 'Modele.php';


if (isset($_POST['hashtag'])){
    $hashtag = $_POST['hashtag'];
    $_SESSION['hashtag'] = $hashtag;
}
else if (isset($_GET['hashtag'])){
    $hashtag = $_GET['hashtag'];
    $_SESSION['hashtag'] = $hashtag;
}
else {
    $hashtag=$_SESSION['hashtag'];
}

if ($hashtag != ""){
    if($hashtag[0]=='#'){
        $hashtag = substr($hashtag, 1);
    }
}
$hashtag_id = getHashtagId($hashtag);

?>
<script src="fonctionsJS.js"></script>
<?php

enTete("Tweet", "CSS/style.css");
afficheMenu(".");



if ($hashtag_id == -1){
    titreH1("Aucun tweet avec ce hashtag : ".$hashtag);
    print "<div class=\"conteneur\">\n";
    print "</div>";
}
else {
    titreH1("Tweets contenant l'hashtag #" . $hashtag);


    print "<div class=\"conteneur\">\n";
    $tweets = getTweetsHashtag($hashtag_id);
    afficheListeTweets($tweets);

    /*
    echo '<pre>';
    print_r($tweets);
    echo '</pre>';
    */

    $friendList = get_friendList($_SESSION['id']);
    afficheListeAmis($friendList);
    print "</div>";
}

footer();
pied();

?>