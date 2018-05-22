<div id="anim_alert" style="display: none;"><img id="anim_alert_img" src="public/image/coeur.png" width="50px" /></div>
<div id="anim_text" class="text-center" style="display: none;">Félicitation vous avez atteint le niveau de <span style="color: red;"><?php echo $sex_appeal; ?></span></div>
<script src="public/js/display_menu.js"></script>

<script>
/*Script qui gère les notifications liés aux matchs et aux nouveaux messages*/
var count_match = document.getElementById('count_match');
var count_chat = document.getElementById('count_chat');

function getNotif() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
      var json_reponse = JSON.parse(xhr.responseText);

      if (json_reponse['match'] > 0)
        count_match.textContent = json_reponse['match'];
      else
        count_match.textContent = '';

      if (json_reponse['chat'] > 0)
        count_chat.textContent = json_reponse['chat'];
      else
        count_chat.textContent = '';

    }
  };

  xhr.open("GET", "notif.php", true);
  xhr.send(null);
}

setInterval(getNotif, 5000);

</script>

<script>
/*Script d'animation lorsqu'un nouveau niveau est atteint*/
var image = document.getElementById("anim_alert");
var image_w = document.getElementById("anim_alert_img");
var anim_text = document.getElementById("anim_text");


image.style.position = "fixed";
image.style.zIndex = "1000";

anim_text.style.position = "fixed";
anim_text.style.backgroundColor = "white";

anim_text.style.width = "100px";
anim_text.style.height = "100px";
anim_text.style.zIndex = "1001";

/*Paramètres de la spirale logarithmique*/
var theta = 0;
var a = 10;
var b = 0.05;
/*Début de l'animation*/
var start = <?php echo (int) $afficher_anim; ?>;
var id;

if (start) {
 id = setInterval(frame, 5);

 /*Équation paramétrique de la figure*/
 image.style.left = 100 * Math.exp(b * theta) * Math.cos(theta) + window.innerWidth / 2 + "px";
 image.style.top = 100 * Math.exp(b * theta) * Math.sin(theta) + window.innerHeight / 2 + "px";
 image.style.display = "block";
}
var id_arret = id;

function frame() {
	/*Condition d'arrêt*/
		if (theta > 50) {
				clearInterval(id_arret);
				image.style.left = window.innerWidth / 2 - 500 / 2 + "px";
				image.style.top = window.innerHeight / 2 - 500 / 2 + "px";
				image_w.style.width = "500px";

				anim_text.style.left = window.innerWidth / 2 - 100 / 2 + "px";
				anim_text.style.top = window.innerHeight / 2 - 100 + "px";
				anim_text.style.display = "block";
		}else {
				image.style.left = 100 * Math.exp(b * theta) * Math.cos(theta) + window.innerWidth / 2 + "px";
				image.style.top = 100 * Math.exp(b * theta) * Math.sin(theta) + window.innerHeight / 2 + "px";

				/*Le pas de l'animation	*/
				theta += 0.1;
		}
}

image.style.cursor = 'pointer';
anim_text.style.cursor = 'pointer';

image.onclick = function() {
	image.style.display = "none";
	anim_text.style.display = "none";
}
anim_text.onclick = function() {
	image.style.display = "none";
	anim_text.style.display = "none";
}

</script>

<footer class="row">
		<p class="col-md-12">
Ce site a été conçu pour l'école ENSIIE
		</p>
</footer>
