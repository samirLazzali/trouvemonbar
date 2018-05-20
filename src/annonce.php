<?php
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

    public function getId() {
	return $this->id;
    }

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
	if ($this->module != 'NULL') print " - $this->module";
	print "</div>";
	print "<div class=tag>";
	print "TAG1 TAG2 TAG3 TAG4 TAG5";
	print "</div>";

	print "<div class=desc>";
	print "$this->content";
	print "</div>";
	print "</div>";

	print "<div class=logi>";

	print "<b>Reward: </b>";
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

    public function getAge() {
	// Age en fonction de la date de post
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
	    $annonce->setOp(Annonce::uidToUsername($connection, $row->op));
	    $annonce->setContent($row->description);
	    $annonce->setGenre($row->genre);
	    $annonce->setSemestre($row->semestre);
	    $annonce->setModule($row->module);
	    $annonce->setPaiement($row->paiement);
	    $annonce->setService($row->service);

	    $annonces[] = $annonce;
	}

	return $annonces;
    }

    public static function modAnnonces($query) {
	$connection = dbConnect();
	dbExec($connection, $query);
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

	return dbExec($connection, $query);
    }

    public function sendToDbFull() {
	$connection = dbConnect();
	$opId = Annonce::usernameToUid($connection, $this->op);
	$date = $this->date->format("Y-m-d H:i:s");
	$query = "INSERT INTO annonce (id, postdate, offer, op, semestre, module, genre, titre, description, paiement, service) VALUES ($this->id,
		'$date',
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

	return dbExec($connection, $query);
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

	} else {
	    $annonce->setSemestre('NULL');
	}


	if (isset($_POST['annoncepayamount']) && $_POST['annoncepayamount'] != "") {
	    $annonce->setPaiement($_POST['annoncepayamount']);
	} else {
	    $annonce->setPaiement(0);
	}

	if (isset($_POST['annonceswapnature'])) {
	    $annonce->setService($_POST['annonceswapnature']);
	} else {
	    $annonce->setService('NULL');
	}

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
	$query = "SELECT * FROM annonce";
	$authorized = array('op', 'semestre', 'module');
	$toAdd = array();

	foreach ($criterium as $key => $value) {
	    if (in_array($key, $authorized))
		$toAdd[$key] = $value;
	}

	if (count($toAdd) == 0)
	    return "";

	$query = $query." WHERE ";

	foreach ($toAdd as $key => $value)
	    $query = $query."$key = $value AND ";

	$query = substr($query, 0, -4);

	return $query." ORDER BY postdate DESC";
    }
}

function displayFormCreate($annonce = null) {
    include("modules/createForm.php");
}
