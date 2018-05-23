<?php

if(isset($_GET["mail"]) && !empty(trim($_GET["mail"]))){

    // Include config file

include("config.php");
global $db;


    // Prepare a select statement

    $sql = "SELECT * FROM Eleve WHERE mail = :mail";



    if($stmt = $db->prepare($sql)){

        // Bind variables to the prepared statement as parameters

        $stmt->bindParam(':mail', $param_mail);



        // Set parameters

        $param_mail = trim($_GET["mail"]);



        // Attempt to execute the prepared statement

        if($stmt->execute()){

            if($stmt->rowCount() == 1){

                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */

                $row = $stmt->fetch(PDO::FETCH_ASSOC);



                // Retrieve individual field value

                $mail = $row["mail"];

                $nom = $row["nom"];

                $prenom = $row["prenom"];

                $mdp = $row["mdp"];

                $pseudo = $row["pseudo"];

                $promo = $row["promo"];

                $telephone = $row["telephone"];

                $admin = $row["admin"];


            } else{

                // URL doesn't contain valid id parameter. Redirect to error page

                header("location: error.php");

                exit();

            }



        } else{

            echo "Oops! Il y a eu une erreur. Veuillez recommencer plus tard.";

        }

    }



    // Close statement

    unset($stmt);



    // Close connection

    unset($db);

} else{

    // URL doesn't contain id parameter. Redirect to error page

    header("location: error.php");

    exit();

}


echo '
<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Voir un enregistrement</title>

    <link rel=\"stylesheet\" href=\"style.css\"/>

    <style type="text/css">

        .wrapper{

            width: 500px;

            margin: 0 auto;

        }

    </style>

</head>

<body>

<div class="wrapper">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <div class="page-header">

                    <h1>Voir enregistrement</h1>

                </div>

                <div class="form-group">

                    <label>Mail</label></br>

                    <p class=\'form-control-static\'>'.$row['mail'].'</p></br>

                </div>

                <div class="form-group">

                    <label>Nom</label></br>

                    <p class="form-control-static">'.$row["nom"].'</p></br>

                </div>

                <div class="form-group">

                    <label>Prénom</label></br>

                    <p class="form-control-static">'.$row["prenom"].'</p></br>

                </div>
                
                 <div class="form-group">

                    <label>Mot de passe</label></br>

                    <p class="form-control-static">'.$row['mdp'].'</p></br>

                </div>
                
                 <div class="form-group">

                    <label>Pseudo</label></br>

                    <p class="form-control-static">'.$row["pseudo"].'</p></br>

                </div>
                
                 <div class="form-group">

                    <label>Promo</label>

                    <p class="form-control-static">'.$row["promo"].'</p>

                </div>
                
                 <div class="form-group">

                    <label>Téléphone</label></br>

                    <p class="form-control-static">'.$row["telephone"].'</p></br>

                </div>
                
                 <div class="form-group">

                    <label>Administrateur</label></br>

                    <p class="form-control-static">'.$row["admin"].'</p></br>

                </div>

                <p><a href="CRUDindex.php" class="btn btn-primary">Retour</a></p></br>

            </div>

        </div>

    </div>

</div>

</body>

</html>';