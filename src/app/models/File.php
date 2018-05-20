<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 18:17
 */

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
    public static function insert_file($filename,$filehash,$userid,$extension=null,$private=false){

        $query = db()->prepare("INSERT INTO file (filename, filehash, userid,extension) VALUES  (?, ?, ?, ?)");
        $success = $query->execute([$filename,$filehash,$userid,$extension]);

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

        $query = db()->prepare("SELECT * FROM file");
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * @param $filepath
     * @return string hashcode
     */
    public static function filehash($filepath)
    {
        return hash_file("md5",$filepath);
    }


    /**
     * function for uploading the files
     */
    public static function upload_file()
    {
        echo '<form class="" action="actions/upload_file_action.php" method="post" enctype="multipart/form-data" target="myIframe">
              <label for="file" > Nom du fichier:</label>
              <input type="file" name="myfile" id="myfile" />
              <br />
              <input class="btn btn-primary" type="submit" name="submit" value="Valider"/>
              </form>
              <iframe id="myIframe" name="myIframe" frameborder="0" style=""></iframe> <br/>';
    }

    /**
     * @param $filename string
     * @param $fileid
     */
    public static function download($filename,$fileid)
    {
        echo "<a href='actions/download_file_action.php?filename=$fileid$filename'>$filename</a>";
    }





}