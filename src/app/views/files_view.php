


<div class="container-fluid ml-2">
    <h3 class='font-weight-bold mt-2'>Fichiers de l'utilisateur</h3>
<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:30
 */


        $flag=false;
        foreach ($filelist as $file) {
            if ($file->userid == $userid) {
                File::download($file->filename, $file->fileid);
                echo "</br>";
                $flag = true;
            }

        }
        if(!$flag)
            echo "<p>Pas de fichiers pour le moment</p>";

        if($userid==$myid) {
            echo "<h3 class='font-weight-bold mb-2'> Ajouter un fichier</h3>";
            File::upload_file();
        }

?>
</div>
