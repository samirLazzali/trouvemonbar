<?php
/**
 * Created by PhpStorm.
 * User: chenzeyu
 * Date: 2018/5/5
 * Time: 15:49
 */
/* Suppression des warnings inutiles de pgsql qui sont gérés quand même*/
error_reporting(E_ERROR | E_PARSE);
/*postgres*/
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
/*Mettre à 1 pour activer l'authentification*/
$AUTHENT = 1;