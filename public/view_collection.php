<?php
if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}
require_once "fonctions.php";

require '../vendor/autoload.php';

require_once "db.php";

$query = "SELECT name, set_code, id, quantity FROM cartes NATURAL JOIN " . $_GET['author'] . "§" . $_GET['name'] . ";";

page_top("Filigrane | Collection");
?>

	<div class="row">
		<div class="column side" id="left_col" style="background-color:#000000;"><img src="Pictures/Sidebar_1.png"></div>
	
		<div class="column middle" style="background-color:#bbb;">
			<a href="RechercheMagic.php">Lancer une nouvelle recherche</a>
            <?php
            $result = $pdo->query($query);
            $k = 0;
            echo("<div class='card_row'>");
            while ($row = $result->fetch()) {
                if ($k % 3 == 0) {
                    echo("</div><div class='card_row'>");
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
                echo("<div class='card'>");
                echo '<a href="carte.php?id='."'" . $row['id'] ."'".'" target="_blank"><img src="' . $imgpath . '" alt="Désolé, l\'image de ' . $row['name']
                    . ' (' . $row['set_code'] . ') n\'a pas pu être affichée :(" onmouseover="document.getElementById(' . $k . ').style.display = \'block\';"
                    onmouseout="document.getElementById(' . $k . ').style.display = \'none\';"/></a>';
                    echo '<div class="info_card" id="' . $k . '" 
                     onmouseover="document.getElementById(' . $k . ').style.display = \'block\';"
                     onmouseout="document.getElementById(' . $k . ').style.display = \'none\';">Nombre : '.$row['quantity'].'</div>';
                echo("</div>");
                $k++;
            }
            echo ("</div>");
			?>
		</div>
			
		<div class="column side" id="right_col" style="background-color:#000000;"><img src="Pictures/Sidebar_2.png"></div>
	</div>

	<div class="footer">
		<p>"Les decks contrôle ne sont qu'une illusion" - Karn, 2018</p>
	</div>
	
    </body>
</html>
