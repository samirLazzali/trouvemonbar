<?php
require "../src/app/helpers.php";


$wherelist=array();

if(!empty($_GET['lastname']))
{
    $wherelist[]=" lastname like '%".$_GET['lastname']."%'";


}
if(!empty($_GET['nick']))
{
    $wherelist[]=" nick like '%".$_GET['nick']."%'";

}if(!empty($_GET['gamename']))
{
    $wherelist[]=" gamename like '%".$_GET['gamename']."%'";

}
$where="";
if(count($wherelist)>0)
{
    $where=" where ".implode(' and ',$wherelist);

}


$sql="select * from users left join game on userid=creator $where ";
$result=User::searchlist($sql);

$layout = new Layout("users");
include view("search_view.php");
$layout->show("Resultat ");
?>


