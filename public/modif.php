<?php
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

session_start();

if(isset($_SESSION['nom']) && isset($_POST['mdp']) && isset($_POST['newmdp']) && isset($_POST['newmdp2'])){
    $req1 = "SELECT nom FROM utilisateur WHERE nom=? AND mdp=?;";
    $rep1 = $connection->prepare($req1);
    $rep1->execute(array($_SESSION['nom'],$_POST['mdp']));
    $res1=$rep1->fetch();
    
    if(!isset($res1['nom'])){
        echo "Mauvais mot de passe.";
    }
    elseif($_POST['newmdp'] != $_POST['newmdp2']){
        echo "Les mots de passe ne correspondent pas.";
    }
    else{
        $req2 = "UPDATE utilisateur SET mdp=? WHERE nom=?;";
        $rep2 = $connection->prepare($req2);
        $rep2->execute(array($_POST['newmdp'],$_SESSION['nom']));
        echo "Votre mot de passe a bien été modifié.";
    }
}

if(isset($_SESSION['nom']) && isset($_POST['newdesc'])){

    $req3 = "UPDATE utilisateur SET description=? WHERE nom=?;";
    $rep3 = $connection->prepare($req3);
    $rep3->execute(array($_POST['newdesc'],$_SESSION['nom']));
    echo "Votre description a bien été modifiée.";
}

if(isset($_SESSION['nom']) && isset($_POST['newefav'])){
    $efav = $_POST['newefav'];
    $nomm = $_SESSION['nom'];
    $req4 = "UPDATE utilisateur SET e_fav='$efav' WHERE nom='$nomm';";
    $rep4 = $connection->prepare($req4);
    $rep4->execute();
    echo "Votre équipe favorite a bien été modifiée. Footix.";
}
?>


<html>
<head>
    <link rel="stylesheet" href="css2.css"
    <title>Modification des informations</title>
</head>
<h1>Modifiez vos informations personnelles</h1>
<form action="modif.php" method="post">
	<ul>
		<li>
			<label for="mdp">Votre ancien mot de passe</label><br/>
			<input type="password" name="mdp" id="mdp"/>
		</li><br/>
		<li>
			<label for='newmdp'>Votre nouveau mot de passe</label><br/>
			<input type='password' name='newmdp' id='newmdp'/>
		</li><br/>
		<li>
			<label for='newmdp2'>Confirmez votre nouveau mot de passe</label><br/>
			<input type='password' name='newmdp2' />
		</li><br/>
		<li>
			<label for='newdesc'>Modifiez votre description</label><br/>
			<input type='text' name='newdesc' maxlength="200"/>
		</li><br/>
		<li>
			<label for='newefav'>Choisissez votre nouvelle équipe favorite</label><br/>
			<select name="newefav">
            <?php
            $req3 = "SELECT nom FROM equipe;";
            $rep3 = $connection->prepare($req3);
            $rep3->execute();
            foreach($rep3 as $nomequipe){
                $nomeq = $nomequipe['nom'];
                echo "<option value='$nomeq'>$nomeq</option>";
        	}
    	    ?>
            </select>
        </li><br/>
		<li><input type='submit' name='Valider'></li>
	</ul>
</form>
<a href="membre.php">Revenir a l'accueil</a>
</html>