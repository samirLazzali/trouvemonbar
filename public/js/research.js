document.getElementById("research").onclick = function(e) {
    if (document.getElementById("formresearch").style.display == 'none') {
	$('.form').fadeIn(500);
	//document.getElementById("connect").innerHTML = "<i class=\"fas fa-times-circle\"></i> Fermer";
    } else {
	$('.form').fadeOut(500);
	//document.getElementById("connect").innerHTML = "<i class=\"fas fa-sign-in-alt\" aria-hidden=\"true\"></i> Se connecter";
    }
};

function getModules(str) {
    var select = document.getElementById("module");
    select.options.length = 0;
    if(str =="0"){
	select.setAttribute("disabled");
    }

    if(str =="1"){
	select.options[select.options.length] = new Option("Module", "");
	select.options[select.options.length] = new Option("Tous", "");
	select.options[select.options.length] = new Option("MPR", "MPR");
	select.options[select.options.length] = new Option( "IPI", "IPI");
	select.options[select.options.length] = new Option("IBD", "IBD");
	select.options[select.options.length] = new Option( "ISE", "ISE");
	select.options[select.options.length] = new Option("MTG", "MTG");
	select.options[select.options.length] = new Option( "MAN", "MAN");
    }

    if(str == "2"){
	select.options[select.options.length] = new Option("Module", "");
	select.options[select.options.length] = new Option("Tous", "");
	select.options[select.options.length] = new Option("IPFL","IPFL");
	select.options[select.options.length] = new Option("ILO", "ILO");
	select.options[select.options.length] = new Option("MST", "MST");
	select.options[select.options.length] = new Option( "PROJ", "PROJ");
	select.options[select.options.length] = new Option("PWR", "PWR");
	select.options[select.options.length] = new Option( "OPTI", "OPTI");
    }

    if(str == "3"){
	select.options[select.options.length] = new Option("Module", "");
	select.options[select.options.length] = new Option("Tous", "");
	select.options[select.options.length] = new Option( "ASE", "ASE");
	select.options[select.options.length] = new Option("IAC","IAC");
	select.options[select.options.length] = new Option("IGL", "IGL");
	select.options[select.options.length] = new Option("IPS", "IPS");
	select.options[select.options.length] = new Option( "IPF", "IPF");
	select.options[select.options.length] = new Option("LSF-VVL", "LSF-VVL");
	select.options[select.options.length] = new Option( "MAD", "MAD");
	select.options[select.options.length] = new Option("MICRO","MICRO");
	select.options[select.options.length] = new Option("MRO", "MRO");
	select.options[select.options.length] = new Option("MRR", "MRR");
	select.options[select.options.length] = new Option( "PAP", "PAP");
	select.options[select.options.length] = new Option("PIMA","PIMA");
	select.options[select.options.length] = new Option("PP", "PP");
	select.options[select.options.length] = new Option("PST", "PST");
	select.options[select.options.length] = new Option( "SE1", "SE1");
	select.options[select.options.length] = new Option( "SRM", "SRM");

    }

    if(str == "4"){
	select.options[select.options.length] = new Option("Module", "");
	select.options[select.options.length] = new Option("Tous", "");
	select.options[select.options.length] = new Option("ANEDP","ANEDP");
	select.options[select.options.length] = new Option("ANU", "ANU");
	select.options[select.options.length] = new Option("ARMA", "ARMA");
	select.options[select.options.length] = new Option( "ASN", "ASN");
	select.options[select.options.length] = new Option("AUTO", "AUTO");
	select.options[select.options.length] = new Option( "CAL", "CAL");
	select.options[select.options.length] = new Option("CC","CC");
	select.options[select.options.length] = new Option("CORO", "CORO");
	select.options[select.options.length] = new Option("IA", "IA");
	select.options[select.options.length] = new Option( "IMF", "IMF");
	select.options[select.options.length] = new Option("IRA", "IRA");
	select.options[select.options.length] = new Option( "LC", "LC");
	select.options[select.options.length] = new Option("LOA","LOA");
	select.options[select.options.length] = new Option("MCS", "MCS");
	select.options[select.options.length] = new Option("MESIM", "MESIM");
	select.options[select.options.length] = new Option( "MFDLS", "MFDLS");
	select.options[select.options.length] = new Option("MOST", "MOST");
	select.options[select.options.length] = new Option( "PBT", "PBT");
	select.options[select.options.length] = new Option("PRB","PRB");
	select.options[select.options.length] = new Option("PRR", "PRR");
	select.options[select.options.length] = new Option("PSA", "PSA");
	select.options[select.options.length] = new Option( "RDH", "RDH");
	select.options[select.options.length] = new Option("RIAL", "RIAL");
	select.options[select.options.length] = new Option( "RVIG", "RVIG");
	select.options[select.options.length] = new Option("SE2","SE2");
	select.options[select.options.length] = new Option("SFP", "SFP");
	select.options[select.options.length] = new Option("SIP", "SIP");
	select.options[select.options.length] = new Option( "SSI", "SSI");
    }

    if(str == "5"){
	select.options[select.options.length] = new Option("Module", "");
	select.options[select.options.length] = new Option("Tous", "");
	select.options[select.options.length] = new Option("AEBI","AEBI");
	select.options[select.options.length] = new Option("GPA", "GPA");
	select.options[select.options.length] = new Option("ISA", "ISA");
	select.options[select.options.length] = new Option( "MAL", "MAL");
	select.options[select.options.length] = new Option("MAF", "MAF");
	select.options[select.options.length] = new Option( "MQF", "MQF");
	select.options[select.options.length] = new Option("MSA","MSA");
	select.options[select.options.length] = new Option("NTOE", "NTOE");
	select.options[select.options.length] = new Option("OPTI", "OPTI");
	select.options[select.options.length] = new Option( "PMGD", "PMGD");
	select.options[select.options.length] = new Option("PROG", "PROG");
	select.options[select.options.length] = new Option( "RESO", "RESO");
	select.options[select.options.length] = new Option("SEC","SEC");
	select.options[select.options.length] = new Option("WIA", "WIA");
	select.options[select.options.length] = new Option("SIBD", "SIBD");
    }

    select.options[0].disabled = true;
}
