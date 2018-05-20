


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
                echo "<div>";
                File::download($file->filename, $file->fileid);

                //the admin can remove file
                if($isAdmin) echo "<a href='actions/remove_file.php?file=$file->fileid' class='btn btn-danger btn-sm'> X </a>";
                echo "</div>";
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
