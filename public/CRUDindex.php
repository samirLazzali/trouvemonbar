<?php

include ("config.php");
include("vue.php");
global $db;
page_accueil();


echo "   <!DOCTYPE html>

    <html lang='fr'>

    <head>

        <meta charset='UTF-8'>

        <title>Tableau de bord</title>

        <link rel=\"stylesheet\" href=\"style.css\"/>

        <style type='text/css'>

            .wrapper{

                width: 650px;

                margin: 0 auto;

            }

            .page-header h2{

                margin-top: 0;

            }

            table tr td:last-child a{

                margin-right: 15px;

            }

        </style>

        <script type='text/javascript'>

            $(document).ready(function(){
                $('[data-toggle=\'tooltip\']').tooltip();   

            });

        </script>

    </head>

    <body>

        <div class='wrapper'>

            <div class='container-fluid'>

                <div class='row'>

                    <div class='col-md-12'>

                        <div class='page-header clearfix'>

                            <h2 class='pull-left'>Détails des élèves</h2>

                            <a href='create.php' class='btn btn-success pull-right'>Ajouter un nouvel élève</a>

                        </div>";

                        // Attempt select query execution

                        $sql = "SELECT * FROM Eleve";

                        if($result = $db->query($sql)){

                            if($result->rowCount() > 0){

                                echo "<table class='table table-bordered table-striped'>";

                                    echo "<thead>";

                                        echo "<tr>";

                                            echo "<th>Email</th>";

                                            echo "<th>Nom</th>";

                                            echo "<th>Prénom</th>";

                                            echo "<th>Mot de passe</th>";

                                            echo "<th>Pseudo</th>";

                                            echo "<th>Promotion</th>";

                                            echo "<th>Téléphone</th>";

                                            echo "<th>Administrateur</th>";

                                            echo "<th>Action</th>";

                                        echo "</tr>";

                                    echo "</thead>";

                                    echo "<tbody>";

                                    while($row = $result->fetch()){

                                        echo "<tr>";

                                            echo "<td>" . $row['mail'] . "</td>";

                                            echo "<td>" . $row['nom'] . "</td>";

                                            echo "<td>" . $row['prenom'] . "</td>";

                                            echo "<td>" . $row['mdp'] . "</td>";

                                            echo "<td>" . $row['pseudo'] . "</td>";

                                            echo "<td>" . $row['promo'] . "</td>";

                                            echo "<td>" . $row['telephone'] . "</td>";

                                            echo "<td>" . $row['admin'] . "</td>";


                                        echo "<td>";

                                                echo "<a href='read.php?mail=". $row['mail'] ."' title='View Record' data-toggle='tooltip'><img src='index.png' alt='Afficher'></a>";

                                                echo "<a href='update.php?mail=". $row['mail'] ."' title='Update Record' data-toggle='tooltip'><img src='le-pinceau_318-9145.png alt='Modifier'></a>";

                                                echo "<a href='delete.php?mail=". $row['mail'] ."' title='Delete Record' data-toggle='tooltip'><img src='trash-can_38501.png alt='Supprimer'></a>";

                                            echo "</td>";

                                        echo "</tr>";

                                    }

                                    echo "</tbody>";                            

                                echo "</table>";

                                // Free result set

                                unset($result);

                            } else{

                                echo "<p class='lead'><em>Aucune donnée n'a été trouvé</em></p>";

                            }

                        } else{

                            echo "ERROR: Could not able to execute $sql. " ;

                        }

                        

                        // Close connection

                        unset($bd);

                        echo "
                    </div>

                </div>        

            </div>

        </div>

    </body>

    </html>";

