<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 10/05/2018
 * Time: 10:01
 *
 */
require "../src/app/helpers.php";
include "../src/app/models/File.php";


header("content-type:text/html;charset:utf-8");
$fileInfo = $_FILES["myfile"];

$filename = $fileInfo["name"];
$type = $fileInfo["type"];
$error = $fileInfo["error"];
$size = $fileInfo["size"];
$tmp_name = $fileInfo["tmp_name"];
$maxSize=2*1024*1024;// the maximum
$allowExt=array("txt","pdf","png","jpg");

//for Judging error number
if($error == 0){
    //
    if($size>$maxSize){
        exit("the file is too big");
    }


    //get file name extension
    $ext = pathinfo($filename,PATHINFO_EXTENSION);
    if(!in_array($ext,$allowExt)){
        exit("the file is not correct");
    }
    
    //create the path
    $path = "../documents/";
    if(!file_exists($path)){
        mkdir($path,0777,true);
        chmod($path,0777);
    }
    
    $destination = $path.$filename;

    if(@move_uploaded_file($tmp_name,$destination)){

        $filehash=User\File::filehash($destination);

        if($id=User\File::insert_file($filename,$filehash))
        {
            $newname=$path.$id.$filename;
            rename($destination,$newname);
            echo "upload successed";}
        else
            echo "upload failed";
    }else{

        echo "upload failed";
    }
}else{
    switch($error){
        case 1:
        case 2:
        case 3:
        case 4:
        case 6:
        case 7:
        case 8:
            echo "error";
            break;
    }

}
?>