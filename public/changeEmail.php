<?php

$change_error_message_email = '';
$changed_email = false;

if(isset($_POST['newEmail'])){
    $newEmail = trim($_POST['newEmail']);
    if($newEmail == ''){
        $change_error_message_email = "e-mail invalide";
    }
    else if ($app->isEmail($newEmail)){
        $change_error_message_email = "e-mail déjà utilisée";
    }
    else{
        $user_id = $user->user_id;
        $app->changeField("email", $newEmail, $user_id);
        header("refresh:2;");
        $changed_email = true;
    }
}

?>