<?php

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style-connexion.css"/>
    <title>Ensemble des produits</title>';
//<form name="Panier" action="Creation_Panier.php" method="post">';


echo '<script>

function postRequest(url, callback, args={}) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (!callback[xhr.status]) {
                console.log("Une erreur non géré a eu lieu: " + xhr.response + " (code d\\\'erreur " + xhr.status + ")", 0);
            } else {
                callback[xhr.status](xhr.response);
            }
        }
    }

    var formData = new FormData();
    for (var argName in args) {
        formData.append(argName, args[argName]);
    }

    xhr.send(formData);
}

function post_en_url(url, u, v, x) {
    
//Création dynamique du formulaire
var form = document.createElement("form");
form.setAttribute("method", "POST");
form.setAttribute("action", url);

//Ajout des paramètres sous forme de champs cachés
var champCache1 = document.createElement("input");
champCache1.setAttribute("type", "hidden");
champCache1.setAttribute("name", "id_produit");
champCache1.setAttribute("value", u);
form.appendChild(champCache1);

var champCache2 = document.createElement("input");
champCache2.setAttribute("type", "hidden");
champCache2.setAttribute("name", "id_client");
champCache2.setAttribute("value", v);
form.appendChild(champCache2);

/*var champCache3 = document.createElement("input");
champCache3.setAttribute("type", "hidden");
champCache3.setAttribute("name", "quantite_prise");
champCache3.setAttribute("value", w);
form.appendChild(champCache3);*/

var champCache4 = document.createElement("input");
champCache4.setAttribute("type", "hidden");
champCache4.setAttribute("name", "date");
champCache4.setAttribute("value", x);
form.appendChild(champCache4);


//Ajout du formulaire à la page et soumission du formulaire
document.body.appendChild(form);
form.submit();

}


function Panier(n) { 
    
    //var sessionId = <?php session_start (); echo $_SESSION[\'id\']; ?>;
   

    var id = document.getElementById("liste").rows[n].cells[0].outerHTML.substring(4, 5);

    var u = document.getElementById("liste").rows[n].cells[1].outerHTML;
    
    var t = document.getElementById("liste").rows[n].cells[2].outerHTML;

    var w = document.getElementById("liste").rows[n].cells[3].outerHTML;

    var x = document.getElementById("liste").rows[n].cells[4].outerHTML;
    var xx = document.getElementById("liste").rows[n].cells[4].outerHTML.substring(4, 14);


    var y = document.getElementById("liste").rows[n].cells[5].outerHTML;


    var z = document.getElementById("liste").rows[n].cells[6].outerHTML; 
    var zz = document.getElementById("liste").rows[n].cells[6].outerHTML.substring(4, 5);    

    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", "./Creation_Panier.php");
    
    //Ajout des paramètres sous forme de champs cachés
    form.append(z);
    //form.appendChild(z);
    document.body.appendChild(form);
    form.submit();  
    


    /*postRequest("./Creation_Panier.php",

                {
                    200:     function(response) {
                                console.log("Connecté : " + response);
                            },

                    401:     function(response) {
                                console.log("Non connecté : " + response);
                            }
                },

                {
                    "id_produit": "3",
                    "id_client": "1",
                    "quantite_prise": "3",
                    "date": "2020-05-04"
                }
            )*/
    
    
    post_en_url("./Creation_Panier.php", id, "1", xx);
                    
    var table = document.getElementById("tablepanier");
    var row = table.insertRow(1);
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    var cell3 = row.insertCell(3);
    var cell4 = row.insertCell(4);
    var cell5 = row.insertCell(5);
    cell0.innerHTML = u;
    cell1.innerHTML = t;
    cell2.innerHTML = w;
    cell3.innerHTML = x;
    cell4.innerHTML = y;
    cell5.innerHTML = z;    

} 


function Get_ELEMENT(i, j) {
    
    var q =  (document.getElementById("tablepanier").rows[i].cells[j].outerHTML);
    document.write(q);

}

function Etoile(title, id) {
    
    //Création dynamique du formulaire
    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", "./Etoile.php");
    
    //Ajout des paramètres sous forme de champs cachés
    var champCache1 = document.createElement("input");
    champCache1.setAttribute("type", "hidden");
    champCache1.setAttribute("name", "id_produit");
    champCache1.setAttribute("value", id);
    form.appendChild(champCache1);
    
    //Ajout des paramètres sous forme de champs cachés
    var champCache2 = document.createElement("input");
    champCache2.setAttribute("type", "hidden");
    champCache2.setAttribute("name", "etoile");
    champCache2.setAttribute("value", title);
    form.appendChild(champCache2);
    
    //Ajout du formulaire à la page et soumission du formulaire
    document.body.appendChild(form);
    form.submit();
}

