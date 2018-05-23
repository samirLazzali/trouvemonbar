<?php
include("vue.php");
page_accueil();
enTete("Résultat de ta recherche");

if (isset($_GET['q']) AND !empty($_GET['q'])) {
    $q = htmlspecialchars($_GET['q']);
    $annonce = $db->prepare("SELECT * FROM Objet WHERE titre LIKE '%$q%' ORDER BY id DESC");
    $annonce->execute();
    if ($annonce->rowCount() == 0) {
        $annonce = $db->prepare("SELECT * FROM Objet WHERE CONCAT(titre,description) LIKE '%$q%' ORDER BY id DESC");
    }
    if ($annonce->rowCount() > 0) {
        while ($a = $annonce->fetch()) {
            $id = $a["id"];
            $titre = $a["titre"];
            $date = $a["date"];
            $description = $a["description"];

            $query2 = $db->prepare('SELECT COUNT(*) FROM Trouve WHERE id = :id');

            $query2->execute(array('id' => $id));

            $data2 = $query2->fetchColumn();

            if ($data2 == 1) {
                $type = 'trouve';
                $url = 'annonce.php?id=' . $id . '&type=' . $type;
                echo '<p class="annonce"> <a href=' . $url . '> Annonce numéro ' . $id . ' : '
                    . $titre;
                echo nl2br("\r\n");
                echo $description;
                echo nl2br("\r\n");
                echo 'C\'est un objet trouvé ';
                echo 'postée le ' . $date . '</a> </p>';

            } else {

                $query3 = $db->prepare('SELECT COUNT(*) FROM Vendre WHERE id = :id');

                $query3->execute(array('id' => $id));

                $data3 = $query3->fetchColumn();

                if ($data3 == 1) {

                    $type = 'vendre';
                    $url = 'annonce.php?id=' . $id . '&type=' . $type;
                    echo '<p class="annonce"> <a href=' . $url . '> Annonce numéro ' . $id . ' : '
                        . $titre;
                    echo nl2br("\r\n");
                    echo $description;
                    echo nl2br("\r\n");
                    echo 'C\'est un objet à vendre ';
                    echo 'postée le ' . $date . '</a> </p>';
                }
                $query3->closeCursor();
            }
            $query2->closeCursor();

        }
    }
    else
    {
        echo "Désolé, aucune annonce ne correspond à ta recherche mais n'hésite pas à deposer une annonce en cliquant ici :";
        echo "<a href='Post_annonce.php'> Déposer une annonce</a>";
    }
}