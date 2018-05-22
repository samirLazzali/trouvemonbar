<!DOCTYPE html>


<?php
$lang = $_POST['lang'];
$name = $_POST['name'];
$cmc = $_POST['cmc'];
$type = $_POST['type'];
$set = $_POST['set'];
$rarity = $_POST['rarity'];
$ability = $_POST['ability'];
$flavor = $_POST['flavor'];
$power = $_POST['power'];
$toughness = $_POST['toughness'];
$loyalty = $_POST['loyalty'];
$artist = $_POST['artist'];

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
?>


<html>
    <head>
		<meta charset="UTF-8" />
		<title>Template</title>
		<link rel="stylesheet" href="index.css" type="text/css">
	</head>
	
	<body>
	<div class="header">
		<div class="title"><h2><a href="index.html">Filigrane</a></h2></div>
			<div class="navbar">
				<a href="index.html">Accueil</a>
				<a href="Error404.html">L'association</a>
				<div class="dropdown">
					<button class="dropbtn">Magic The Gathering
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="Error404.html">Règles</a>
						<a href="Error404.html">Compétition</a>
						<a href="Error404.html">Collections</a>
						<a href="RechercheMagic.php">Recherche de cartes</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Legend of the Five Rings
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="Error404.html">Premiers pas</a>
						<a href="Error404.html">L'Univers de Rokugan</a>
						<a href="Error404.html">Un peu de stratégie...</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Yu-Gi-Oh
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="Error404.html">Règles</a>
						<a href="Error404.html">C'est l'heure du duel !</a>
						<a href="Error404.html">...</a>
						<a href="Error404.html">J'sais pas quoi écrire ici</a>
					</div>
				</div>
		</div> 
	</div>

	<div class="row">
		<div class="column side" id="left_col" style="background-color:#000000;"><img src="Pictures/Sidebar_1.png"></div>
	
		<div class="column middle" style="background-color:#bbb;">
			<a href="RechercheMagic.php">Lancer une nouvelle recherche</a>
			<?php
            if (!$first) {
                $result = $connection->query($query);
                $k = 0;
                echo("<div class='card_row'>");
                while ($row = $result->fetch()) {
                    if ($k % 3 == 0) {
                        echo("</div><div class='card_row'>");
                    }
                    $beforeprevious = "";
                    $previous = "";
                    $imgpath = "pics/" . $row['set_code'] . "/";
                    foreach (str_split($row['name']) as $current) {
                        if ($previous != "/" && $current != "/" && $current != " ") {
                            if ($beforeprevious != "/" && $previous == " ") $imgpath .= "%20";
                            $imgpath .= $current;
                        }
                        $beforeprevious = $previous;
                        $previous = $current;
                    }
                    $imgpath .= ".full.jpg";
                    echo("<div class='card'>");
                    echo '<img src="' . $imgpath . '" alt="Désolé, l\'image de ' . $row['name']
                         . ' (' . $row['set_code'] . ') n\'a pas pu être affichée :("/>';
                    echo("</div>");
                    $k++;
                }
                echo ("</div>");
            }

			
			?>
		</div>
			
		<div class="column side" id="right_col" style="background-color:#000000;"><img src="Pictures/Sidebar_2.png"></div>
	</div>

	<div class="footer">
		<p>This is the footer</p>
	</div>
	
    </body>
</html>












