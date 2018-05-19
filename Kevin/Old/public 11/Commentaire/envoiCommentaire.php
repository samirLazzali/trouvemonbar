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

$id_Parent = $_POST['id_parent'];
$type = $_POST['type_parent'];
$TargetOwner = $_POST['TargetOwner'];
$contenu = $_POST['contenu'];

ecrireCommentaire($id_Parent, $type, $contenu, $TargetOwner);

header("Location: ".$_SERVER['HTTP_REFERER']."");

