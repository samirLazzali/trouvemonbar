<?php
/**
 * Manga prefere
 *
 * PHP Version 7.0
 *
 * @category Manga
 * @package  Public
 * @author   Eric COLONIA <ercol@outlook.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost:8080/index.php
 */

/**
 * Affiche les mangas prefere au baka
 *
 * @return void
 */
function Manga_pref()
{    
    echo"<div class='pref'>
		<center>
		Les mangas préférés des bakateux (Année 2018-2019) : 
		</center>
		</div>";
    echo "<div class='text-center'>";
    echo "<center>";
    echo "1. ";
    echo "</br>";
    echo "<img style='width:180px;'src='Manga_pref/img1.jpeg' /> ";
    echo "</br>";
    echo "2. ";
    echo "</br>";
    echo "<img style='width:180px;' src='Manga_pref/img2.jpg' /> ";
    echo "</br>";
    echo "3.";
    echo "</br>";
    echo "<img style='width:180px;' src='Manga_pref/img3.jpg' /> ";
    echo"</br>";
    echo "</center>";
    echo "</div>";
}


?>
