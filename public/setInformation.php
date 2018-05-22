<?php

$change_error_message_address = '';
$changed_address= false;

if(isset($_POST['newAddress'])){
    $newAddress = trim($_POST['newAddress']);
    if($newAddress == ''){
        $change_error_message_address = "Adresse invalide";
    }
    else{
        $user_id = $user->user_id;
        $app->changeField("address", $newAddress, $user_id);
        header("refresh:2;");
        $changed_address = true;
    }
}


$change_error_message_city = '';
$changed_city= false;

if(isset($_POST['newCity'])){
    $newCity = trim($_POST['newCity']);
    if($newAddress == ''){
        $change_error_message_city = "Adresse invalide";
    }
    else{
        $user_id = $user->user_id;
        $app->changeField("city", $newCity, $user_id);
        header("refresh:2;");
        $changed_city = true;
    }
}


$change_error_message_country = '';
$changed_country= false;

if(isset($_POST['newCountry'])){
    $newCountry = trim($_POST['newCountry']);
    if($newCountry == ''){
        $change_error_message_country = "Pays invalide";
    }
    else{
        $user_id = $user->user_id;
        $app->changeField("country", $newCountry, $user_id);
        header("refresh:2;");
        $changed_country= true;
    }
}

$change_error_message_zip = '';
$changed_zip= false;

if(isset($_POST['newZip'])){
    $newZip = trim($_POST['newZip']);
    if($newZip == ''){
        $change_error_message_zip = "Adresse invalide";
    }
    else{
        $user_id = $user->user_id;
        $app->changeField("zip", $newZip, $user_id);
        header("refresh:2;");
        $changed_zip = true;
    }
}

$change_error_message_bio = '';
$changed_bio= false;

if(isset($_POST['newBio'])){
    $newBio = trim($_POST['newBio']);
    if($newBio == ''){
        $change_error_message_bio = "Adresse invalide";
    }
    else{
        $user_id = $user->user_id;
        $app->changeField("bio", $newBio, $user_id);
        header("refresh:2;");
        $changed_bio = true;
    }
}

?>
