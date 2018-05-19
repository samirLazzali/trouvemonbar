<?php
require "../src/app/helpers.php";

if(!Auth::logged())
    redirect("index.php");

$wherelist=array();

if(!empty(htmlspecialchars($_GET['lastname'])))
{
    $wherelist[]=" lastname like '%".strtoupper(htmlspecialchars($_GET['lastname']))."%'";


}
if(!empty(htmlspecialchars($_GET['nick'])))
{
    $wherelist[]=" nick like '%".strtoupper(htmlspecialchars($_GET['nick']))."%'";

}if(!empty(htmlspecialchars($_GET['gamename'])))
{
    $wherelist[]=" gamename like '%".strtoupper(htmlspecialchars($_GET['gamename']))."%'";

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


