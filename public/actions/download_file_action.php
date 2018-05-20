<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/5/15
 * Time: 16:10
 */

$file_name=$_GET['filename'];
$path = "../../documents/";
$file_name=iconv("utf-8","gb2312",$file_name);
$file_name=$path.$file_name;


if(!file_exists($file_name)){
    echo " The file does not exist!";
    return;
}
$fp=fopen($file_name,"r");
$file_size=filesize($file_name);
header("Content-type: application/octet-stream");
header("Accept-Ranges: bytes");

header("Content-Disposition: attachment; filename=".$file_name);
header("Accept-Length: $file_size");
$buffer=1024;
while(!feof($fp)){
    $file_data=fread($fp,$buffer);
    echo $file_data; }
fclose($fp);

?>