<?php
include("includes/header.php");
?>
<head>
    <title>Acceuil</title>
    <?php
        if($id!=0){
            $query = $db->prepare('SELECT MAX(id) as nb FROM posts');
            $query->execute();
            $max=$query->fetchColumn();
            $query = $db->prepare('SELECT MIN(id) as nb FROM posts');
            $query->execute();
            $min=$query->fetchColumn();
            for($i=$max;$i>=$min;$i--){
                aff_posts($i);
            }



        }



    ?>
</head>