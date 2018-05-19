<?php include("postannonce.php"); 
require '../src/accessdb.php';
?>

<!DOCTYPE html>
<html>
<head>
<script type='text/javascript'>
function toggletextepayant(){
	Objp=document.getElementById('zonetextepaying')
	Objs=document.getElementById('zonetexteswap')
	Objp.style.display="block"
	Objp.style.display="none"
}
function toggletexteswap(){
	Objp=document.getElementById('zonetextepaying')
	Objs=document.getElementById('zonetexteswap')
	Objp.style.display="none"
	Objp.style.display="block"
}
function togglemodule1(){
	Obj1=document.getElementById('selectmodule1')
	Obj2=document.getElementById('selectmodule2')
	Obj3=document.getElementById('selectmodule3')
	Obj4=document.getElementById('selectmodule4')
	Obj5=document.getElementById('selectmodule5')
	Obj6=document.getElementById('selectmodule6')
	Obj1.style.display="block"
	Obj2.style.display="none"
	Obj3.style.display="none"
	Obj4.style.display="none"
	Obj5.style.display="none"
}

function togglemodule2(){
	Obj1=document.getElementById('selectmodule1')
	Obj2=document.getElementById('selectmodule2')
	Obj3=document.getElementById('selectmodule3')
	Obj4=document.getElementById('selectmodule4')
	Obj5=document.getElementById('selectmodule5')
	Obj6=document.getElementById('selectmodule6')
	Obj1.style.display="none"
	Obj2.style.display="block"
	Obj3.style.display="none"
	Obj4.style.display="none"
	Obj5.style.display="none"
}

function togglemodule3(){
	Obj1=document.getElementById('selectmodule1')
	Obj2=document.getElementById('selectmodule2')
	Obj3=document.getElementById('selectmodule3')
	Obj4=document.getElementById('selectmodule4')
	Obj5=document.getElementById('selectmodule5')
	Obj6=document.getElementById('selectmodule6')
	Obj1.style.display="none"
	Obj2.style.display="none"
	Obj3.style.display="block"
	Obj4.style.display="none"
	Obj5.style.display="none"
}

function togglemodule4(){
	Obj1=document.getElementById('selectmodule1')
	Obj2=document.getElementById('selectmodule2')
	Obj3=document.getElementById('selectmodule3')
	Obj4=document.getElementById('selectmodule4')
	Obj5=document.getElementById('selectmodule5')
	Obj6=document.getElementById('selectmodule6')
	Obj1.style.display="none"
	Obj2.style.display="none"
	Obj3.style.display="none"
	Obj4.style.display="block"
	Obj5.style.display="none"
}

function togglemodule5(){
	Obj1=document.getElementById('selectmodule1')
	Obj2=document.getElementById('selectmodule2')
	Obj3=document.getElementById('selectmodule3')
	Obj4=document.getElementById('selectmodule4')
	Obj5=document.getElementById('selectmodule5')
	Obj6=document.getElementById('selectmodule6')
	Obj1.style.display="none"
	Obj2.style.display="none"
	Obj3.style.display="none"
	Obj4.style.display="none"
	Obj5.style.display="block"
}
</script>
<meta charset=\"utf-8\" />
<link rel="stylesheet" type="text/css" href="annoncestyle.css"/>
</head>
<body>
	<h1>CREATE ANNOUNCEMENT</h1> </br>
	<img src="https://i.pinimg.com/originals/f2/67/18/f267186d0181372cfb832eb548e83896.jpg" class="center"/> </br>
	<form name="annonce" method="post" action="postannonce.php">
 		<div class="radio-group">
		<input type="radio" id="option-one" name="annoncetype"><label for="option-one">Offer</label><input type="radio" id="option-two" 				  name="annoncetype"><label for="option-two">Query</label>
  		</div> </br>

		<div class="radio-group">
		<input type="radio" id="paying" name="annoncereturn" onClick="toggletextepayant()"/><label for="paying">PAY</label><input type="radio" id="exchange" 				  name="annoncereturn" onClick="toggletexteswap()"/><label for="exchange">SWAP</label> <input type="radio" id="free" name="annoncereturn"><label for="free">FREE</label>
  		</div> </br>
		<div id="zonetextepaying">AMOUNT (€): <input type="number" name="annoncepayamount"/> <br/></div>
		<div id="zonetexteswap">NATURE OF SWAP: <input type="text" name="annonceswapnature"/> <br/> </div>
		TITLE: <input type="text" name="annoncetitle"/> <br/>
		GENRE: <input type="text" name="annoncegenre" value="Projet, TP, etc."/> <br/>
		<textarea name="annoncedesc" cols="40" rows="3"> Enter short description here</textarea><br/>
		SEMESTER: <select name=”annoncesemester”>
		<option value=”1” onClick="togglemodule1()">1</option>
		<option value=”2” onClick="togglemodule2()">2</option>
		<option value=”3” onClick="togglemodule3()">3</option>
		<option value=”4” onClick="togglemodule4()">4</option>
		<option value=”5” onClick="togglemodule5()">5</option>
		</select> <br/>

		<div id="selectmodule1">MODULE: <select name=”annoncemodule”>
		<option value=”ECO1”>ECO1</option>
		<option value=”IBD”>IBD</option>
		<option value=”IPI”>IPI</option>
		<option value=”LVFH1”>LVFH1</option>
		<option value=”MAN”>MAN</option>
		<option value=”MCI”>MCI</option>
		<option value=”MPR”>MPR</option>
		<option value=”MTG”>MTG</option>
		<option value=”OSS”>OSS</option>
		</select> <br/>

		<div id="selectmodule2">MODULE: <select name=”annoncemodule”>
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

		<div id="selectmodule3">MODULE: <select name=”annoncemodule”>
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

		<div id="selectmodule4">MODULE: <select name=”annoncemodule”>
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
		
		<input type="submit" name="send" value="CREATE"/>
		<input type="reset" name="startover" value="ERASE"/>
	</form>
</body>
</html>