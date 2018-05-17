<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:30
 */
 
 /**
 * function for uploading the files
 */
function upload_file()
{
    echo '<form action="upload_file.php" method="post" enctype="multipart/form-data" target="myIframe">
              <label for="file">Filename:</label>
              <input type="file" name="myfile" id="myfile" />
              <br />
              <input type="submit" name="submit" value="Submit" />
              </form>
              <iframe id="myIframe" name="myIframe" frameborder="0" style=""></iframe> <br/>';
}

/**
 * @param $file_name file name
 * @param $arr lien(download) name
 */
function download($file_name,$arr){
    echo "<a href=\"download_file.php?filename=$file_name\" >$arr</a>";
