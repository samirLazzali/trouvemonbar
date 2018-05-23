<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 19/04/18
 * Time: 22:05
 */
include("Vue.php");
include("Modele.php");
?>


<?php entete() ?>

<?php
bandeau();
?>

<h3>TALES OF DEMONS AND GODS</h3>

<p>Chap 1</p>

<label class="switch" onclick="nightmode()">
    <input type="checkbox" id="eclairement" >
    <span class="slider round"></span>
</label>
<br/>
<?php

echo "<a href='like.php'>Click pour like</a>";
for($i=1;$i<14;$i++){
    echo "<div class='imgManga'>" ;
    echo "<img src='../manga/TODAG/".$i.".jpg' alt=".$i.".jpg' />" ;
    echo "</div>" ;
} ?>
<script>
    
        var mode = document.querySelector('input[id="eclairement"]') ;

        var img = document.getElementsByClassName("imgManga") ;

        mode.onchange = function() {
            var i;
            if (mode.checked) {
                for (i = 0; i < img.length; i++) {
                    img[i].style.backgroundColor = "black";
                }
            }
            else {
                for (i = 0; i < img.length; i++) {
                    img[i].style.backgroundColor = "white";
                }
            }
        }
</script>


<?php pied() ?>