
if(!(isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['nickname']) &&  isset($_POST['mail']) && isset($_POST['quote']) && isset($_POST['scientist']) && isset($_POST['password'])&& isset($_POST['password2']) && isset($_POST['sign'])))
{
    header('Location: inscription.php');
    die('Il manque des informations !');
}

$db=db_connect();

$result = pg_prepare($db, "is_registered", 'SELECT est_admin FROM utilisateur JOIN tab_role ON utilisateur.role=tab_role.role WHERE username= $3');
if (!$result) {
    echo '<p>Erreur de connexion. <a href="inscription.php">Réessayez</a> ?</p>';
}
$result=pg_execute($db, "is_registered", array($_POST['nickname']));
<?php
	require_once("en_tete");
	en_tete();
?>

if(pg_num_rows($result)>0)
{
    echo '<p>Une personne possède déjà ce surnom. <a href="inscription.php">Réessayer</a> ?</p>';
}

else
{
//$result = pg_query($db, 'INSERT INTO utilisateur (id, nom, prenom, username, password, role, email, citation, scientifique_prefere, signup_date) VALUES (\''.$_POST['lastname'].'\',\''.$_POST["name"].'\',\''.$_POST["nickname"].'\',\''.$_POST["password"].'\',\''.$_POST["mail"].'\',"membre",\''.$_POST["quote"].'\',\''.$_POST["scientist"].'\')');
    $result = pg_insert($db, 'utilisateur', array('id'=50000000000000000000,'nom'=>($_POST['name']),'prenom'=>($_POST['firstname']),'username'=>($_POST['nickname']),'password'=>($_POST['password']),'role'=>"membre",' 'email'=>($_POST['mail']),citation'=>($_POST['quote']),'scientifique_prefere'=>($_POST['scientist']),'signup_date=($_POST['sign']));
    if (!$result)
    {
        echo '<p>Erreur pour insérer vos informations dans la base de donnée <a href="inscription.php">Réessayer</a></p>';
    }
    else 
    {
        echo '<p>Inscription effectuée <a href="login.php">Se connecter</a></p>';
    }
}


<?php
	require_once("pied");
	pied();
?>