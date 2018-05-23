<?php
/**
 * Manga_random
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
 * Affiche aléatoirement un manga de la base de données
 *
 * @return Void
 */
function Affiche_manga()
{
    global $connection;
    $req="Select distinct serie  from media where type='manga'";
    $exe= new Execute($connection);
    $rows=$exe->exec_sql($req);    
    
    $i=rand(0, 2);
    $k=0;    
    $strParams=['\'' => '&#39'];
    echo "Voici un manga que nous possédons au baka :";
    echo"</br>";

    foreach($rows as $row):
        if ($k==$i) {
            $_SESSION['titre']=$row->serie;
            echo"<hr width='70%' size= '1' color='black'>";
            echo "<div class='front'>";
            echo strtr($row->serie, $strParams);
            echo"</br>";
                
            echo" <img style=' border : solid 1px grey; padding-left : 1px;
			padding-top : 1px; padding-right : 1px; padding-bottom : 1px;
 ' src='pics/$row->serie.jpg' alt='$row->serie' />";
        
            echo "</div>";
            echo"<hr width='70%' size='1' color='black'> ";
            echo"</br>"; 
            echo"Resume : </br>";
            $file="Resume/".$row->serie."_resume.txt";
            $contenu=file_get_contents($file);
            echo $contenu;
        }
        $k++;
    endforeach;

}


?>

