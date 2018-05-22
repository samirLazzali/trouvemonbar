<html>
    <head>
		<meta charset="UTF-8" />
		<title>Recherche de cartes</title>
		<link rel="stylesheet" href="index.css" type="text/css">
	</head>

	<div class="header">
		<h2>Filigrane</h2>
			<div class="navbar">
				<a href="#home">Home</a>
				<a href="#news">News</a>
				<div class="dropdown">
					<button class="dropbtn">Magic The Gathering
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="#">Règles</a>
						<a href="#">Compétition</a>
						<a href="#">Collections</a>
						<a href="#">Recherche de cartes</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Legend of the Five Rings
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="#">Premiers pas</a>
						<a href="#">L'Univers de Rokugan</a>
						<a href="#">Un peu de stratégie...</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Yu-Gi-Oh
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="#">Règles</a>
						<a href="#">C'est l'heure du duel !</a>
						<a href="#">...</a>
						<a href="#">J'sais pas quoi écrire ici</a>
					</div>
				</div>
		</div> 
	</div>

	<div class="row">
		<div class="column side" style="background-color:#aaa;">Column</div>
	
		<div class="column middle" style="background-color:#bbb;">
			<h2>Recherche de cartes</h2>
				<hr/>
				<form method="post" action="index.php">
            Langue :
            <select name="lang">
                <option value="all" selected="selected">Toutes</option>
                <option value="fr">Français</option>
                <option value="en">Anglais</option>
            </select><br/>
            Nom : <input type="text" name="name"/><br/>
            Coût converti : <input type="text" name="cmc" size="1"/><br/>
            <table>
                <tr>
                    <td>
                        Couleurs<br/>
                        <input type="checkbox" name="color_W" value="W"/>Blanc<br/>
                        <input type="checkbox" name="color_U" value="U"/>Bleu<br/>
                        <input type="checkbox" name="color_B" value="B"/>Noir<br/>
                        <input type="checkbox" name="color_R" value="R"/>Rouge<br/>
                        <input type="checkbox" name="color_G" value="G"/>Vert<br/>
                        <input type="checkbox" name="color_C" value="C"/>Incolore<br/>
                    </td>
                    <td>
                        Identité couleur<br/>
                        <input type="checkbox" name="identity_W" value="W"/>Blanc<br/>
                        <input type="checkbox" name="identity_U" value="U"/>Bleu<br/>
                        <input type="checkbox" name="identity_B" value="B"/>Noir<br/>
                        <input type="checkbox" name="identity_R" value="R"/>Rouge<br/>
                        <input type="checkbox" name="identity_G" value="G"/>Vert<br/>
                        <input type="checkbox" name="identity_C" value="C"/>Incolore<br/>
                    </td>
                </tr>
            </table>
            Types / sous-types : <input type="text" name="type"/><br/>
            Extension : <input type="text" name="set"/><br/>
            Rareté :
            <select name="rarity">
                <option value="N">Aucun choix</option>
                <option value="C">Commune</option>
                <option value="U">Inhabituelle</option>
                <option value="R">Rare</option>
                <option value="M">Rare Mythique</option>
                <option value="T">Timeshifted</option>
            </select><br/>
            Capacités : <input type="text" name="ability"/><br/>
            Texte d'ambiance : <input type="text" name="flavor"/><br/>
            Force : <input type="text" name="power" size="1"/>
            Endurance : <input type="text" name="toughness" size="1"/>
            Loyauté : <input type="text" name="loyalty" size="1"/><br/>
            Artiste : <input type="text" name="artist"/><br/>
            <br/>
            <input type="submit" value="OK"/>
        </form>
			</div>
			
			<div class="column side" style="background-color:#ccc;">Column</div>
		</div>

		<div class="footer">
			<p>This is the footer</p>
		</div>
	
    </body>
</html>

<?php
$lang = !empty($_POST['lang']) ? $_POST['lang'] : NULL;
$name = !empty($_POST['name']) ? $_POST['name'] : NULL;
$cmc = !empty($_POST['cmc']) ? $_POST['cmc'] : NULL;
$type = !empty($_POST['type']) ? $_POST['type'] : NULL;
$set = !empty($_POST['set']) ? $_POST['set'] : NULL;
$rarity = !empty($_POST['rarity']) ? $_POST['rarity'] : NULL;
$ability = !empty($_POST['ability']) ? $_POST['ability'] : NULL;
$flavor = !empty($_POST['flavor']) ? $_POST['flavor'] : NULL;
$power = !empty($_POST['power']) ? $_POST['power'] : NULL;
$toughness = !empty($_POST['toughness']) ? $_POST['toughness'] : NULL;
$loyalty = !empty($_POST['loyalty']) ? $_POST['loyalty'] : NULL;
$artist = !empty($_POST['artist']) ? $_POST['artist'] : NULL;

