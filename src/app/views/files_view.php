<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:30
 */
        $flag=false;
        echo "<h2>Vos fichiers:</h2> </br>";
        foreach ($filelist as $file) {
            if ($file->userid == $userid) {
                \User\File::download($file->filename, $file->fileid);
                echo "</br>";
                $flag=true;
            }

        }

        if(!$flag)
            echo "<h3>IL N'Y A PAS DE FICHIER!</h3>";

        if($userid==$myid) {
            echo "<h4>Choisir votre fichier:</h4></br>";
            \User\File::upload_file();
        }

?>