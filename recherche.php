<?php
session_start();

?>


<html>
<head> <title> Recherche dans l'inventaire </title></head>
<link rel="stylesheet" href="recherche.css" type="text/css">
<header style="border: 2px solid black;margin: auto;padding: 3px;text-align: right;">
<img src="books.jpg" alt="books" style="height:50px; float:left">
<p style="float:left;"> Local 31<p>
 <nav>
    <ul style="list-style-type : none">
    <li style="display:inline;padding: 0 2em;"><a href="deconnexion.php">Déconnexion</a></li>
	<li style="display:inline;padding: 0 2em;"> <a href="profil.php">Mon profil</a></li>
    </ul>
	
 </nav>
</header>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<h1> Recherche<?php echo " de ".$_SESSION['login'] ?></h1>

<div class="formulaire">
<h2>Qu'est-ce-que tu cherches ?</h2>

<div class="clearfix">
  <div class="img">
    <img src="etagere.jpg" alt="etagere" style="width:100%; height:400px;">
  </div>
  <div class="img">
    <img src="librairie2.jpg" alt="Livre" style="width:100%; height:400px;">
  </div>
  <div class="img">
    <img src="etagere.jpg" alt="etagere" style="width:100%; height:400px;">
  </div>
</div>



 <div style="margin:0 auto;width:50%;text-align:left">


<form method="get" action="library.php">

<table class = "forml">
<tr>
<td>Titre :</td> 
<td>
<input type="text" size="40" name="titre"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>Auteur :</td> 
<td>
<input type="text" size="40" name="auteur"/></td>
</tr></table>
<table class = "forml">
<tr>
<td>Dessinateur :</td> 
<td>
<input type="text" size="35" name="dessinateur"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>S&eacute;rie :</td> 
<td>
<input type="text" size="40" name="serie"/></td>
</tr></table>


<table class = "forml">
<tr>
<td>Num&eacute;ro de tome :</td> 
<td>
<input type="text" size="3" name="tome"/></td>
</tr></table>
</div>


<p>Vous pouvez s&eacute;lectionner plusieurs &eacute;lements en maintenant la touche Ctrl enfonc&eacute;</p>




    <div style="margin:0 auto;width:30%;text-align:left">

<table>
<tr><th>     Type     </th><th>     Langue     </th><th>   Tags   </th></tr>
<tr><td>
 <select multiple="true" name="type[]"  size="10">
                                  <option value="roman"  >Roman</option>
                                  <option value="bd"  >BD</option>
                                  <option value="manga"  >Manga</option>
                              </select>
</td>
<td>

 <select name="langue[]" multiple="true" size="10">
                                  <option value="francais"  >Fran&ccedil;ais</option>
                                  <option value="anglais"  >Anglais</option>
                                  <option value="japonais"  >Japonais</option>
                                  <option value="autre"  >Autre</option>
                              </select>
</td>
<td>
 <select name="groupe[]" multiple="true" size="10">
                                  <option value="action"  >Action</option>
                                  <option value="anticipation"  >Anticipation</option>
                                  <option value="aventure"  >Aventure</option>
                                  <option value="biographie"  >Biographie</option>
                                  <option value="classique"  >Classique</option>
                                  <option value="contre Utopie"  >Contre Utopie</option>
                                  <option value="erotique"  >Erotique</option>
                                  <option value="espionnage"  >Espionnage</option>
                                  <option value="fantastique"  >Fantastique</option>
                                  <option value="fantasy"  >Fantasy</option>
                                  <option value="historique"  >Historique</option>
                                  <option value="horreur"  >Horreur</option>
                                  <option value="humouristique"  >Humouristique</option>
                                  <option value="nouvelle"  >Nouvelle</option>
                                  <option value="policier" >Policier</option>
                                  <option value="science-Fiction"  >Science Fiction</option>
                                  <option value="sentimental"  >Sentimental</option>
                                  <option value="space Opera"  >Space Opera</option>
                                  <option value="utopie"  >Utopie</option>
                
                              </select>
</td>
</tr>
</table>
</div>
<br>
<tr>
      <td colspan="2">
        <input type="submit" value="Rechercher" name="rechercher" />
      </td>
    </tr>
  </table>
</form>
</br></br></br>

</div>
 
</body></html>


