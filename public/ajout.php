



<html>
<link rel="stylesheet" href="parametres.css" type="text/css">
<body>
<header>
    <h1>PinTutu</h1>
    <div class="parametre">
        <form action="main2.php" formethod="post">
            <input type="submit" name="Paramètres" value="Menu principal"/>
        </form>
        <form action="parametres.php" formethod="post">
            <input type="submit" name="Paramètres" value="parametre"/>
        </form>

    </div>
</header>
    <main>
        <!--<form enctype="multipart/form-data" action="ajout2.php" formethod="get">
            <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
            <input type="file" id="fileselect" accept="image/*" name="fileselect" />
            <input type="submit" name="submit" value="Importer"  >
        </form>-->
        <form enctype="multipart/form-data" action="ajout3.php" formethod="get">
            <h3>Choisissez le type du fichier</h3>
            Image <input type="radio" name="type" value="image"><br>
            Musique <input type="radio" name="type" value="musique"><br>
            Vidéo <input type="radio" name="type" value="video"><br>
            Texte <input type="radio" name="type" value="texte"><br>
            <br>
            <h3>Choix des tags</h3>
            Animaux: <input type="checkbox" name="animaux" value="animaux" />
            Mélancolique: <input type="checkbox" name="melancolique" value="melancolique" />
            Drôle: <input type="checkbox" name="drole" value="drole"/>
            Paysages: <input type="checkbox" name="paysages" value="paysages"/>
            Cuisine: <input type="checkbox" name="cuisine" value="cuisine"/>
            Peinture:<input type="checkbox" name="peinture" value="peinture"/>
            Sculpture:<input type="checkbox" name="sculpture" value="sculpture"/>
            Code:<input type="checkbox" name="code" value="code"/>
            Troll:<input type="checkbox" name="troll" value="troll"/>
            WTF:<input type="checkbox" name="wtf" value="wtf"/>
            <br><br>


            <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
            <input type="file" id="fileselect" accept="image/*" name="fileselect" />
            <input type="submit" name="submit" value="Importer"  >
        </form>

</body>
<html>

