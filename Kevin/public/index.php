
<?php
$pseudo = 'Kevin' ;
?>



<html>
<head>
	<meta charset="utf-8" />
	<title>$titre</title>
	<link rel="stylesheet" href="CSS/stylesheet1.css"/>
</head>
<body>
	<h1>Mes conversations: <?php echo $pseudo ?></h1> 

	<p id="dialogue"></p>

	<div id="chatbox" class="chatbox" disabled="disabled">
		<ul class="historiquechat">
			<li class="historique">Kevin:</br>Slt</li>
			<li class="historique">Enface :</br> Slt</li>
		</ul>
	</div>	


	<div>
		<textarea name="msg" placeholder="Votre message ..." rows="5" cols="50"></textarea>

		<button type="button" onclick="/*EnvoyerMsg()*/">Envoyer</button>
	</div>

</body>
</html>