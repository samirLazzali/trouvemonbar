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
					$req = $pdo->prepare("INSERT INTO users VALUES ('".
						$user_id."', '".$_POST['username']."', '".$_POST['email']."', '".$password."', '".$token."', null, 0, 0);");
					$req->execute();
					mail($_POST['email'],'Confirmation de votre compte',"Afin de valider merci de cliquer sur ce lien\n\nhttp://local.dev/PhpstormProjects/confirm.phpid=$user_id&token=$token");
					$_SESSION['flash']['success'] = 'un email de confirmation a été envoyé';
					header('location: login.php');
					exit();
				}
					
				}
				header('Location: index.php');
				exit();