<?php
include("tags.php");

class Annonce {
    public $id;
    public $title;
    public $date;
    public $content;
    public $op;
    public $tagArray;
    public $genre;
    public $semestre;
    public $module;
    public $paiement;
    public $service;
    public $isOffer;

    public function display() {
	print "<div class=annonce id=a$this->id>";
	print "<div class=title>";
	print ($this->isOffer?"Offre: ":"Recherche: ");
	print "$this->title ";
	print "<a class=\"toggleAnnonce\"><i class=\"fas fa-angle-up\"></i></a>";

	if ($_SESSION['username'] == $this->op || $_SESSION['admin'] == true) {
	    print "<a class=\"edit\" href=\"createForm.php?edit=$this->id\"><i class=\"far fa-edit\"></i></a>";
	}

	print "</div>";

	print "<div class=more>";
	print "<div class=info>";
	print "$this->genre</br>$this->op</br>S$this->semestre";
	if ($this->module != 'NULL') print " - $this->module</br>";
	print "</div>";

	print "<div class=desc>";
	print "$this->content";
	print "</div>";

	if (sizeof($this->tagArray) != 0) {
	    print "<div class=\"tags\">";
	    print Tags::tagsToString($this->tagArray);
	    print "</div>";
	}

	print "</div>";

	print "<div class=logi>";

	print "<b>";
	if ($this->isOffer)
	    print "Demande: ";
	else 
	    print "Récompense: ";
	print "</b>";

	if ($this->paiement != 0) {
	    print "$this->paiement euros";
	    if ($this->service != null) print " + $this->service";
	} else if ($this->service != null) {
	    print "$this->service";
	} else {
	    print "Gratuit";
	}

	print "</div>";
	print "</div>";
    }

    public function setId($id) {
	$this->id = $id;
    }

    public function setTitle($title) {
	$this->title = $title;
    }

    public function setDate($date) {
	$this->date = $date;
    }

    public function setContent($content) {
	$this->content = $content;
    }

    public function setOp($op) {
	$this->op = $op;
    }

    public function setGenre($genre) {
	$this->genre = $genre;
    }

    public function setTags($array) {
	$this->tagArray = $array;
    }

    public function setSemestre($semestre) {
	$this->semestre = $semestre;
    }

    public function setModule($module) {
	$this->module = $module;
    }

    public function setPaiement($paiement) {
	$this->paiement = $paiement;
    }

    public function setService($service) {
	$this->service = $service;
    }

    public function setNature($type) {
	$this->isOffer = $type;
    }

    public static function uidToUsername($connection, $id) {
	$rows = dbQuery($connection, "SELECT * FROM users WHERE id='$id'");
	foreach ($rows as $row) {
	    return $row->username;
	}
    }

    public static function usernameToUid($connection, $username) {
	$rows = dbQuery($connection, "SELECT * FROM users WHERE username='$username'");
	foreach ($rows as $row) {
	    return $row->id;
	}
	return null;
    }

    public static function getAnnonces($requete = "SELECT * FROM annonce ORDER BY postdate DESC LIMIT 10") {
	if ($requete == null || $requete == "")
	    return array();

	$connection = dbConnect();
	$rows = dbQuery($connection, $requete);
	$annonces = [];

	foreach($rows as $row) {
	    $annonce = new Annonce();
	    $annonce->setId($row->id);
	    $annonce->setTitle($row->titre);
	    $annonce->setNature($row->offer);
	    $annonce->setDate(new \DateTimeImmutable($row->postdate));

	    if (isset($row->username)) {
		$op = Annonce::usernameToUid($connection, $row->username);
		$annonce->setOp($row->username);
	    } else {
		$op = $row->op;
		$annonce->setOp(Annonce::uidToUsername($connection, $row->op));
	    }

	    $annonce->setContent($row->description);
	    $annonce->setGenre($row->genre);
	    $annonce->setSemestre($row->semestre);
	    $annonce->setModule($row->module);
	    $annonce->setPaiement($row->paiement);
	    $annonce->setService($row->service);
	    $annonce->setTags(array());

	    $rows = dbQuery($connection, "SELECT name FROM ((annonce JOIN links ON annonce.id = links.aid) JOIN tags ON links.tid = tags.id) WHERE annonce.id = $row->id;");

	    foreach ($rows as $tag)
		$annonce->tagArray[] = $tag->name;

	    //print_r($annonce->tagArray);

	    $annonces[] = $annonce;
	}

	return $annonces;
    }

    public static function modAnnonces($requete) {
	if ($requete == null || $requete == "")
	    return array();

	$connection = dbConnect();
	dbExec($connection, $requete);
    }

    public static function getAnnonceById($id) {
	$res = Annonce::getAnnonces("SELECT * FROM annonce WHERE id=$id");
	if (sizeof($res) != 0) 
	    return $res[0];
	return null;
    }

    public static function delAnnonceById($id) {
	Annonce::modAnnonces("DELETE FROM annonce WHERE id=$id");
    }

    public static function getId($annonce) {
	if (isset($annonce->id))
	    return $annonce->id;

	$connection = dbConnect();
	$query = "SELECT id FROM annonce WHERE postdate = " . $connection->quote($annonce->date) . ";";
	$res = dbQuery($connection, $query);

	return $res[0]->id;
    }

