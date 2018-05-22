<?php
require_once "db.php";
require_once "fonctions.php";
if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}
require_once "db.php";
page_top("Filigrane | Carte");
?>

<div class="row">
    <div class="column side" id="left_col" style="background-color:#000000;"><img src="Pictures/Sidebar_1.png"></div>

    <div class="column middle" style="background-color:#bbb;">
        <a href="RechercheMagic.php">Lancer une nouvelle recherche</a>
        <?php
        $id = $_GET['id'];
        $result = $pdo->query("SELECT name, set_code, ruling FROM cartes WHERE id = ".$id.";");
        $row = $result->fetch();

        $ruling = $row['ruling'];
        if ($ruling == NULL)
        {
            $alt_result = $pdo->query("SELECT ruling FROM cartes WHERE name = '".$row['name']."';");
            while ($alt_row = $alt_result->fetch())
            {
                if ($alt_row['ruling'] != NULL)
                {
                    $ruling = $alt_row['ruling'];
                    break;
                }
            }
        }
        $beforeprevious = "";
        $previous = "";
        $imgpath = "pics/" . $row['set_code'] . "/";
        foreach (str_split($row['name']) as $current) {
            if ($previous != "/" && $current != "/" && $current != " ") {
                if ($beforeprevious != "/" && $previous == " ") $imgpath .= "%20";
                $imgpath .= $current;
            }
            $beforeprevious = $previous;
            $previous = $current;
        }
        $imgpath .= ".full.jpg";
        echo '<h2>' . $row['name'] . '</h2>';
        echo '<div class="card_pic"><img src="' . $imgpath . '" alt="Désolé, l\'image de ' . $row['name']
            . ' (' . $row['set_code'] . ') n\'a pas pu être affichée :("/></div>';
        echo '<div class="card_info"><p>';
        foreach (explode("£", $ruling) as $line)
        {
            if ($line != '') echo $line."<br/><br/>";
        }
        echo '</p></br>';

        if (isset($_SESSION['auth'])){

            echo '<h2>Ajouter à ma collection</h2>
            <div class="search">
                <form action="update_collection.php?id=' . $_GET['id'] . '" method="post">
                    Collection:<input type="text" name="collection_name"><br/>
                    Nombre: <input type="text" name="quantity"><br/>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>';

        }
        else{
            echo '<h2>Connectez-vous pour ajouter cette carte à vos collections</h2>';
        }
        echo '</div>';
        ?>
    </div>

    <div class="column side" id="right_col" style="background-color:#000000;"><img src="Pictures/Sidebar_2.png"></div>
</div>

<div class="footer">
    <p>"Les decks contrôle ne sont qu'une illusion" - Karn, 2018</p>
</div>

</body>
</html>