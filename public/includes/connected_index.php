
	<h2>Mes infos :</h2>
	<p>
	<?php
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
		
	$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
	$infos = $connexion -> query("SELECT login, phone_number FROM Utilisateur WHERE id_user = ".intval($_SESSION['id_user']));
	$infos -> setFetchMode(PDO::FETCH_OBJ);
	$fetch = $infos -> fetch();
		
	global $queries;
	$queries++;
		
	?> Nom d'utilisateur : <?php echo $fetch -> login; ?><br/>
	Numéro de téléphone : <?php echo $fetch -> phone_number; ?><br/>


	<form name="infos_cat" id="infos_cat" action="affChat()" method="read_cat">
		<fieldset><legend>Mes chats :</legend>
		<?php
		$chats = $connexion -> query("SELECT id_cat, name_cat FROM Cats WHERE owner = ".intval($_SESSION['id_user']));
		$chats -> setFetchMode(PDO::FETCH_OBJ);
		$chat = $chats -> fetch();
		$i = 1;
		while ($chat != FALSE) { ?>
			<input type ="radio" name="cat" value="<?php $i ?>" id="<?php $i ?>" ><label for "<?php $i ?>"><?php echo $chat->name_cat; ?></label></input><br/>
			<?php $chat = $chats -> fetch();
			$i++;
		}
		?>
		<input type="submit" value="Afficher les informations sur le chat en question" />
		</fieldset>
	</form>
	<a href="<?php echo ROOTPATH; ?>/cats/add_cat.php">Ajouter un nouveau chat ++</a>
<?php


include('toptop.php');
include('affChat.php');

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");



$chatsPossedes = $connexion->query("SELECT id_cat, name_cat
                                            FROM Cats
                                            WHERE owner=".$_SESSION['id_user']);
while($chat=$chatsPossedes->fetch(PDO::FETCH_OBJ)){ # En gros on récupère sous forme d'un tableau de string la table à afficher pour chacun des chats du connecté
    $namesChatsPossedes[] = $chat->name_cat;
    $tabAff[] = affChat($chat->id_cat);
}

?>

    <script>
        function affMatch() {
            var x = document.forms["choix"]["liste"].value;
            if (x==-1) {
                document.getElementById("matcher").innerHTML = "";
            } else {
                document.getElementById("matcher").innerHTML = <?php echo json_encode($tabAff); ?>[x];
            }
            /* myFunction(); */
        }
    </script>

<?php
include('topbot.php');
?>


    <div id="contenu">
    <h2>Mes infos :</h2>
    <p>
        <?php

        global $queries;
        $queries++;
        $infos = $connexion -> query("SELECT login, phone_number FROM Utilisateur WHERE id_user = ".intval($_SESSION['id_user']));
        $infos -> setFetchMode(PDO::FETCH_OBJ);
        $fetch = $infos -> fetch();

        ?> Nom d'utilisateur : <?php echo $fetch -> login; ?><br/>
        Numéro de téléphone : <?php echo $fetch -> phone_number; ?><br/>


        <form NAME="choix">
            <select NAME="liste" onChange="affMatch()">
                <OPTION VALUE=-1 > Voir vos chats
                    <?php
                    if (!empty($tabAff)){
                        for ($i = 0; $i<sizeof($tabAff); $i++) {
                            echo '<OPTION VALUE='.$i.'>'.$namesChatsPossedes[$i];
                        }
                    }
                    ?>
            </select>
        </form>

        <table id="matcher"></table>
        <a href="<?php echo ROOTPATH; ?>/cats/add_cat.php">Ajouter un nouveau chat ++</a>
        </p>
    </div>
