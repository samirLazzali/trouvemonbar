<?php
require "../src/app/helpers.php";

if(!Auth::logged())
    redirect("index.php");

$wherelist=array();


if(!empty($_GET['lastname']))
{

    $wherelist[]=" lastname like '%".htmlspecialchars($_GET['lastname'])."%'";


}
if(!empty($_GET['nick']))
{
    $nick = $_GET['nick'];
    $wherelist[]=" nick like '%".htmlspecialchars($nick)."%'";

}if(!empty(htmlspecialchars($_GET['gamename'])))
{
    $gamename=$_GET['gamename'];
    $wherelist[]=" gamename like '%".htmlspecialchars($_GET['gamename'])."%'";
}

if(!empty($_GET['gamesystem']))
{
    $gamesystem=$_GET['gamesystem'];
    $wherelist[]=" systemname like '%".htmlspecialchars($_GET['gamesystem'])."%'";
}

$where="";
if(count($wherelist)>0)
{
    $where=" where ".implode(' and ',$wherelist);

}


$sql="select distinct nick, userid, firstname, lastname  
        from gamesystem natural join mastery natural right join  users left join game on userid=creator 
         $where";
$result=User::searchlist($sql);

$layout = new Layout("users");
include view("search_view.php");
$layout->show("Resultat ");



