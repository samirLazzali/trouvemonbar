<div id="form_border">
   <ul class="tab-group">
   <li class="nature <?php print (isset($annonce) && $annonce->isOffer?"active":"none"); ?>"><a href=#offer>Offre</a>
      <li class="nature <?php print (isset($annonce) && $annonce->isOffer?"none":"active"); ?>"><a href=#query>Recherche</a>
   </ul>
   <ul class=tab-group>
      <li class="tab active"><a href=#money>Argent</a>
      <li class=tab><a href=#service>Service</a>
      <li class=tab><a href=#free>Gratuit</a>
   </ul>
   <form name=annonce class=create method=post action=<?php print (isset($annonce)?"edit.php?edit=$annonce->id":"create.php"); ?>>
      <div class=tab-content>
         <div id=money>
            <div class=field-wrap><label>Prix proposé</label>
		<input type=number name=annoncepayamount <?php print (isset($annonce)?"value=\"$annonce->paiement\"":"");?>>
            </div>
         </div>
         <div id=service>
            <div class=field-wrap><label>Service proposé</label>
               <input name=annonceswapnature <?php print (isset($annonce)?"value=\"$annonce->service\"":"");?>>
            </div>
         </div>
      </div>
      <div class=field-wrap><label>Titre de l'annonce<span class=req>*</span></label>
         <input name=annoncetitle required <?php print (isset($annonce)?"value=\"$annonce->title\"":"");?>>
      </div>
      <div class=field-wrap><label>Mots clé<span class=req>*</span></label>
         <input name=annoncegenre required <?php print (isset($annonce)?"value=\"$annonce->genre\"":"");?>>
      </div>
      <div class=field-wrap><label class=big>Description<span class=req>*</span></label>
         <textarea name=annoncedesc cols=30 rows=3 maxlength=240 required><?php print (isset($annonce)?$annonce->content:"");?></textarea>
      </div>
      <input type="radio" class="radio" name="offer" id="isoffer" value="true">
      <div class=smselect>
         <select name=annoncesemester class=styled-select black rounded>
	 <option value disabled <?php print (isset($annonce)?"":"selected"); ?>>Semestre
            <option value=1 class=toggle <?php print (isset($annonce) && $annonce->semestre == 1?"selected":""); ?>>S1
            <option value=2 class=toggle <?php print (isset($annonce) && $annonce->semestre == 2?"selected":""); ?>>S2
            <option value=3 class=toggle <?php print (isset($annonce) && $annonce->semestre == 3?"selected":""); ?>>S3
            <option value=4 class=toggle <?php print (isset($annonce) && $annonce->semestre == 4?"selected":""); ?>>S4
            <option value=5 class=toggle <?php print (isset($annonce) && $annonce->semestre == 5?"selected":""); ?>>S5
         </select>
	 <div class=smodule id=selectmodule1 style=display:<?php print (!(isset($annonce) && $annonce->semestre == 1)?"none":"inline"); ?>>
            <select name=annoncemodule1>
               <option value disabled selected>Module
               <option value=ECO1 <?php print (isset($annonce) && $annonce->module == 'ECO1'?"selected":""); ?>>ECO1
               <option value=IBD <?php print (isset($annonce) && $annonce->module == 'IBD'?"selected":""); ?>>IBD
               <option value=IPI <?php print (isset($annonce) && $annonce->module == 'IPI'?"selected":""); ?>>IPI
               <option value=LVFH1 <?php print (isset($annonce) && $annonce->module == 'LVFH1'?"selected":""); ?>>LVFH1
               <option value=MAN <?php print (isset($annonce) && $annonce->module == 'MAN'?"selected":""); ?>>MAN
               <option value=MCI <?php print (isset($annonce) && $annonce->module == 'MCI'?"selected":""); ?>>MCI
               <option value=MPR <?php print (isset($annonce) && $annonce->module == 'MPR'?"selected":""); ?>>MPR
               <option value=MTG <?php print (isset($annonce) && $annonce->module == 'MTG'?"selected":""); ?>>MTG
               <option value=OSS <?php print (isset($annonce) && $annonce->module == 'OSS'?"selected":""); ?>>OSS
            </select>
         </div>
         <div class=smodule id=selectmodule2 style=display:<?php print (!(isset($annonce) && $annonce->semestre == 2)?"none":"inline");?>>
            <select name=annoncemodule2>
               <option value disabled selected>Module
               <option value=ECO2 <?php print (isset($annonce) && $annonce->module == 'ECO2'?"selected":""); ?>>ECO2
               <option value=ILO <?php print (isset($annonce) && $annonce->module == 'ILO'?"selected":""); ?>>ILO
               <option value=IPFL <?php print (isset($annonce) && $annonce->module == 'IPFL'?"selected":""); ?>>IPFL
               <option value=LVFH2 <?php print (isset($annonce) && $annonce->module == 'LVFH2'?"selected":""); ?>>LVFH2
               <option value=MST <?php print (isset($annonce) && $annonce->module == 'MST'?"selected":""); ?>>MST
               <option value=MTEF <?php print (isset($annonce) && $annonce->module == 'MTEF'?"selected":""); ?>>MTEF
               <option value=OPTI <?php print (isset($annonce) && $annonce->module == 'OPTI'?"selected":""); ?>>OPTI
               <option value=PROJ <?php print (isset($annonce) && $annonce->module == 'PROJ'?"selected":""); ?>>PROJ
               <option value=PWR <?php print (isset($annonce) && $annonce->module == 'PWR'?"selected":""); ?>>PWR
            </select>
         </div>
         <div class=smodule id=selectmodule3 style=display:<?php print (!(isset($annonce) && $annonce->semestre == 3)?"none":"inline");?>>
            <select name=annoncemodule3>
               <option value disabled selected>Module
               <option value=ECO3 <?php print (isset($annonce) && $annonce->module == 'ECO3'?"selected":""); ?>>ECO3
               <option value=ASE <?php print (isset($annonce) && $annonce->module == 'ASE'?"selected":""); ?>>ASE
               <option value=IAC <?php print (isset($annonce) && $annonce->module == 'IAC'?"selected":""); ?>>IAC
               <option value=IGL <?php print (isset($annonce) && $annonce->module == 'IGL'?"selected":""); ?>>IGL
               <option value=IPF <?php print (isset($annonce) && $annonce->module == 'IPF'?"selected":""); ?>>IPF
               <option value=IPS <?php print (isset($annonce) && $annonce->module == 'IPS'?"selected":""); ?>>IPS
               <option value=LSF-VVL <?php print (isset($annonce) && $annonce->module == 'LSF-VVL'?"selected":""); ?>>LSF-VVL
               <option value=LVFH3 <?php print (isset($annonce) && $annonce->module == 'LVFH3'?"selected":""); ?>>LVFH3
               <option value=MICRO-ARCHI <?php print (isset($annonce) && $annonce->module == 'MICRO-ARCHI'?"selected":""); ?>>MICRO-ARCHI
               <option value=MRO <?php print (isset($annonce) && $annonce->module == 'MRO'?"selected":""); ?>>MRO
               <option value=MRR <?php print (isset($annonce) && $annonce->module == 'MRR'?"selected":""); ?>>MRR
               <option value=PIMA <?php print (isset($annonce) && $annonce->module == 'PIMA'?"selected":""); ?>>PAP
               <option value=PST <?php print (isset($annonce) && $annonce->module == 'PST'?"selected":""); ?>>PST
               <option value=SE1 <?php print (isset($annonce) && $annonce->module == 'SE1'?"selected":""); ?>>SE1
               <option value=SRM <?php print (isset($annonce) && $annonce->module == 'SRM'?"selected":""); ?>>SRM
            </select>
         </div>
         <div class=smodule id=selectmodule4 style=display:<?php print (!(isset($annonce) && $annonce->semestre == 4)?"none":"inline");?>>
            <select name=annoncemodule4>
               <option value disabled selected>Module
               <option value=ANEDP <?php print (isset($annonce) && $annonce->module == 'ANEDP'?"selected":""); ?>>ANEDP
               <option value=ANU <?php print (isset($annonce) && $annonce->module == 'ANU'?"selected":""); ?>>ANU
               <option value=ARMA <?php print (isset($annonce) && $annonce->module == 'ARMA'?"selected":""); ?>>ARMA
               <option value=ASN <?php print (isset($annonce) && $annonce->module == 'ASN'?"selected":""); ?>>ASN
               <option value=AUTO <?php print (isset($annonce) && $annonce->module == 'AUTO'?"selected":""); ?>>AUTO
               <option value=CAL <?php print (isset($annonce) && $annonce->module == 'CAL'?"selected":""); ?>>CAL
               <option value=CC <?php print (isset($annonce) && $annonce->module == 'CC'?"selected":""); ?>>CC
               <option value=CORO <?php print (isset($annonce) && $annonce->module == 'CORO'?"selected":""); ?>>CORO
               <option value=ECO4 <?php print (isset($annonce) && $annonce->module == 'ECO4'?"selected":""); ?>>ECO4
               <option value=IA <?php print (isset($annonce) && $annonce->module == 'IA'?"selected":""); ?>>IA
               <option value=IMF <?php print (isset($annonce) && $annonce->module == 'IMF'?"selected":""); ?>>IMF
               <option value=IRA <?php print (isset($annonce) && $annonce->module == 'IRA'?"selected":""); ?>>IRA
               <option value=LC <?php print (isset($annonce) && $annonce->module == 'LC'?"selected":""); ?>>LC
               <option value=LOA <?php print (isset($annonce) && $annonce->module == 'LOA'?"selected":""); ?>>LOA
               <option value=LVFH4 <?php print (isset($annonce) && $annonce->module == 'LVFH4'?"selected":""); ?>>LVFH4
               <option value=MCS <?php print (isset($annonce) && $annonce->module == 'MCS'?"selected":""); ?>>MCS
               <option value=MESIM <?php print (isset($annonce) && $annonce->module == 'MESIM'?"selected":""); ?>>MESIM
               <option value=MFDLS <?php print (isset($annonce) && $annonce->module == 'MFDLS'?"selected":""); ?>>MFDLS
               <option value=MOST <?php print (isset($annonce) && $annonce->module == 'MOST'?"selected":""); ?>>MOST
               <option value=PBT <?php print (isset($annonce) && $annonce->module == 'PBT'?"selected":""); ?>>PBT
               <option value=PRB <?php print (isset($annonce) && $annonce->module == 'PRB'?"selected":""); ?>>PRB
               <option value=PRR <?php print (isset($annonce) && $annonce->module == 'PRR'?"selected":""); ?>>PRR
               <option value=PSA <?php print (isset($annonce) && $annonce->module == 'PSA'?"selected":""); ?>>PSA
               <option value=RDH <?php print (isset($annonce) && $annonce->module == 'RDH'?"selected":""); ?>>RDH
               <option value=RIAL <?php print (isset($annonce) && $annonce->module == 'RIAL'?"selected":""); ?>>RIAL
               <option value=RVIG <?php print (isset($annonce) && $annonce->module == 'RVIG'?"selected":""); ?>>RVIG
               <option value=SE2 <?php print (isset($annonce) && $annonce->module == 'SE2'?"selected":""); ?>>SE2
               <option value=SEC-CEA <?php print (isset($annonce) && $annonce->module == 'SEC-CEA'?"selected":""); ?>>SEC-CEA
               <option value=SFP <?php print (isset($annonce) && $annonce->module == 'SFP'?"selected":""); ?>>SFP
               <option value=SIP1-SIP2 <?php print (isset($annonce) && $annonce->module == 'SIP1-SIP2'?"selected":""); ?>>SIP1-SIP2
               <option value=SSI <?php print (isset($annonce) && $annonce->module == 'SSI'?"selected":""); ?>>SSI
            </select>
         </div>
         <div class=smodule id=selectmodule5 style=display:<?php print (!(isset($annonce) && $annonce->semestre == 5)?"none":"inline");?>>
            <select name=annoncemodule5>
               <option value disabled selected>Module
               <option value=AEBI <?php print (isset($annonce) && $annonce->module == 'AEBI'?"selected":""); ?>>AEBI
               <option value=GPA <?php print (isset($annonce) && $annonce->module == 'GPA'?"selected":""); ?>>GPA
               <option value=ISA <?php print (isset($annonce) && $annonce->module == 'ISA'?"selected":""); ?>>ISA
               <option value=MAF <?php print (isset($annonce) && $annonce->module == 'MAF'?"selected":""); ?>>MAF
               <option value=MAL <?php print (isset($annonce) && $annonce->module == 'MAL'?"selected":""); ?>>MAL
               <option value=MQF <?php print (isset($annonce) && $annonce->module == 'MQF'?"selected":""); ?>>MQF
               <option value=MSA <?php print (isset($annonce) && $annonce->module == 'MSA'?"selected":""); ?>>MSA
               <option value=NTOE <?php print (isset($annonce) && $annonce->module == 'NTOE'?"selected":""); ?>>NTOE
               <option value=OPTI <?php print (isset($annonce) && $annonce->module == 'OPTI'?"selected":""); ?>>OPTI
               <option value=PMGD <?php print (isset($annonce) && $annonce->module == 'PMGD'?"selected":""); ?>>PMGD
               <option value=PROG <?php print (isset($annonce) && $annonce->module == 'PROG'?"selected":""); ?>>PROG
               <option value=RESO <?php print (isset($annonce) && $annonce->module == 'RESO'?"selected":""); ?>>RESO
               <option value=SEC <?php print (isset($annonce) && $annonce->module == 'SEC'?"selected":""); ?>>SEC
               <option value=SIBD <?php print (isset($annonce) && $annonce->module == 'SIBD'?"selected":""); ?>>SIBD
               <option value=WIA <?php print (isset($annonce) && $annonce->module == 'WIA'?"selected":""); ?>>WIA
            </select>
         </div>
      </div>
      <div class=choice><input type=submit name=submit value=<?php print (isset($annonce)?"Modifier":"Poster"); ?>>
         <input type=<?php print (isset($annonce)?"submit":"reset"); ?> name=startover value=Effacer>
      </div>
   </form>
</div>
<script src=http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js></script><script src=js/createForm.js></script>