function Quantite(title, id) {
    
    //Création dynamique du formulaire
    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", "./Quantite.php");
    
    //Ajout des paramètres sous forme de champs cachés
    var champCache1 = document.createElement("input");
    champCache1.setAttribute("type", "hidden");
    champCache1.setAttribute("name", "id_produit");
    champCache1.setAttribute("value", id);
    form.appendChild(champCache1);
    
    //Ajout des paramètres sous forme de champs cachés
    var champCache2 = document.createElement("input");
    champCache2.setAttribute("type", "hidden");
    champCache2.setAttribute("name", "quantite");
    champCache2.setAttribute("value", title);
    form.appendChild(champCache2);
    
    //Ajout du formulaire à la page et soumission du formulaire
    document.body.appendChild(form);
    form.submit();
}


</script>';



echo '</head><body>';
echo '<div class = "corps_produits">
<header class = "tete">
    <div class = "logo"><a href="index.php"><img src="../img/logo/logo.png" alt="logo_manger_pas_cher" class="logo"/></a></div>

    <div class = "phrase_accroche"><p class = "phrase_accroche"><a href="index.php" class="phrase_approche">Une autre vision de la consommation </a></p></div>

    <div class = "espace_commercant">
        <div class = "espace_commercants">	
                <a href="index.php" class="espace_commercants"> Retourner à lacceuil </a>
        </div>
    </div>

</header>';
echo '<section class="inscription_produit">';

if (isset($_POST['recherche_produit'])) {
    $recherche_produit = $_POST['recherche_produit'];
    if ($recherche_produit == "De quoi avez vous envie aujourd'hui?") {
        $recherche_produit = "a";
    }
}
else {
    $recherche_produit = "a";
}

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$rep = $connection->query("SELECT id_produit, categorie, marque, prix, date_de_peremption, reduction, quantite, image  FROM Produit WHERE categorie LIKE '%$recherche_produit%' OR marque LIKE '%$recherche_produit%'")->fetchAll();
//$rep = $connection->query("SELECT categorie, marque FROM Produit")->fetch();

$a = 1;


echo '<table class="categorie" id = "liste"><tr class="categorie"><td>Reference</td><td>Image</td><td>Categorie</td><td>Marque</td><td>Prix</td><td>Date de Peremption</td><td>Reduction</td><td>Quantite</td><td></td></tr>';
foreach ($rep as $data)
//while ($data = $rep->fetch())
{
    $q = $data['quantite'];
    $id = $data['id_produit'];
    echo '<tr id='.$a.'>';
    echo '<td>'.$data['id_produit'].'</td>';
    echo '<td><img src='.$data['image'].' alt="photo" height=59 width=89 /></td>';
    echo '<td>'.$data['categorie'].'</td>';
    echo '<td>'.$data['marque'].'</td>';
    echo '<td>'.$data['prix'].'</td>';
    echo '<td>'.$data['date_de_peremption'].'</td>';
    echo '<td>'.$data['reduction'].'</td>';
    /*echo '<td><form>
    <input id="moins" class="quantite" title='.$a.' type="button" value="-" /><!--
    --><input id ="result" class="quantite" title='.$a.' type="texte" value='.$q.' minlength="1" ='.$q.' /><!
    --><input id="plus" class="quantite" title='.$a.' type="button" value="+" />
    </form></td>';*/
    //echo '<td><input type="number"  value='.$q.' min="1" max='.$q.' name="quantite_prise"></td>';
    echo '    <td class="qt"><!--
   --><a class= "notation" href="#6" title="6" onclick="Quantite(this.title, '.$id.')">• </a><!--
   --><a class= "notation" href="#5" title="5" onclick="Quantite(this.title, '.$id.')">• </a><!--
   --><a class= "notation" href="#4" title="4" onclick="Quantite(this.title, '.$id.')">• </a><!--    
   --><a class= "notation" href="#3" title="3" onclick="Quantite(this.title, '.$id.')">• </a><!--
   --><a class= "notation" href="#2" title="2" onclick="Quantite(this.title, '.$id.')">• </a><!--
   --><a class= "notation" href="#1" title="1" onclick="Quantite(this.title, '.$id.')">• </a>
    </td>';
    echo '<td><button type=”button” onclick="Panier('.$a.')">Ajouter au panier</button></td>';
    echo '    <td class="rating"><!--
   --><a class= "notation" href="#5" title="5" onclick="Etoile(this.title, '.$id.')">☆</a><!--
   --><a class= "notation" href="#4" title="4" onclick="Etoile(this.title, '.$id.')">☆</a><!--    
   --><a class= "notation" href="#3" title="3" onclick="Etoile(this.title, '.$id.')">☆</a><!--
   --><a class= "notation" href="#2" title="2" onclick="Etoile(this.title, '.$id.')">☆</a><!--
   --><a class= "notation" href="#1" title="1" onclick="Etoile(this.title, '.$id.')">☆</a>
    </td>';
    echo '</tr>';

    ++$a;
}
echo '</table>';


echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/>';



echo '<br><a href="index.php">Retour</a><br>';
echo '<br><a href="Finaliser_Panier.php">Finaliser le panier</a>';
echo '</section>
</div>';

echo '</body></html>';

?>