<?php
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

//on teste si le visiteur a rempli le formulaire
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription'){
    
    //on vérifie que nos variables existent et ne sont pas vides
    if ((isset($_POST['nom']) && !empty($_POST['nom'])) && (isset($_POST['mdp']) && !empty($_POST['mdp'])) && (isset($_POST['mdp2']) && !empty($_POST['mdp2']))){
        
        //on regarde si les 2 mdp sont les mêmes
        if($_POST['mdp'] != $_POST['mdp2']){
            $erreur = 'Les 2 mots de passe sont différents.';
        }
        else{
            //on regarde si ce nom n'est pas déjà utilisé
            $nom = $_POST['nom'];
            $req = "SELECT count(*) FROM utilisateur WHERE nom=$nom;";
            $rep = $connection->prepare($req);
            $rep->execute();
            
            if($rep == 0){
                $mdp = $_POST['mdp'];
                $efav = $_POST['efav'];
                $desc = $_POST['desc'];
                $req2 = "INSERT INTO utilisateur VALUES('$nom', '$mdp', '$efav', '0', '$desc', '0'";
                $rep2 = $connection->prepare($req2);
                $rep2->execute();
                
                session_start();
                $_SESSION['nom'] = $_POST['nom'];
                header('Location: membre.php');
                exit();
            }
            
            else{
                $erreur = 'Ce nom est déjà pris. Veuillez en choisir un autre.';
            }
        }
    }
    else{
        $erreur = 'Au moins un des champs est vide.';
    }
}
?>


<html>
<head>
<title>Inscription</title>
</head>

<body>
Inscription à l'espace membre: <br />
<form action="inscription.php" method="post">
Nom: <input type="text" name="nom" value="<?php if (isset($_POST['nom'])) echo htmlentities(trim($_POST['nom'])); ?>"><br />
Mot de passe: <input type="password" name="mdp" value="<?php if (isset($_POST['mdp'])) echo htmlentities(trim($_POST['mdp'])); ?>"><br />
Confirmation du mot de passe : <input type="password" name="mdp2" value="<?php if (isset($_POST['mdp2'])) echo htmlentities(trim($_POST['mdp2'])); ?>"><br />
Equipe favorite: <select name="efav">
    <?php
    $req3 = "SELECT nom FROM equipe;";
	$reponse = $connection->prepare($req3);
	$rep3->execute();
	foreach($rep3 as $nomequipe){
	    $nomeq = $nomequipe['nom'];
	    echo "<option value=$nomeq>$nomeq</option>";
	}
	?>
</select>
Description(200 mots max): <input type="text" name="desc" value="<?php if (isset($_POST['desc'])) echo htmlentities(trim($_POST['desc'])); ?>"><br />
<input type="submit" name="inscription" value="Inscription">
</form>

<?php
if (isset($erreur)){
    echo '<br />',$erreur;
}
?>
</body>
</html>