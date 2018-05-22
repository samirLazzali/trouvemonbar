
<?php
if(!empty($_POST)&& !empty($POST['username']) && !empty($POST['password'])){
    require_once 'db.php';
    require_once 'fonctions.php';
    $req=$pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
    $req->execute(['username' => $_POST['username']]);
    $user=$req->fetch();
    if(password_verify($_POST['password'],$user->password)){
        session_start();
     $_SESSION['auth']= $user;
     $_SESSION['flash']['success']='vous êtes maintenant bien connecté';
     header('Location: account.php');
     exit();
    }else{
        $_SESSION['flash']['danger']='Identifiant ou mot de passe incorrect';
    }

    debug($user->password);

}


