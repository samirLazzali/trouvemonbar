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

    public function getId() {
	return $this->id;
    }

    public function display() {
	print "<div class=annonce id=a$this->id>";
	print "<div class=title>";
	print "$this->title ";
	print "<a class=\"toggleAnnonce\"><i class=\"fas fa-angle-up\"></i></a>";

	if ($_SESSION['username'] == $this->op || $_SESSION['admin'] == true) {
	    print "<a class=\"edit\"><i class=\"far fa-edit\"></i></a>";
	}

	print "</div>";

	print "<div class=more>";
	print "<div class=info>";
	print "$this->genre</br>$this->op</br>S$this->semestre";
	if ($this->module != 'NULL') print " - $this->module";
	print "</div>";

	print "<div class=desc>";
	print "$this->content";
	print "</div>";
	print "</div>";

	print "<div class=logi>";

	print "<b>Reward: </b>";
	if ($this->paiement != 0) {
	    print "$this->paiement euros";
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

    public static function getAnnonces($requete = "SELECT * FROM annonce ORDER BY postdate DESC") {
	$connection = dbConnect();
	$rows = dbQuery($connection, $requete);
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
	    $annonce->setModule($row->module);
	    $annonce->setPaiement($row->paiement);
	    $annonce->setService($row->service);

	    $annonces[] = $annonce;
	}

	return $annonces;
    }

    public function sendToDb() {
	$connection = dbConnect();
	$opId = Annonce::usernameToUid($connection, $this->op);
	$query = "INSERT INTO annonce (postdate, op, semestre, module, genre, titre, description, paiement, service) 
	    VALUES ('$this->date',
		$opId,
		$this->semestre, 
		'$this->module',
		'$this->genre', 
		'$this->title', 
		'$this->content', 
		$this->paiement, 
		'$this->service'
	    );";

	return dbExec($connection, $query);
    }
    
    public static function annonceFromPost($op) {
	$annonce = new Annonce();

	$annonce->op = $op;
	$annonce->date = date("Y-m-d H:i:s");

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
	    $annonce->setSemestre($_POST['annoncesemester']);
	} else {
	    $annonce->setSemestre('NULL');
	}

	if (isset($_POST['annoncemodule'])) {
	    $annonce->setModule($_POST['annoncemodule']);
	} else {
	    $annonce->setModule('NULL');
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
	if (isset($_POST['done'])) {
	    if ($_POST['done']) {
		print "An error has occured";
	    } else {
		print "Posted !";
	    }
	}
    }
}

