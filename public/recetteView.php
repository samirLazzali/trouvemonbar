<?php
/**
 * Created by PhpStorm.
 * User: agammon
 * Date: 5/20/18
 * Time: 3:14 PM
 */

function printpresentation($recette)
{
    echo "<div class=\"presentation clearfix\">

          <h3 class=\"nom\">" . $recette['nom'] . "</h3>
          <p class=\"difficulte\">Difficulté " . $recette['difficulte'] . "</p>
          <p class=\"cout\">cout :" . $recette['cout'] . "</p>
        </div>";
}

function printingredients($ingr,$qt){
    echo "<div class=\"necessaire clearfix\">

          <div class=\"ingredients\"></div>

          <div class=\"nom_ingredients clearfix\">
            <p class=\"course\">Liste de course :</p>
          </div>

          <div class=\"liste clearfix\">
            <div class=\"text\">";
    $i=0;
    for($i=0; $i<count($ingr);$i++){
        print' <p>-'. $ingr[$i]['nom'] . '(' . $qt[$i] . $ingr[$i]['unite'] . ') </p>';
    }


echo "            </div>
          </div>

        </div>";
}
?>