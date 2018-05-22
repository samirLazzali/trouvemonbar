<?php

/**
 * Created by PhpStorm.
 * User: agammon
 * Date: 4/24/18
 * Time: 2:40 PM
 */


function db_connect(){
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    return $connection;
}


function genMenu(){
    $bdd=db_connect();
    $count=$bdd->query('SELECT count(*) FROM recette');
    $max=$count->fetch()['count'];
    $_SESSION['menu']=array();
    for($i=0;$i<14;$i++){
        $rd=rand(1,$max);
        while (in_array($rd,$_SESSION['menu'])){
            $rd=rand(1,$max);
        }
        $_SESSION['menu'][$i]=$rd;
    }
    $count->closeCursor();
}

function recette($id){
    $bdd=db_connect();
    $rep=$bdd->prepare('SELECT * FROM recette WHERE id = ?');
    $rep->execute(array($id));
    return $rep->fetch();
}

function changerecette($index){
    $bdd=db_connect();
    $count=$bdd->query('SELECT count(*) FROM recette');
    $max=$count->fetch()['count'];
        $rd=rand(1,$max);
        while (in_array($rd,$_SESSION['menu'])){
            $rd=rand(1,$max);
        }
        $_SESSION['menu'][$index]=$rd;

    $count->closeCursor();
}
?>