    public function sendToDb() {
	$connection = dbConnect();
	$opId = Annonce::usernameToUid($connection, $this->op);
	$query = "INSERT INTO annonce (postdate, offer, op, semestre, module, genre, titre, description, paiement, service) 
	    VALUES ('$this->date',
		$this->isOffer,
		$opId,
		$this->semestre, 
		'$this->module',
		" . $connection->quote($this->genre) . ", 
		" . $connection->quote($this->title) . ", 
		" . $connection->quote($this->content) . ", 
		$this->paiement, 
		'$this->service'

	    );";

	dbExec($connection, $query);

	foreach ($this->tagArray as $tag) {
	    $aid = Annonce::getId($this);
	    $tid = Tags::getId($tag);
	    $query = "INSERT INTO links VALUES ($aid, $tid);";
	    dbExec($connection, $query);
	}
    }

    public function updateDb() {
	$connection = dbConnect();
	$opId = Annonce::usernameToUid($connection, $this->op);
	$date = $this->date->format("Y-m-d H:i:s");
	$query = "UPDATE annonce SET postdate = " . $connection->quote($date) . ",
	    offer = $this->isOffer, 
	    op = $opId, 
	    semestre = $this->semestre, 
	    module = " . $connection->quote($this->module) . ",
	    genre = " . $connection->quote($this->genre) . ",
	    titre = " . $connection->quote($this->title) . ",
	    description = " . $connection->quote($this->content) . ",
	    paiement = $this->paiement,
	    service = " . $connection->quote($this->service) . " WHERE id=$this->id; ";

	//print $query;
	dbExec($connection, $query);
	Tags::resetTags($this->id);

	foreach ($this->tagArray as $tag) {
	    $aid = Annonce::getId($this);
	    $tid = Tags::getId($tag);
	    $query = "INSERT INTO links VALUES ($aid, $tid);";
	    dbExec($connection, $query);
	}
    }

    public static function annonceFromPost($op) {
	$annonce = new Annonce();

	$annonce->op = $op;
	$annonce->date = date("Y-m-d H:i:s");

	if (isset($_POST['offer'])) {
	    $annonce->setNature('True');
	} else {
	    $annonce->setNature('False');
	}

	if (isset($_POST['annoncetitle'])) {
	    $annonce->setTitle($_POST['annoncetitle']);
	} else {
	    return null;
	}

	if (isset($_POST['annoncedesc'])) {
	    $annonce->setContent($_POST['annoncedesc']);
	} else {
	    return null;
	}

	if (isset($_POST['annoncegenre'])) {
	    $annonce->setGenre($_POST['annoncegenre']);
	} else {
	    $annonce->setGenre('NULL');
	}

	if (isset($_POST['annoncesemester'])) {
	    $sem = $_POST['annoncesemester'];
	    $annonce->setSemestre($sem);

	    if (isset($_POST["annoncemodule".$sem])) $annonce->setModule($_POST["annoncemodule".$sem]);
	    else $annonce->setModule('NULL');

	} else
	    $annonce->setSemestre('NULL');

	if (isset($_POST['annoncepayamount']) && $_POST['annoncepayamount'] != "") $annonce->setPaiement($_POST['annoncepayamount']);
	else {
	    $annonce->setPaiement(0);
	}

	if (isset($_POST['annonceswapnature'])) {
	    $annonce->setService($_POST['annonceswapnature']);
	} else {
	    $annonce->setService('NULL');
	}

	if (isset($_POST['annoncetags']))
	    $annonce->tagArray = Tags::stringToTags($_POST['annoncetags']);
	else
	    $annonce->tagArray = array();

	return $annonce;
    }

    public static function status() {
	if (isset($_GET['done'])) {
	    if ($_GET['done']) {
		print "L'annonce a été postée !";
	    } else {
		print "Une erreur s'est produite, veuillez réessayer.";
	    }
	}
    }


    public static function genQuery($criterium = []) {
	$connection = dbConnect();
	$authorized = array('titre','op', 'semestre', 'module');
	$toAdd = array();
	$tags = array();

	if (isset($criterium['tags']))
	    $tags = Tags::stringToTags($criterium['tags']);

	foreach ($criterium as $key => $value) {
	    if (in_array($key, $authorized) && !empty($value)) {
		if ($key == 'op' && ($value = Annonce::usernameToUid($connection, $value)) == null)
		    continue;
		$toAdd[$key] = $value;
	    }
	}

	if (count($toAdd) == 0 && sizeof($tags) == 0)
	    return "";

	$query = "SELECT * FROM annonce WHERE ";

	foreach ($toAdd as $key => $value)
	    $query = $query . "$key = " . $connection->quote($value) . " AND ";

	$query = substr($query, 0, -4); //On enleve le AND
	$query = $query." ORDER BY postdate DESC";

	if (!isset($criterium['tags']) || empty($criterium['tags']))
	    return $query;

	//// SI IL Y A DES TAGS /////

	$rows = dbQuery($connection, $query);
	$toCheck = array();
	$toAdd = array();

	foreach($rows as $res)
	    $toCheck[] = $res->id;

	foreach ($toCheck as $aid) {
	    $good = true;
	    $affected = array();
	    $rows = dbQuery($connection, "SELECT * FROM (links JOIN tags ON links.tid = tags.id) WHERE links.aid = $aid");

	    foreach($rows as $res)
		$affected[] = $res->name;

	    foreach($tags as $tag)
		if (!in_array($tag, $affected))
		    $good = false;

	    if ($good)
		$toAdd[] = $aid;
	}

	$query = "SELECT * FROM annonce WHERE ";

	foreach ($toAdd as $aid)
	    $query = $query . "id = " . $connection->quote($aid) . " OR ";

	$query = substr($query, 0, -3); //On enleve le OR
	$query = $query." ORDER BY postdate DESC";

	return $query;
    }


    public static function reduceButton() {
	print "<a style=\"display: inline;\" class=\"reduce\" href=\"#reduce\"><i class=\"fas fa-minus-square\"></i></a>";
    }
}

function displayFormCreate($annonce = null) {
    include("modules/createForm.php");
}
