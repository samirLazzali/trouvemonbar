<?php
session_start();
$titre="Profil";
include("includes/id.php");
include("includes/debut.php");
//On récupère la valeur de nos variables passées par URL
$action = isset($_GET['action'])?htmlspecialchars($_GET['action']):'consulter';
$membre = isset($_GET['m'])?(int) $_GET['m']:'';
?>


<?php
    switch($action){
        case "consulter":
            $query=$db->prepare('SELECT pseudo, avatar,
       mail FROM membres WHERE id=:membre');
            $query->bindValue(':membre',$membre, PDO::PARAM_INT);
            $query->execute();
            $data=$query->fetch();

            echo'<h1>Profil de '.stripslashes(htmlspecialchars($data['pseudo'])).'</h1>';

            echo'<img src="./images/avatars/'.$data['avatar'].'"alt="Ce membre n a pas d avatar" />';

            echo'<p><strong>Adresse E-Mail : </strong> <a href="mailto:'.stripslashes($data['mail']).'">'.stripslashes(htmlspecialchars($data['mail'])).'</a><br />';
            $query->CloseCursor();
            break;
    }