<?php
/**
 * Emprunt
 *
 * PHP Version 7.0
 *
 * @category Emprunt
 * @package  Public
 * @author   Eric COLONIA <ercol@outlook.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost:8080/emprunt.php
 */
require "identite.php";

/*include("connexion.php");*/
if (isset($_POST['Recherche'])) {
    $req="Select serie from media where serie='$_POST[Recherche]'; ";
        global $connection;
        $exe=new Execute($connection);
    $rows=$exe->exec_sql($req);
    if (sizeof($rows)==0) {
        echo "<script> 
				window.location.replace('index.php?Nope')
</script>";
        exit;
        
    } else {
        echo "<script>
		   	
			window.location.replace('emprunt.php?titre=$_POST[Recherche]')
</script>";
        exit;
         
    }
}
$source='https://fonts.googleapis.com/css?family=';

?>

<html>
<head>
    <meta charset="utf-8"/>
    <link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">
<link href="<?php echo $source; ?>Exo" rel="stylesheet"/>

    <link rel="stylesheet" href="emprunt.css">
</head>
<body>
<a href="index.php">
<img style="max-width : 200px;"src="logo_text.png" alt="baka"/>
</a>
<?php
if ($_SESSION['login']==$visiteur || $admin!=1) {
    echo"<div class='Nonconnected'>";
    echo "<center><div class='bann'> Attention!  
		</div></center>";
    echo "<div class='Connect'>";    
    echo utf8_decode("Il faut etre avec un admin pour emprunter un manga");
    echo "</br>";
    echo utf8_decode("<a href='pageconnexion.php'> Se connecter </a>");
    echo "</div>";
    echo "</div>";
    echo "<center><img src='Pics_transparent/Irefuse.png' alt='Nope' /></center>";
    /*header('location : pageconnexion.php?Nonconnected');*/
} else {
    if (isset($_POST['pseudo']) && isset($_POST['1tome'])  
        && isset($_POST['code']) && isset($_POST['2tome'])
    ) {
        global $connection;
        $exe=new Execute($connection);

        $req="Select pseudo from Membre_emprunt where pseudo='$_POST[pseudo]'; ";
        
        $rows=$exe->exec_sql($req);
        if (sizeof($rows) == 0) {
            echo "<script> 
				window.location.replace('emprunt.php?titre=$_SESSION[titre]')
</script>";
            exit;
        }
        $i=$_POST['1tome'];
        if ($_POST['1tome'] > $_POST['2tome']) {
            $i=$_POST['2tome'];
            $_POST['2tome']=$_POST['1tome'];
        }

        echo $_SESSION['titre'].' '.$i;
        $code=$_POST['code'].$i;
        $req="select code from media where code='$code'";
        $rows=$exe->exec_sql($req);
        if (sizeof($rows) == 0) {
            echo "<script> 
				window.location.replace('emprunt.php?titre=$_SESSION[titre]')
</script>";
            exit;
        }
        $req="UPDATE media SET dispoOuiNon ='non' Where code='$code';";
        $exe->exec_sql($req);
        $req="Select id from membre_emprunt where pseudo='$_POST[pseudo]'; ";
        $rows=$exe->exec_sql($req);
        foreach($rows as $row):
        endforeach;
        $req="UPDATE media SET dernEmprunteur='$row->id' where code='$code';" ;
        $exe->exec_sql($req);
        $i++;
        while ($i <= $_POST['2tome']) {
            $code=$_POST['code'].$i;
            $req="select code from media where code='$code'";
            $rows=$exe->exec_sql($req);
            if(sizeof($rows) == 0) {
                echo "<script> 
				window.location.replace('emprunt.php?titre=$_SESSION[titre]')
</script>";
                      exit;
            }

            $req="UPDATE media SET dispoOuiNon ='Non' Where code='$code' ;";
            $exe->exec_sql($req);
            $req="Select id from Membre_emprunt where pseudo='$_POST[pseudo]'; ";
            $rows=$exe->exec_sql($req);
            $req="UPDATE media SET dernEmprunteur='$row->id' where code='$code'; ";
            $exe->exec_sql($req);
            $i++;
        }
        echo "<script> window.location.replace('index.php?emprunt')</script>";
        /*
        header("location : index.php?Emprunt");
        exit;
        */
    } else {
        global $connection;
        $exe= new Execute($connection);
        $requete="Select code from media where serie='$_GET[titre]'";
        $rows=$exe->exec_sql($requete);
        foreach($rows as $row):
            $code=$row->code;
        endforeach;
        echo"<p>Vous désirez emprunter le manga ";    
        echo $_GET['titre'];
        echo "? </p>";
        echo "<p> Le code est $code</p> ";
        $_SESSION['titre']=$_GET['titre'];
    ?>

   <div class="emprunter">
   Veuillez renseigner les informations suivantes pour emprunter ce manga :
   </br>
   <form action="emprunt.php" method="post" name="emprunt" id="form" >
   <p>Pseudo de l'emprunteur : </p> 
   <input type="text" name="pseudo" placeholder="Pseudo" />
<p> Code :</p>
   <input type="text" name="code" placeholder="Code" />
 <p></p><p> Du tome
<input type="text" name="1tome" onkeyup="this.value=this.value.replace(/\D/g,'')"placeholder="N° tome"/> 
 jusqu'au tome
<input type="text" name="2tome" onkeyup="this.value=this.value.replace(/\D/g,'')"  placeholder="N° tome"/>
</p>
<p style="font-size : 12px;">
(si vous n'empruntez qu'un seul tome entrez le même chiffre)
</p>
   <p></p>
   <input type="submit" value="Emprunter"/>

   </form>

   </div>
    <?php
    $req="Select titre from media where serie='$_SESSION[titre]' 
			and dispoOuiNon='oui';";
     $rows=$exe->exec_sql($req);
     echo "Voici les tomes diponibles :";
    foreach($rows as $row):
        echo"</br>";
        echo $row->titre;
    endforeach;
        
    } 
}?>
</body>
</html>