require '../vendor/autoload.php';

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$first = true;

$query = "SELECT name, set_code FROM cartes WHERE ";

if ($name != NULL)
{
    if ($first) $first = false;
    else $query .= "AND ";

    if ($lang == "all") $query .= "(UPPER(name) LIKE '%" . strtoupper($name) . "%' OR UPPER(name_fr) LIKE '%"
                                  . strtoupper($name) . "%') ";
    if ($lang == "fr") $query .= "UPPER(name_fr) LIKE '%" . strtoupper($name) . "%' ";
    if ($lang == "en") $query .= "UPPER(name) LIKE '%" . strtoupper($name) . "%' ";
}
if ($cmc != NULL)
{
    if ($first) $first = false;
    else $query .= "AND ";
    $query .= "converted_manacost LIKE '%" . $cmc . "%' ";
}
if (isset($_POST['color_W']) or isset($_POST['color_U']) or isset($_POST['color_B']) or
    isset($_POST['color_R']) or isset($_POST['color_G']) or isset($_POST['color_C']))
{
    if ($first) $first = false;
    else $query .= "AND ";

    if (isset($_POST['color_C'])) $query .= "(color LIKE '%A%' OR color LIKE '%L%') AND ";
    else $query .= "color NOT LIKE '%A%' AND color NOT LIKE '%L%' AND ";

    if (isset($_POST['color_W'])) $query .= "color LIKE '%W%' AND ";
    else $query .= "color NOT LIKE '%W%' AND ";

    if (isset($_POST['color_U'])) $query .= "color LIKE '%U%' AND ";
    else $query .= "color NOT LIKE '%U%' AND ";

    if (isset($_POST['color_B'])) $query .= "color LIKE '%B%' AND ";
    else $query .= "color NOT LIKE '%B%' AND ";

    if (isset($_POST['color_R'])) $query .= "color LIKE '%R%' AND ";
    else $query .= "color NOT LIKE '%R%' AND ";

    if (isset($_POST['color_G'])) $query .= "color LIKE '%G%' ";
    else $query .= "color NOT LIKE '%G%' ";
}
if (isset($_POST['identity_W']) or isset($_POST['identity_U']) or isset($_POST['identity_B']) or
    isset($_POST['identity_R']) or isset($_POST['identity_G']) or isset($_POST['identity_C']))
{
    if ($first) $first = false;
    else $query .= "AND ";

    $colorless = true;

    if (isset($_POST['identity_W']) != NULL)
    {
        $colorless = false;
        $query .= "color_identity LIKE '%W%' AND ";
    }
    else $query .= "color_identity NOT LIKE '%W%' AND ";

    if (isset($_POST['identity_U']) != NULL)
    {
        $colorless = false;
        $query .= "color_identity LIKE '%U%' AND ";
    }
    else $query .= "color_identity NOT LIKE '%U%' AND ";

    if (isset($_POST['identity_B']) != NULL)
    {
        $colorless = false;
        $query .= "color_identity LIKE '%B%' AND ";
    }
    else $query .= "color_identity NOT LIKE '%B%' AND ";

    if (isset($_POST['identity_R']) != NULL)
    {
        $colorless = false;
        $query .= "color_identity LIKE '%R%' AND ";
    }
    else $query .= "color_identity NOT LIKE '%R%' AND ";

    if (isset($_POST['identity_G']) != NULL)
    {
        $colorless = false;
        $query .= "color_identity LIKE '%G%' ";
    }
    else $query .= "color_identity NOT LIKE '%G%' ";

    if ($colorless) $query .= "color_identity IS NULL ";
}
if ($type != NULL)
{
    $typearray = explode(" ", $type);
    foreach ($typearray as $t)
    {
        if ($first) $first = false;
        else $query .= "AND ";
        if ($lang == "all") $query .= "(UPPER(type) LIKE '%" . strtoupper($t) . "%' OR UPPER(type_fr) LIKE '%"
                                      . strtoupper($t) . "%') ";
        if ($lang == "fr") $query .= "UPPER(type_fr) LIKE '%" . strtoupper($t) . "%' ";
        if ($lang == "en") $query .= "UPPER(type) LIKE '%" . strtoupper($t) . "%' ";
    }
}
if ($set != NULL)
{
    $setarray = explode(" ", $set);
    foreach ($setarray as $s)
    {
        if ($first) $first = false;
        else $query .= "AND ";
        $query .= "UPPER(set) LIKE '%" . strtoupper($s) . "%' ";
    }
}
if ($rarity != NULL and $rarity != "N")
{
    if ($first) $first = false;
    else $query .= "AND ";
    $query .= "rarity LIKE '%" . $rarity . "%' ";

}
if ($ability != NULL)
{
    $arrayability = explode(" ", $ability);
    foreach ($arrayability as $a)
    {
        if ($first) $first = false;
        else $query .= "AND ";
        if ($lang == "all") $query .= "(UPPER(ability) LIKE '%" . strtoupper($a) . "%' OR UPPER(ability_fr) LIKE '%"
                                      . strtoupper($a) . "%') ";
        if ($lang == "fr") $query .= "UPPER(ability_fr) LIKE '%" . strtoupper($a) . "%' ";
        if ($lang == "en") $query .= "UPPER(ability) LIKE '%" . strtoupper($a) . "%' ";
    }
}
if ($flavor != NULL)
{
    $arrayflavor = explode(" ", $flavor);
    foreach ($arrayflavor as $f)
    {
        if ($first) $first = false;
        else $query .= "AND ";
        if ($lang == "all") $query .= "(UPPER(flavor) LIKE '%" . strtoupper($f) . "%' OR UPPER(flavor_fr) LIKE '%"
                                      . strtoupper($f) . "%') ";
        if ($lang == "fr") $query .= "UPPER(flavor_fr) LIKE '%" . strtoupper($f) . "%' ";
        if ($lang == "en") $query .= "UPPER(flavor) LIKE '%" . strtoupper($f) . "%' ";
    }
}
if ($power != NULL)
{
    if ($first) $first = false;
    else $query .= "AND ";
    if (strpos($power, "*") !== false or strpos($power, "X") !== false)
    {
        $query .= "(power LIKE '%*%' OR power LIKE '%X%') ";
    }
    else $query .= "power LIKE '" . $power . "' ";
}
if ($toughness != NULL)
{
    if ($first) $first = false;
    else $query .= "AND ";
    if (strpos($toughness, "*") !== false or strpos($toughness, "X") !== false)
    {
        $query .= "(toughness LIKE '%*%' OR toughness LIKE '%X%') ";
    }
    else $query .= "toughness LIKE '" . $toughness . "' ";
}
if ($loyalty != NULL)
{
    if ($first) $first = false;
    else $query .= "AND ";
    if (strpos($loyalty, "*") !== false or strpos($loyalty, "X") !== false)
    {
        $query .= "(loyalty LIKE '%*%' OR loyalty LIKE '%X%') ";
    }
    else $query .= "loyalty LIKE '" . $loyalty . "' ";
}
if ($artist != NULL)
{
    $arrayartist = explode(" ", $artist);
    foreach ($arrayartist as $a)
    {
        if ($first) $first = false;
        else $query .= "AND ";
        $query .= "UPPER(artist) LIKE '%" . strtoupper($a) . "%' ";
    }
}
$query .= " ORDER BY converted_manacost, name";

if (!$first)
{
    $result = $connection->query($query);
    while ($row = $result->fetch())
    {
        $beforeprevious = "";
        $previous = "";
        $imgpath = "pics/" . $row['set_code'] . "/";
        foreach (str_split($row['name']) as $current)
        {
            if ($previous != "/" && $current != "/" && $current != " ")
            {
                if ($beforeprevious != "/" && $previous == " ") $imgpath .= "%20";
                $imgpath .= $current;
            }
            $beforeprevious = $previous;
            $previous = $current;
        }
        $imgpath .= ".full.jpg";
        echo '<img src="' . $imgpath . '" alt="Désolé, l\'image de ' . $row[0] . ' n\'a pas pu être affichée :("/><br/>';
    }
}
?>