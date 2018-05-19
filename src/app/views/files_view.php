<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:30
 */
        $flag=false;
        echo "<h3>Les fichiers:</h3> </br>
               <div class=\"container-fluid filelist\">";

        foreach ($filelist as $file) {
            if ($file->userid == $userid) {
                \User\File::download($file->filename, $file->fileid);
                echo "</br>";
                $flag=true;
            }

        }
        echo "</div>";
        if(!$flag)
            echo "<p>Pas de fichiers pour le moment</p>";

        if($userid==$myid) {
            echo "<h5>Choisir votre fichier:</h5></br>";
            \User\File::upload_file();
        }

?>