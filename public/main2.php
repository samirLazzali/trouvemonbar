<?php

require '../src/TagContenuMedia/TagContenuMediaRepository.php';
require '../src/Media/MediaRepository.php';
require '../vendor/autoload.php';
session_start();

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$tagContenuMediaRepository= new \TagContenuMedia\TagContenuMediaRepository($connection);
$tagContenuMedia = $tagContenuMediaRepository->fetchAll();

$userRepository = new \User\UserRepository($connection);
$mediaRepository = new \Media\MediaRepository($connection);


if (isset($_GET["modif"]))
{
    $userRepository->modif($_SESSION['identifiant'], $_GET["mail"], $_GET["nom"], $_GET["prenom"], $_GET["date"]);
}

if (isset($_GET["submit"]))
{
    $mediaRepository->valide($_GET['id_media']);
}
?>

	


<html>
<link rel="stylesheet" href="main.css" type="text/css">
	<body>
		<header>
		<h1>PinTutu</h1>
		<div class="parametre">
		<form action="parametres.php" formethod="post">
			<input type="submit" name="Paramètres" value="Parametres"/>
		</form>
        <form action="ajout.php" formethod="post">
             <input type="submit" name="ajout" value="Ajouter du contenu"/>
        </form>
		<form action="index.php" formethod="post">
			<input type="submit" name="deconnexion" value="Déconnexion">
		</form>
            <?php

			if(isset($_SESSION['rang'])&&($_SESSION['rang']=="1")){
				echo '<form action=a_valider.php formetod="post">
						<input type="submit" name="a_valider" value="A valider" />
					</form>';}
					?>
		</div>
		</header>
		<?php
		if (isset($_SESSION['identifiant'])) {


            echo '<main>
			<aside>
			<h2>Choix des tags</h2>
			<p>
			<form action="main2.php" formmethod="get">
				Animaux: <input type="checkbox" name="animaux" value="animaux" /></br>
				Mélancolique: <input type="checkbox" name="melancolique" value="melancolique" /></br>
                Drôle: <input type="checkbox" name="drole" value="drole"/></br>
				Paysages: <input type="checkbox" name="paysages" value="paysages"/></br>
				Cuisine: <input type="checkbox" name="cuisine" value="cuisine"/></br>
				Peinture:<input type="checkbox" name="peinture" value="peinture"/></br>
				Sculpture:<input type="checkbox" name="sculpture" value="sculpture"/></br>
				Musique:<input type="checkbox" name="musique" value="musique"/></br>
				Code:<input type="checkbox" name="code" value="code"/></br>
				Troll:<input type="checkbox" name="troll" value="troll"/></br>
				WTF:<input type="checkbox" name="wtf" value="wtf"/></br>
				<input type="submit", value="Rechercher"/>
			</form>
			</p>
			</aside>
			<div class="mosaique">';

            $res=array();

            foreach ($tagContenuMedia as $contenu) {

                if ($contenu->valide == "1") {
                    $count = 1;
                    if (!in_array($contenu->id_media, $res)) {
                        //var_dump($res);

                        if (isset($_GET['animaux'])) {
                            if ($_GET['animaux'] == 'animaux') {
                                //foreach ($tagContenuMedia as $contenu) {
                                if (($count <= 20) && ($contenu->tag == 1)) {
                                    $_POST['animaux'] = null;
                                    echo ' <img src="Image/' . $contenu->id_media . '" alt="image1" >';
                                    if ($count % 4 == 0) {
                                        echo '<br/>';

                                    }
                                    $count = $count + 1;
                                    $c = $contenu->id_media;
                                    $res = array_merge($res, array($c));

                                }
                            }

                        }
                        if (isset($_GET['melancolique'])) {
                            if ($_GET['melancolique'] == 'melancolique') {
                                //foreach ($tagContenuMedia as $contenu) {
                                if (($count <= 20) && ($contenu->tag == 2)) {
                                    echo ' <img src=" Image/' . $contenu->id_media . '" alt="image2">';
                                    if ($count % 4 == 0) {
                                        echo '<br/>';

                                    }
                                    $count = $count + 1;
                                    $c = $contenu->id_media;
                                    $res = array_merge($res, array($c));

                                }
                            }


                        }
                        if (isset($_GET['drole'])) {
                            if ($_GET['drole'] == 'drole') {
                                //foreach ($tagContenuMedia as $contenu) {
                                if (($count <= 20) && ($contenu->tag == 3)) {
                                    echo ' <img src=" Image/' . $contenu->id_media . '" alt="image3">';
                                    if ($count % 4 == 0) {
                                        echo '<br/>';

                                    }
                                    $count = $count + 1;
                                    $c = $contenu->id_media;
                                    $res = array_merge($res, array($c));
                                }
                            }

                        }
                        if (isset($_GET['paysages'])) {
                            if ($_GET['paysages'] == 'paysages') {
                                //foreach ($tagContenuMedia as $contenu) {
                                if (($count <= 20) && ($contenu->tag == 4)) {
                                    echo ' <img src=" Image/' . $contenu->id_media . '" alt="image4">';
                                    if ($count % 4 == 0) {
                                        echo '<br/>';

                                    }
                                    $count = $count + 1;
                                    $c = $contenu->id_media;
                                    $res = array_merge($res, array($c));
                                }
                            }

                        }
                        if (isset($_GET['cuisine'])) {
                            if ($_GET['cuisine'] == 'cuisine') {
                                //foreach ($tagContenuMedia as $contenu) {
                                if (($count <= 20) && ($contenu->tag == 5)) {
                                    echo ' <img src=" Image/' . $contenu->id_media . '" alt="image5">';
                                    if ($count % 4 == 0) {
                                        echo '<br/>';

                                    }
                                    $count = $count + 1;
                                    $c = $contenu->id_media;
                                    $res = array_merge($res, array($c));
                                }
                            }

                        }
                        if (isset($_GET['peinture'])) {
                            if ($_GET['peinture'] == 'peinture') {
                                //foreach ($tagContenuMedia as $contenu) {
                                if (($count <= 20) && ($contenu->tag == 6)) {
                                    echo ' <img src=" Image/' . $contenu->id_media . '" alt="image6">';
                                    if ($count % 4 == 0) {
                                        echo '<br/>';

                                    }
                                    $count = $count + 1;
                                    $c = $contenu->id_media;
                                    $res = array_merge($res, array($c));
                                }

                            }


                        }
                        if (isset($_GET['sculpture'])) {
                            if ($_GET['sculpture'] == 'sculpture') {
                                //foreach ($tagContenuMedia as $contenu) {
                                if (($count <= 20) && ($contenu->tag == 7)) {
                                    echo ' <img src=" Image/' . $contenu->id_media . '" alt="image7">';
                                    if ($count % 4 == 0) {
                                        echo '<br/>';

                                    }
                                    $count = $count + 1;
                                    $c = $contenu->id_media;
                                    $res = array_merge($res, array($c));
                                }
                            }

                        }
                        if (isset($_GET['code'])) {
                            if ($_GET['code'] == 'code') {
                                //foreach ($tagContenuMedia as $contenu) {
                                if (($count <= 20) && ($contenu->tag == 8)) {
                                    echo ' <img src=" Image/' . $contenu->id_media . '" alt="image8">';
                                    if ($count % 4 == 0) {
                                        echo '<br/>';

                                    }
                                    $count = $count + 1;
                                    $c = $contenu->id_media;
                                    $res = array_merge($res, array($c));
                                }
                            }

                        }
                        if (isset($_GET['troll'])) {
                            if ($_GET['troll'] == 'troll') {
                                //foreach ($tagContenuMedia as $contenu) {
                                if (($count <= 20) && ($contenu->tag == 9)) {
                                    echo ' <img src=" Image/' . $contenu->id_media . '" alt="image9">';
                                    if ($count % 4 == 0) {
                                        echo '<br/>';

                                    }
                                    $count = $count + 1;
                                    $c = $contenu->id_media;
                                    $res = array_merge($res, array($c));
                                }
                            }

                        }
                        if (isset($_GET['wtf'])) {
                            if ($_GET['wtf'] == 'wtf') {
                                //foreach ($tagContenuMedia as $contenu) {
                                if (($count <= 20) && ($contenu->tag == 10)) {
                                    echo ' <img src=" Image/' . $contenu->id_media . '" alt="image10">';
                                    if ($count % 4 == 0) {
                                        echo '<br/>';

                                    }
                                    $count = $count + 1;
                                    $c = $contenu->id_media;
                                    $res = array_merge($res, array($c));
                                }
                            }

                        }



                    }
                }

            }
            echo '
                <div>

			</main>';
        }
        else {
		    echo 'Session expirée';
		}

		?>
		</body>
</html>
		