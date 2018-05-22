<?php
			if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
				require_once 'db.php';
				require_once 'fonctions.php';
				$req=$pdo->query("SELECT * FROM users WHERE (username = '".$_POST['username'].
                                 "' OR email = '".$_POST['username']."');");
				$user=$req->fetch();
				if(password_verify($_POST['password'], $user['password']) and $user['ban'] == 0){
					session_start();
				    $_SESSION['auth']= $user;
				    $_SESSION['flash']['success']='Vous êtes maintenant bien connecté';
				    header('Location: index.php');
				    exit();
				}else{
					$_SESSION['flash']['danger']='Identifiant / mot de passe incorrect, ou compte banni';
					header('Location: index.php');
					exit();
				}
			}