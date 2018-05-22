<?php
require_once 'fonctions.php';
session_start();
if(!empty($_POST)){
    $errors=array();
    require_once 'db.php';
    if(empty($_POST['username'])|| !preg_match('/^[a-z0-9_]+$/',$_POST['username'])){
        $errors['username']="pseudo non valide";
    }
    else{
        $req=$pdo->prepare("SELECT id FROM users WHERE username = '".$_POST['username']."';");
        $req->execute();
        $user=$req->fetch();
        if($user){
            $errors['username']='Ce pseudo est déjà pris';
        }
    }

    if(empty($_POST['email'])|| !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "email non valide";

    }
    else{
        $req=$pdo->prepare("SELECT id FROM users WHERE email = '".$_POST['email']."';");
        $req->execute();
        $user=$req->fetch();
        if($user){
            $errors['email']='Ce mail est déjà pris';
        }
    }
    if(empty($_POST['password'])|| $_POST['password']!=$_POST['password_confirm']){
        $errors['password']="vous devez rentrer un mot de passe valide";
    }

    if(empty($errors)) {

        $token=str_random(60);
        $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
        $user_id = md5($_POST['username'].$_POST['email'].$_POST['password']);
        $req = $pdo->prepare("INSERT INTO users(id, username, password, email, confirmation_token) VALUES ('".
            $user_id."', '".$_POST['username']."', '".$password."', '".$_POST['email']."', '".$token."');");
        $req->execute();
        mail($_POST['email'],'Confirmation de votre compte',"Afin de valider merci de cliquer sur ce lien\n\nhttp://local.dev/PhpstormProjects/confirm.phpid=$user_id&token=$token");
        $_SESSION['flash']['success'] = 'un email de confirmation a été envoyé';
        header('location: login.php');
        exit();
    }
    debug($errors);
}

?>


<?php require 'header.php'; ?>

<h1>Inscription</h1>


<?php if(!empty($errors)): ?>
<div class="alert alert-danger">
    <p>Vous n'avez pas rempli le formulaire correctement</p>
    <ul>
        <?php foreach($errors as $error): ?>
        <li><?=$error; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form action="" method="POST">
    <div class="form-group">
        <label for="">Pseudo</label>
        <input type="text" name="username" class="form-control" required/>

    </div>

    <div class="form-group">
        <label for="">Mail</label>
        <input type="text" name="email" class="form-control" required/>

    </div>

    <div class="form-group">
        <label for="">Mot de Passe</label>
        <input type="password" name="password" class="form-control" required/>

    </div>

    <div class="form-group">
        <label for="">Confirmer votre mot de passe</label>
        <input type="password" name="password_confirm" class="form-control" required/>

    </div>

    <button type="submit" class="btn btn-primary">M'inscrire</button>
</form>

<?php require 'footer.php'; ?>

