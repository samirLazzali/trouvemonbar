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
    public $paiement;
    public $service;

    public function getId() {
	return $this->id;
    }

    public function display() {
	print "<div class=annonce id=a$this->id>";
	print "<div class=title>";
	print "$this->title ";
	print "<a class=\"toggleAnnonce\"><i class=\"fas fa-angle-up\"></i></a>";
	print "</div>";

	print "<div class=more>";
	print "<div class=info>";
	print "$this->genre</br>$this->op</br>S$this->semestre";
	print "</div>";

	print "<div class=desc>";
	print "$this->content";
	print "</div>";
	print "</div>";

	print "<div class=logi>";
	print "$this->paiement kebabs";
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

    public function setPaiement($paiement) {
	$this->paiement = $paiement;
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

    public static function getAnnonces() {
	$connection = dbConnect();
	$rows = dbQuery($connection, "SELECT * FROM annonce");
	$annonces = [];

	foreach($rows as $row) {
	    $annonce = new Annonce();
	    $annonce->setId($row->id);
	    $annonce->setTitle($row->titre);
	    $annonce->setDate(new \DateTimeImmutable($row->postdate));
	    $annonce->setOp(Annonce::uidToUsername($connection, $row->op));
	    $annonce->setContent($row->description);
	    $annonce->setGenre($row->genre);
	    $annonce->setSemestre($row->semestre);
	    $annonce->setPaiement($row->paiement);

	    $annonces[] = $annonce;
	}

	return $annonces;
    }

    public function sendToDb() {
	$connection = dbConnect();
	$opId = usernameToUid($connection, $this->op);
	$query = "INSERT INTO annonce (postdate, op, semestre, module, genre, titre, description, paiement, service) 
	    VALUES ($this->date,
		$opId,
		$this->semestre, 
		'$this->module',
		'$this->genre', 
		'$this->title', 
		'$this->content', 
		$this->paiement, 
		'$this->service'
	    );";
	dbExec($connection, $query);
    }
}
?>
