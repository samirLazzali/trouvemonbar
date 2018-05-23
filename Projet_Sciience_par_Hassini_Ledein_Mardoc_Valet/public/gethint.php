<?php


$conn = mysql_connect("host=localhost dbname=livre user=dbpersouser password=dbpersopwd");

$result = mysql_query($conn,"select * from livre where auteur LIKE '".$_GET['q']."%' OR titre LIKE '".$_GET['q']."%' order by titre");

$outp = "";
while($rs = mysql_fetch_object($result)) {
    $outp .= $rs->auteur.", "."; ";
}
mysql_close($conn);

echo($outp);
?>

