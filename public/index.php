<?php
if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}
require_once "fonctions.php";
page_top("Filigrane | 404");
?>

	<div class="row">
		<div class="column side" id="left_col" style="background-color:#000000;"><img src="Pictures/Sidebar_1.png"></div>
	
		<div class="column middle" style="background-color:#bbb;">
			<h1>Bienvenue sur le site de Filigrane !</h1>
			<p><a href="login.php">Connectez-vous</a>, ou <a href="register.php">crééz un compte</a> si c'est votre première visite !
			
			<div class="news">
				<h2>News</h2>
				
				<div class="article">
					<div class="article_header">17/05/2018 : Scandale autour du Président !</div>
					<p>C'est une déclaration très controversée du Président Karn qui a mis le feu au poudres.</br>
					"Magic, c'est de la merde !" Tels ont été les mots exacts prononcés Lundi, durant l'assemblée générale. Nous avons interviewé M. Ultra, membre assidu, qui nous a confié son désarroi, aggravé 
					par les soupçons de détournement de fonds qui pèsent sur M. Karn: "Ca me désole. Déjà que toutes les subventions BdE sont monopolisées par Yu-Gi-Oh, si en plus le Président 
					nous rejette... Ca va finir en révolution, je vous le dis". Des mots lourds de sens, qui augurent mal le futur de l'association.</p>
				</div>
				
				<div class="article">
					<div class="article_header">17/05/2018 : Le Bakaclub enfin expulsé du Local Filigrane.</div>
					<p>Cela faisait longtemps que tout le monde l'attendait :  les derniers parasites quittent enfin le Local Filigrane (anciennement Local 31). Suite à une campagne 
					de nettoyage engagée par le Président Karn, les derniers reliquats d'otakus malfaisants ont été éradiqués. Cela n'a pas été sans mal : "J'ai été blessé deux fois par des makis explosifs, 
					et mon ami Kurogi a perdu la vue en se faisant surprendre par un hentai déguisé en tome de One Piece", nous confie Ultra. Le Président lui-même a failli perdre un bras 
					lors de l'ultime combat contre Krocoh, le président déchu, lorsque celui-ci a tenté une attaque kamikaze contre la réserve de decks Magic.</br>
					"C'est fini. CraftIIE, Guiilde, Siieste, BDSF, et enfin le Baka. Nous avons enfin repris ce qui nous revenait de droit. Il ne nous reste plus qu'à construire le 
					Grand Mur de Karn le long de la frontière pour être débarassés définitivement de ce genre d'immigrants", s'exclame le Président Karn. Pour Filigrane, l'avenir semble radieux.
					</p>
				</div>
				
				
				<div class="article">
					<div class="article_header">16/05/2018 : Filigrane crée son site Web !</div>
					<p>Grâce aux efforts d'une poignée de membres assidus de l'association, Filigrane a désormais un site Web ! </br>Vous pourrez vous y créer un compte pour
					répertorier vos decks et les comparer avec ceux de vos amis et adversaires. Vous y trouverez aussi une documentation conséquente sur les règles, les stratégies
					et les univers de vos TCG préférés : Magic The Gathering, L5R, Yu-Gi-Oh, et bien d'autres...</p>
				</div>
				
				
			</div>
		</div>
			
		<div class="column side" id="right_col" style="background-color:#000000;"><img src="Pictures/Sidebar_2.png"></div>
	</div>

	<div class="footer">
		<p>"Les decks contrôle ne sont qu'une illusion" - Karn, 2018</p>
	</div>
	
    </body>
</html>












