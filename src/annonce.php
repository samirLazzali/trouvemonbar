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
	if (isset($_POST['done'])) {
	    if ($_POST['done']) {
		print "Posted !";
	    } else {
		print "An error has occured";
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

function displayFormCreate() {
    print "<link rel=stylesheet href=css/createForm.css><div id=form_border><ul class=\"tab-group\"><li class=\"nature active\"><a href=#offer>Offer</a><li class=nature><a href=#query>Query</a></ul><ul class=tab-group><li class=\"tab active\"><a href=#money>Pay with money</a><li class=tab><a href=#service>Pay with service</a><li class=tab><a href=#free>Free</a></ul><form name=annonce class=create method=post action=create.php><div class=tab-content><div id=money><div class=field-wrap><label>Amount (€)</label>";
    print "<input type=number name=annoncepayamount></div></div><div id=service><div class=field-wrap><label>Nature of swap</label>";
    print "<input name=annonceswapnature></div></div></div><div class=field-wrap><label>Title<span class=req>*</span></label>";
    print "<input name=annoncetitle required></div><div class=field-wrap><label>Genre<span class=req>*</span></label>";
    print "<input name=annoncegenre required></div><div class=field-wrap><label class=big>Description<span class=req>*</span></label>";
    print "<textarea name=annoncedesc cols=30 rows=3 maxlength=240 required></textarea></div><input type=radio id=isoffer value=offer visibility=hidden checked><div class=smselect><select name=annoncesemester class=\"styled-select black rounded\">";
    print "<option value disabled selected>Semestre";
    print "<option value=1 class=toggle>S1";
    print "<option value=2 class=toggle>S2";
    print "<option value=3 class=toggle>S3";
    print "<option value=4 class=toggle>S4";
    print "<option value=5 class=toggle>S5</select><div class=smodule id=selectmodule1 style=display:none><select name=annoncemodule1>";
    print "<option value disabled selected>Module";
    print "<option value=ECO1>ECO1";
    print "<option value=IBD>IBD";
    print "<option value=IPI>IPI";
    print "<option value=LVFH1>LVFH1";
    print "<option value=MAN>MAN";
    print "<option value=MCI>MCI";
    print "<option value=MPR>MPR";
    print "<option value=MTG>MTG";
    print "<option value=OSS>OSS</select></div><div class=smodule id=selectmodule2 style=display:none><select name=annoncemodule2>";
    print "<option value disabled selected>Module";
    print "<option value=ECO2>ECO2";
    print "<option value=ILO>ILO";
    print "<option value=IPFL>IPFL";
    print "<option value=LVFH2>LVFH2";
    print "<option value=MST>MST";
    print "<option value=MTEF>MTEF";
    print "<option value=OPTI>OPTI";
    print "<option value=PROJ>PROJ";
    print "<option value=PWR>PWR</select></div><div class=smodule id=selectmodule3 style=display:none><select name=annoncemodule3>";
    print "<option value disabled selected>Module";
    print "<option value=ECO3>ECO3";
    print "<option value=ASE>ASE";
    print "<option value=IAC>IAC";
    print "<option value=IGL>IGL";
    print "<option value=IPF>IPF";
    print "<option value=IPS>IPS";
    print "<option value=LSF-VVL>LSF-VVL";
    print "<option value=LVFH3>LVFH3";
    print "<option value=MICRO-ARCHI>MICRO-ARCHI";
    print "<option value=MRO>MRO";
    print "<option value=MRR>MRR";
    print "<option value=PIMA>PAP";
    print "<option value=PP>PST";
    print "<option value=SE1>SE1";
    print "<option value=SRM>SRM</select></div><div class=smodule id=selectmodule4 style=display:none><select name=annoncemodule4>";
    print "<option value disabled selected>Module";
    print "<option value=ANEDP>ANEDP";
    print "<option value=ANU>ANU";
    print "<option value=ARMA>ARMA";
    print "<option value=ASN>ASN";
    print "<option value=AUTO>AUTO";
    print "<option value=CAL>CAL";
    print "<option value=CC>CC";
    print "<option value=CORO>CORO";
    print "<option value=ECO4>ECO4";
    print "<option value=IA>IA";
    print "<option value=IMF>IMF";
    print "<option value=IRA>IRA";
    print "<option value=LC>LC";
    print "<option value=LOA>LOA";
    print "<option value=LVFH4>LVFH4";
    print "<option value=MCS>MCS";
    print "<option value=MESIM>MESIM";
    print "<option value=MFDLS>MFDLS";
    print "<option value=MOST>MOST";
    print "<option value=PBT>PBT";
    print "<option value=PRB>PRB";
    print "<option value=PRR>PRR";
    print "<option value=PSA>PSA";
    print "<option value=RDH>RDH";
    print "<option value=RIAL>RIAL";
    print "<option value=RVIG>RVIG";
    print "<option value=SE2>SE2";
    print "<option value=SEC-CEA>SEC-CEA";
    print "<option value=SFP>SFP";
    print "<option value=SIP1-SIP2>SIP1-SIP2";
    print "<option value=SSI>SSI</select></div><div class=smodule id=selectmodule5 style=display:none><select name=annoncemodule5>";
    print "<option value disabled selected>Module";
    print "<option value=AEBI>AEBI";
    print "<option value=GPA>GPA";
    print "<option value=ISA>ISA";
    print "<option value=MAF>MAF";
    print "<option value=MAL>MAL";
    print "<option value=MQF>MQF";
    print "<option value=MSA>MSA";
    print "<option value=NTOE>NTOE";
    print "<option value=OPTI>OPTI";
    print "<option value=PMGD>PMGD";
    print "<option value=PROG>PROG";
    print "<option value=RESO>RESO";
    print "<option value=SEC>SEC";
    print "<option value=SIBD>SIBD";
    print "<option value=WIA>WIA</select></div></div><div class=choice><input type=submit name=submit value=Create>";
    print "<input type=reset name=startover value=Erase></div></form></div><script src=http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js></script><script src=js/createForm.js></script>";
}
?>
