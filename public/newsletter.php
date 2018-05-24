<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 21/05/2018
 * Time: 16:35
 */
include "Vue.php";
include "entete.php";
include "db.php";
bandeau();
enTete("Newsletters");
$db=db_connect();
$rep=db_query($db,"SELECT * FROM \"projet_bda\".\"Newsletter\" ORDER BY date;");
db_fetch($rep);
$count=db_count($rep);
$i=0;
print "<p>";
while ($i<$count)
{
    $i = $i + 1;
    $ligne=$rep->fetch();
    $date=$ligne->date;
    $doc=$ligne->doc;
    echo "Newsletter du:".$date."<br/>".$doc."<br/><br/>";
}
print "</p>";
print "<a href=\"index.php\">Menu</a><br/>\n";