<?php
include("annonce.php"); 
include("viewfunctions.php");

header_t("Hey");
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<div id="imageannonce">
    <img src="https://s3.amazonaws.com/cdn.viewpointcs.com/www/images/products/icons/legacy-productBenefitIcon-hostingDB.png"/>
</div>

<div class="main">
	<div class="annonce">
    <div class="title"> <i class="fas fa-arrow-circle-down"></i> CREATE ANNOUNCEMENT
    </div>
  </br>
</br>
<div id="form_border">
    <form name="annonce" class="create" method="post" action="create.php">
	<div class="radio-group">
	    <input type="radio" id="offer" name="annoncetype">
	    <label for="offer">
		OFFER
	    </label>
	    <input type="radio" id="query" name="annoncetype">
	    <label for="query">
		QUERY
	    </label>
      </div> </br>

	<div class="radio-group">
	    <input type="radio" id="paying" name="annoncereturn" onClick="toggletextepayant()"/>
	    <label for="paying">
		PAY
	    </label>
	    <input type="radio" id="exchange" name="annoncereturn" onClick="toggletexteswap()"/>
	    <label for="exchange">
		SWAP
	    </label>
	    <input type="radio" id="free" name="annoncereturn" onClick="togglecacher();"/>
	    <label for="free">
		FREE
	    </label>
	</div>
	<div id="zonetextepaying">
	    AMOUNT (€): <input type="number" name="annoncepayamount" class="textcenter"/>
  </div> </br>
	<div id="zonetexteswap">NATURE OF SWAP: <input type="text" name="annonceswapnature" class="textcenter"/></div> </br>
	TITLE: <input type="text" name="annoncetitle" class="textcenter"/> <br/>
	GENRE: <input type="text" name="annoncegenre" placeholder="Projet, TP, etc." class="textcenter"/> <br/>
	<textarea name="annoncedesc" cols="30" rows="3" maxlength="240" placeholder="Enter short description here" class="textcenter"></textarea><br/>
	SEMESTER: <select name=”annoncesemester” class="styled-select black rounded">
	    <option value="S1" class="toggle">1</option>
	    <option value="S2" class="toggle">2</option>
	    <option value="S3" class="toggle">3</option>
	    <option value="S4" class="toggle">4</option>
	    <option value="S5" class="toggle">5</option>
	</select> <br/>

	<div id="selectmodule1" style="display: none">MODULE: <select name=”annoncemodule”>
		<option value=”ECO1”>ECO1</option>
		<option value=”IBD”>IBD</option>
		<option value=”IPI”>IPI</option>
		<option value=”LVFH1”>LVFH1</option>
		<option value=”MAN”>MAN</option>
		<option value=”MCI”>MCI</option>
		<option value=”MPR”>MPR</option>
		<option value=”MTG”>MTG</option>
		<option value=”OSS”>OSS</option>
	    </select>
	</div>

	<div id="selectmodule2" style="display: none">MODULE: <select name=”annoncemodule”>
		<option value=”ECO2”>ECO2</option>
		<option value=”ILO”>ILO</option>
		<option value=”IPFL”>IPFL</option>
		<option value=”LVFH2”>LVFH2</option>
		<option value=”MST”>MST</option>
		<option value=”MTEF”>MTEF</option>
		<option value=”OPTI”>OPTI</option>
		<option value=”PROJ”>PROJ</option>
		<option value=”PWR”>PWR</option>
	    </select> <br/>
	</div>

	<div id="selectmodule3" style="display: none">MODULE: <select name=”annoncemodule”>
		<option value=”ECO3”>ECO3</option>
		<option value=”ASE”>ASE</option>
		<option value=”IAC”>IAC</option>
		<option value=”IGL”>IGL</option>
		<option value=”IPF”>IPF</option>
		<option value=”IPS”>IPS</option>
		<option value=”LSF-VVL”>LSF-VVL</option>
		<option value=”LVFH3”>LVFH3</option>
		<option value=”MICRO-ARCHI”>MICRO-ARCHI</option>
		<option value=”MRO”>MRO</option>
		<option value=”MRR”>MRR</option>
		<option value=”PIMA”>PAP</option>
		<option value=”PP”>PST</option>
		<option value=”SE1”>SE1</option>
		<option value=”SRM”>SRM</option>
	    </select> <br/>
	</div>

	<div id="selectmodule4" style="display: none">MODULE: <select name=”annoncemodule”>
		<option value=”ANEDP”>ANEDP</option>
		<option value=”ANU”>ANU</option>
		<option value=”ARMA”>ARMA</option>
		<option value=”ASN”>ASN</option>
		<option value=”AUTO”>AUTO</option>
		<option value=”CAL”>CAL</option>
		<option value=”CC”>CC</option>
		<option value=”CORO”>CORO</option>
		<option value=”ECO4”>ECO4</option>
		<option value=”IA”>IA</option>
		<option value=”IMF”>IMF</option>
		<option value=”IRA”>IRA</option>
		<option value=”LC”>LC</option>
		<option value=”LOA”>LOA</option>
		<option value=”LVFH4”>LVFH4</option>
		<option value=”MCS”>MCS</option>
		<option value=”MESIM”>MESIM</option>
		<option value=”MFDLS”>MFDLS</option>
		<option value=”MOST”>MOST</option>
		<option value=”PBT”>PBT</option>
		<option value=”PRB”>PRB</option>
		<option value=”PRR”>PRR</option>
		<option value=”PSA”>PSA</option>
		<option value=”RDH”>RDH</option>
		<option value=”RIAL”>RIAL</option>
		<option value=”RVIG”>RVIG</option>
		<option value=”SE2”>SE2</option>
		<option value=”SEC-CEA”>SEC-CEA</option>
		<option value=”SFP”>SFP</option>
		<option value=”SIP1-SIP2”>SIP1-SIP2</option>
		<option value=”SSI”>SSI</option>
	    </select> <br/>
	</div>
  
	<div id="selectmodule5" style="display: none">MODULE: <select name=”annoncemodule”>
		<option value=”AEBI”>AEBI</option>
		<option value=”GPA”>GPA</option>
		<option value=”ISA”>ISA</option>
		<option value=”MAF”>MAF</option>
		<option value=”MAL”>MAL</option>
		<option value=”MQF”>MQF</option>
		<option value=”MSA”>MSA</option>
		<option value=”NTOE”>NTOE</option>
		<option value=”OPTI”>OPTI</option>
    <option value=”PMGD”>PMGD</option>
    <option value=”PROG”>PROG</option>
    <option value=”RESO”>RESO</option>
    <option value=”SEC”>SEC</option>
    <option value=”SIBD”>SIBD</option>
    <option value=”WIA”>WIA</option>
	    </select> <br/>
	</div>

	<input type="submit" name="submit" value="CREATE"/>
	<input type="reset" name="startover" value="ERASE"/>
  </br>
    </form>
    <script src="js/createannonce.js"></script>
</div>
</div>
</div>

<script type="text/javascript">
  togglecacher();
</script>

<?php
	    footer();
	    ?>
