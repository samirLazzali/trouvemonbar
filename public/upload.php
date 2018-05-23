<?php

include("vue.php");
page_accueil();

global $dbUser, $dbName, $dbPassword;
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$db = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

enTete("Déposer une annonce");

//On vérifie que les données ont bien été récupérées
if (isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['email'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date = date("Y-m-d");
    $mail = $_POST['email'];
    $req = $db->prepare("SELECT id FROM Objet ORDER BY id DESC LIMIT 1");
    $req->execute();
    $res = $req->fetch();
    $req->closeCursor();
    $id = $res["id"]+1;
    //On vérifie qu'il y a une image
    if (!empty($_FILES['fileToUpload']['name'])) {
        if ($_FILES['fileToUpload']['error'] > 0) $erreur = "Erreur lors du transfert";

        //Vérifie la taille du fichier

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Désolé, votre fichier dépasse la taille limite.";
            $uploadOk = 0;
        }

        //Vérifie le type d'image

        $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
        //1. strrchr renvoie l'extension avec le point (« . »).
        //2. substr(chaine,1) ignore le premier caractère de chaine.
        //3. strtolower met l'extension en minuscules.
        $extension_upload = strtolower(substr(strrchr($_FILES['fileToUpload']['name'], '.'), 1));
        if (!in_array($extension_upload, $extensions_valides)) echo "Le format de votre fichier n'est pas pris en charge.";

        //Déplace le fichier dans le dossier upload
        chmod("uploads", 733);
        $resultat = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "uploads/" . basename($_FILES["fileToUpload"]["name"]));

        if (!$resultat) echo "Il y a eu une erreur de transfert, nous nous excusons de la gêne occasionnée.";

        //On insère dans la base de données
        $image = "uploads/" . basename($_FILES["fileToUpload"]["name"]);
        $req1 = $db->prepare("INSERT INTO Objet(id, titre, description, date, image, mail) VALUES(:v0,:v1,:v2,:v3,:v4, :v5)");
        if ($req1->execute(array('v0'=> $id, 'v1' => $titre, 'v2' => $description, 'v3' => $date, 'v4' => $image, 'v5' => $mail))) {
            echo "Votre annonce a bien été enregistrée.";
        } else {
            echo "Une erreur a eu lieu lors de l'enregistrement de votre annonce.</br> Vérifiez que vous possédez bien un compte sur notre site pour pouvoir déposer une annonce.</br>";
            echo "<a href='inscription.php'>Cliquez ici pour vous inscrire</a>";
        }
    } else {
        $req2 = $db->prepare("INSERT INTO Objet(id, titre, description, date, image, mail) VALUES(:v0, :v1,:v2,:v3,NULL,:v4)");
        if ($req2->execute(array('v0'=> $id,'v1' => $titre, 'v2' => $description, 'v3' => $date, 'v4' => $mail))) {
            echo "Votre annonce a bien été enregistrée.";
        } else {
            echo "Une erreur a eu lieu lors de l'enregistrement de votre annonce.</br> Vérifiez que vous possédez bien un compte sur notre site pour pouvoir déposer une annonce.</br>";
            echo "<a href='inscription.php'>Cliquez ici pour vous inscrire</a>";
        }
    }
}

//On regarde maintenant si c'est un objet trouvé ou à vendre
if (isset($_POST['CatégorieT'])&&isset($_POST['endroit']) && !empty($_POST['endroit']))
{
    $catT = $_POST['CatégorieT'];
    $endroit = $_POST['endroit'];
    $req3 = $db->prepare("INSERT INTO Trouve(id, categorie_T, endroit) VALUES (:v0 , :v1, :v2)");
    $req3->execute(array('v0'=>$id,'v1'=> $catT, 'v2'=> $endroit));
}

if (isset($_POST['CatégorieV']) && isset($_POST['prix']) && !empty($_POST['prix']))
{
    $catV = $_POST['CatégorieV'];
    $prix = $_POST['prix'];
    $req4 = $db->prepare("INSERT INTO Vendre(id, categorie_V, prix) VALUES (:v0, :v1, :v2 )");
    $req4->execute(array('v0'=>$id, 'v1'=> $catV, 'v2'=> $prix));
}