<?php
/**
 * Created by PhpStorm.
 * User: mickael
 * Date: 21/05/18
 * Time: 16:14
 */
include ("Vue.php");
include("db.php");
include "entete.php";
bandeau();
enTete("Presentation des sorties");
aff_sorties();
?>