function displayFormCreate() {
    print "<div id=\"form_border\">";
    print "    <form name=\"annonce\" class=\"create\" method=\"post\" action=\"create.php\">";
    print "	<div class=\"radio-group\">";
    print "	    <label for=\"offer\">Offer</label>";
    print "	    <input type=\"radio\" id=\"offer\" name=\"annoncetype\">";
    print "	    <label for=\"query\">Query</label>";
    print "	    <input type=\"radio\" id=\"query\" name=\"annoncetype\">";
    print "      </div>";
    print "";
    print "	<div class=\"radio-group\">";
    print "	    <input type=\"radio\" id=\"paying\" name=\"annoncereturn\" onClick=\"toggletextepayant()\"/>";
    print "	    <label for=\"paying\">";
    print "		Pay";
    print "	    </label>";
    print "	    <input type=\"radio\" id=\"exchange\" name=\"annoncereturn\" onClick=\"toggletexteswap()\"/>";
    print "	    <label for=\"exchange\">";
    print "		Swap";
    print "	    </label>";
    print "	    <input type=\"radio\" id=\"free\" name=\"annoncereturn\" onClick=\"togglecacher();\"/>";
    print "	    <label for=\"free\">";
    print "		Free";
    print "	    </label>";
    print "	</div>";
    print "	<div id=\"zonetextepaying\">";
    print "	    Amount (€): <input type=\"number\" name=\"annoncepayamount\" class=\"textcenter\"/>";
    print "  </div>";
    print "	<div id=\"zonetexteswap\">Nature of swap: <input type=\"text\" name=\"annonceswapnature\" class=\"textcenter\"/></div>";
    print "	Title: <input type=\"text\" name=\"annoncetitle\" class=\"textcenter\"/>";
    print "	Genre: <input type=\"text\" name=\"annoncegenre\" placeholder=\"Projet, TP, etc.\" class=\"textcenter\"/>";
    print "	Description: <textarea name=\"annoncedesc\" cols=\"30\" rows=\"3\" maxlength=\"240\" placeholder=\"Enter short description here\" class=\"textcenter\"></textarea>";
    print "	SEMESTER: <select name=\"annoncesemester\" class=\"styled-select black rounded\">";
    print "	    <option value=\"1\" class=\"toggle\">1</option>";
    print "	    <option value=\"2\" class=\"toggle\">2</option>";
    print "	    <option value=\"3\" class=\"toggle\">3</option>";
    print "	    <option value=\"4\" class=\"toggle\">4</option>";
    print "	    <option value=\"5\" class=\"toggle\">5</option>";
    print "	</select> ";
    print "";
    print "	<div id=\"selectmodule1\" style=\"display: none\">MODULE: <select name=\"annoncemodule\">";
    print "		<option value=\"ECO1\">ECO1</option>";
    print "		<option value=\"IBD\">IBD</option>";
    print "		<option value=\"IPI\">IPI</option>";
    print "		<option value=\"LVFH1\">LVFH1</option>";
    print "		<option value=\"MAN\">MAN</option>";
    print "		<option value=\"MCI\">MCI</option>";
    print "		<option value=\"MPR\">MPR</option>";
    print "		<option value=\"MTG\">MTG</option>";
    print "		<option value=\"OSS\">OSS</option>";
    print "	    </select>";
    print "	</div>";
    print "";
    print "	<div id=\"selectmodule2\" style=\"display: none\">MODULE: <select name=\"annoncemodule\">";
    print "		<option value=\"ECO2\">ECO2</option>";
    print "		<option value=\"ILO\">ILO</option>";
    print "		<option value=\"IPFL\">IPFL</option>";
    print "		<option value=\"LVFH2\">LVFH2</option>";
    print "		<option value=\"MST\">MST</option>";
    print "		<option value=\"MTEF\">MTEF</option>";
    print "		<option value=\"OPTI\">OPTI</option>";
    print "		<option value=\"PROJ\">PROJ</option>";
    print "		<option value=\"PWR\">PWR</option>";
    print "	    </select> ";
    print "	</div>";
    print "";
    print "	<div id=\"selectmodule3\" style=\"display: none\">MODULE: <select name=\"annoncemodule\">";
    print "		<option value=\"ECO3\">ECO3</option>";
    print "		<option value=\"ASE\">ASE</option>";
    print "		<option value=\"IAC\">IAC</option>";
    print "		<option value=\"IGL\">IGL</option>";
    print "		<option value=\"IPF\">IPF</option>";
    print "		<option value=\"IPS\">IPS</option>";
    print "		<option value=\"LSF-VVL\">LSF-VVL</option>";
    print "		<option value=\"LVFH3\">LVFH3</option>";
    print "		<option value=\"MICRO-ARCHI\">MICRO-ARCHI</option>";
    print "		<option value=\"MRO\">MRO</option>";
    print "		<option value=\"MRR\">MRR</option>";
    print "		<option value=\"PIMA\">PAP</option>";
    print "		<option value=\"PP\">PST</option>";
    print "		<option value=\"SE1\">SE1</option>";
    print "		<option value=\"SRM\">SRM</option>";
    print "	    </select> ";
    print "	</div>";
    print "";
    print "	<div id=\"selectmodule4\" style=\"display: none\">MODULE: <select name=\"annoncemodule\">";
    print "		<option value=\"ANEDP\">ANEDP</option>";
    print "		<option value=\"ANU\">ANU</option>";
    print "		<option value=\"ARMA\">ARMA</option>";
    print "		<option value=\"ASN\">ASN</option>";
    print "		<option value=\"AUTO\">AUTO</option>";
    print "		<option value=\"CAL\">CAL</option>";
    print "		<option value=\"CC\">CC</option>";
    print "		<option value=\"CORO\">CORO</option>";
    print "		<option value=\"ECO4\">ECO4</option>";
    print "		<option value=\"IA\">IA</option>";
    print "		<option value=\"IMF\">IMF</option>";
    print "		<option value=\"IRA\">IRA</option>";
    print "		<option value=\"LC\">LC</option>";
    print "		<option value=\"LOA\">LOA</option>";
    print "		<option value=\"LVFH4\">LVFH4</option>";
    print "		<option value=\"MCS\">MCS</option>";
    print "		<option value=\"MESIM\">MESIM</option>";
    print "		<option value=\"MFDLS\">MFDLS</option>";
    print "		<option value=\"MOST\">MOST</option>";
    print "		<option value=\"PBT\">PBT</option>";
    print "		<option value=\"PRB\">PRB</option>";
    print "		<option value=\"PRR\">PRR</option>";
    print "		<option value=\"PSA\">PSA</option>";
    print "		<option value=\"RDH\">RDH</option>";
    print "		<option value=\"RIAL\">RIAL</option>";
    print "		<option value=\"RVIG\">RVIG</option>";
    print "		<option value=\"SE2\">SE2</option>";
    print "		<option value=\"SEC-CEA\">SEC-CEA</option>";
    print "		<option value=\"SFP\">SFP</option>";
    print "		<option value=\"SIP1-SIP2\">SIP1-SIP2</option>";
    print "		<option value=\"SSI\">SSI</option>";
    print "	    </select> ";
    print "	</div>";
    print "  ";
    print "	<div id=\"selectmodule5\" style=\"display: none\">MODULE: <select name=\"annoncemodule\">";
    print "		<option value=\"AEBI\">AEBI</option>";
    print "		<option value=\"GPA\">GPA</option>";
    print "		<option value=\"ISA\">ISA</option>";
    print "		<option value=\"MAF\">MAF</option>";
    print "		<option value=\"MAL\">MAL</option>";
    print "		<option value=\"MQF\">MQF</option>";
    print "		<option value=\"MSA\">MSA</option>";
    print "		<option value=\"NTOE\">NTOE</option>";
    print "		<option value=\"OPTI\">OPTI</option>";
    print "    <option value=\"PMGD\">PMGD</option>";
    print "    <option value=\"PROG\">PROG</option>";
    print "    <option value=\"RESO\">RESO</option>";
    print "    <option value=\"SEC\">SEC</option>";
    print "    <option value=\"SIBD\">SIBD</option>";
    print "    <option value=\"WIA\">WIA</option>";
    print "	    </select> ";
    print "	</div>";
    print "";
    print "	<input type=\"submit\" name=\"submit\" value=\"CREATE\"/>";
    print "	<input type=\"reset\" name=\"startover\" value=\"ERASE\"/>";
    print "    </form>";
    print "    <script src=\"js/createannonce.js\"></script>";
}
?>
