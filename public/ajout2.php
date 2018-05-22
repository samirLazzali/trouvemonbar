<?php
//répertoire de déstination





var_dump($_POST);
var_dump($_FILES);
$target_dir = "../Image";
$target_file = $target_dir . basename($_FILES["fileselect"]["name"]);
//on initialise la variable update ok
$uploadOk = 1;
//on recup l'extention du fichier
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

//on a cliqué sur le bouton qui s'appel submit
if(isset($_POST["submit"])) {
    //fichier image?
    echo "1";
    $check = getimagesize($_FILES["fileselect"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $message = "Le fichier n'est pas une image valide.";
        echo $message;
        $uploadOk = 0;
    }
}
// le fichier existe déjà?
if (file_exists($target_file)) {
    $message = "Erreur! le fichier image existe déjà.";
    echo $message;
    $uploadOk = 0;
}
// le poid de l'image
if ($_FILES["fileselect"]["size"] > 30000) {
    $message = "Le fichier selectionné eilesetst trop volumineux.";
    echo $message;
    $uploadOk = 0;
}
// les formats autorisés
if($imageFileType != "jpg" &&$imageFileType != "JPG"&& $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "gif" && $imageFileType != "GIF") {

    $message = "Les images doivent etre au format: JPG, JPEG, PNG ou GIF.";
    echo $message;
    $uploadOk = 0;
}
// erreur
if ($uploadOk == 0) {
    $message = "Erreur! impossible d'ajouter l'image.";
    echo $message;

    // tt c'est bien passé
} else {
    if (move_uploaded_file($_FILES["fileselect"]["tmp_name"], $target_file)) {


        $message = "Image ajoutée avec succès.";

        echo $message;

    } else {
        $message = "Erreur inconnue! Merci de retenter l'ajout plus tard ou de contacter l'administrateur.";
        echo $message;
    }
}


?>
