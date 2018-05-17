<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 18:17
 */

namespace User;


class File
{


    public function __construct()
    {

    }

    /**
     * @param $filename
     * @param $filehash
     * @param bool $private false
     * @param null $extension
     * @return int db()->lastInsertId() id of the file which was just upload if successful
     */
    public static function insert_file($filename,$filehash,$extension=null,$private=false){

        $query = db()->prepare("INSERT INTO file (filename, filehash, extension) VALUES  (?, ?, ?)");
        $success = $query->execute([$filename,$filehash,$extension]);

        if($success)
            return db()->lastInsertId("file_fileid_seq");
        else
            return false;
    }


    /**
     * @return array list of all files in the database
     */
    public static function filelist()
    {

        $query = db()->prepare("SELECT fileid, filename FROM file");
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * @param $filepath
     * @return file hashcode
     */
    public static function filehash($filepath)
    {
        return hash_file("md5",$filepath);
    }
}