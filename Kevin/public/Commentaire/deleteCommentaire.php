<?php
/**
 * Created by PhpStorm.
 * User: KevinXu
 * Date: 16/05/2018
 * Time: 17:35
 */
session_start();
require_once '../../vendor/autoload.php';
require_once "../Modele.php";

$id_commentaire = $_POST['id_commentaire'];

deleteCommentaire($id_commentaire);

header("Location: ".$_SERVER['HTTP_REFERER']."");

