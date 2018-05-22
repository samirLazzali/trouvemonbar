<?php

if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}

require('fonctions.php');
logged_only();

require("db.php");

$id_user = $_SESSION['auth']['id'];

$result = $pdo->query("SELECT *
									   FROM " . $_SESSION['auth']['username']."§".$_POST['collection_name'] . "
									   WHERE id = " . $_GET['id'] . ";");
if ($result) {
    $row = $result->fetch();
    if ($row == false) {
        $res = $pdo->query("INSERT INTO " . $_SESSION['auth']['username'] . "§" . $_POST['collection_name'] . "
								  VALUES (" . $_GET['id'] . ", " . $_POST['quantity'] . ", '" .
            $id_user . "', '" . $id_user . "');");
        if ($res == false) echo "Erreur lors de la modifcation de la collection : 1";

        else {
            header('Location: RechercheMagic.php');
            exit();
        }
    } else {
        if ($_POST['quantity'] == "0") {
            if ($result = $pdo->query("DELETE FROM " . $_SESSION['auth']['username'] . "§" . $_POST['collection_name'] . "
												   WHERE id = " . $_GET['id'] . ";") == false)
                echo "Erreur lors de la modification de la collection : 2";
            else {
                header('Location: RechercheMagic.php');
                exit();
            }
        } else {
            if ($result = $pdo->query("UPDATE " . $_SESSION['auth']['username'] . "§" . $_POST['collection_name'] . "
												   SET quantity = " . $_POST['quantity'] . "
												   WHERE id = " . $_GET['id'] . ";") == false)
                echo "Erreur lors de la modification de la collection : 3";
            else {
                header('Location: RechercheMagic.php');
                exit();
            }
        }
    }
}
else header('Location: RechercheMagic.php');
