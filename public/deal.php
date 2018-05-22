<?php
session_start();
session_unset();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Act.It!</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">



        body{

            font-family: "Lato",sans-serif;
            height: 100%;
            background-color: ghostwhite;
        }
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
            position: fixed;
            top: 0;
            background-color: #f1f1f1;
        }
        .g {
            float: left;
        }
        .d {
            float: right;
        }
        li a {
            display: block;
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
        }

        /* Change the link color on hover */
        li a:hover {
            background-color: #555;
            color: white;
        }
        li a.active {
            background-color: #4CAF50;
            color: white;
        }

        .page_g{
            padding:20px;
            margin-top:35px;
            position: relative;
            font-size: 11em;
            color: ghostwhite;
            text-shadow: 2px 2px 2px  black;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .titre {
            text-align: center;

        }

        #intro {
            background-color: #4CAF50;
            /*background: linear-gradient(ghostwhite, lightgrey);*/
        }


        .first {
            margin:0;
            height: 57em;
            background-color: ghostwhite;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            /*background: linear-gradient(to right, #1483ff, ghostwhite, #1483ff);*/
        }
        .first h1{
            padding: 1.5em;
            color:#4CAF50;
            font-size: 4em;
            text-shadow: 2px 2px 2px  black;



        }
        .first p{
            padding: 1em;
            text-align: center;
            margin-left: 25%;
            margin-right: 25%;
            font-size: 1.2em;
        }

        .footer {
            padding: 20px;
            text-align: center;
            background: #4CAF50;
            margin-top: 20px;
            color: ghostwhite;
            font-size: 1.2em;
        }
        .bouton{
            text-align: center;
            background: linear-gradient(to right, ghostwhite,lightgrey, ghostwhite,lightgrey,ghostwhite) ;


        }

        .column {
            text-align: center;
            box-sizing: border-box;
            float: left;
            width: 50%;
            padding: 15px;
            background: linear-gradient(to right, lightgrey,ghostwhite, lightgrey);

        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
            }

            /* Style inputs */
            input[type=text], select, textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                margin-top: 6px;
                margin-bottom: 16px;
                resize: vertical;
            }

            input[type=submit],#but {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                cursor: pointer;
            }

            input[type=submit]:hover {
                background-color: #45a049;
            }


            /* Style the container/contact section */
            .container {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 10px;
            }

    </style>
</head>
<!--common-->

<body>
<div>
    <ul>
        <li class = "g"><a href="index.php#accueil">Accueil</a></li>
        <li class = "g"><a href="index.php#Recherche">Recherche</a></li>
        <li class = "g"><a href="index.php#contact">Contact</a></li>
        <li class = "g"><a class="active" href="index.php#about">Nous</a></li>
    </ul>

</div>
<?php

//    some operation to sql

    	$dbName = getenv('DB_NAME');
    	$dbUser = getenv('DB_USER');
    	$dbPassword = getenv('DB_PASSWORD');
//    $dbName="postgres";
//    $dbUser="postgres";
//    $dbPassword='123456';
//    var_dump($_SESSION['now']);
//    print_r($_SESSION['now']);
    if(isset($_SESSION['now'])){

            $now = $_SESSION['now'];
            $_SESSION['now'] = $now + 1;
            $now = -1;
        if ($now < count($_SESSION['r'])) {
            echo '
            <div class="row" style="margin-top: 100px">
                
                    <div class="column" style="height: 300px;">
                    <span style="text-shadow: 5px 5px 10px  black; font-size:4em; color: #1ad53a; font-weight: bold;">Restaurant:<br>
                    ' . $_SESSION["r"][$now]['rn'] .
                '</span>' .
//                    <br>
//                    <span style="text-shadow: 1px 1px 1px  black; font-size:1em; color: #1ad53a; ">
//                    ' .$_SESSION["r"][$now]['rd'].
//               '</span>
                '</div>
              <div class="column" style="height: 300px;">
               <span style="text-shadow: 5px 5px 10px  black; font-size:3em; color: #1ad53a; font-weight: bold;">Activity:<br>
                    ' . $_SESSION["r"][$now]['an'] .
                '</span><span style="text-shadow: 1px 1px 1px  black; font-size:2em; color: #1ad53a; font-weight: bold;"><br>description:<br>
                    ' .
                $_SESSION["r"][$now]['ad'] .
                '               
               </div>
              
                
            </div>
             <div style=\'text-align: center\'>
             <form action="" method="post">
           <input type="submit" value="see more" style=\'background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                cursor: pointer;
                margin-top: 40px\'/>
                </form>
        </div>
            ';
        }else{
            echo "<div style='margin-top: 100px; background: linear-gradient(to right, ghostwhite,lightgrey, ghostwhite,lightgrey,ghostwhite) ;
height: 50%;text-align: center'>
            <span style=\"text-shadow: 10px 10px 10px  black; font-size:8em; color: #1ad53a; font-weight: bold;\">end of the list</span>

        </div>
        <div style='text-align: center'>
            <a href='index.php'><button style='background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                cursor: pointer;
                margin-top: 40px'>rentrer</button></a>
        </div>
        ";
        }
    }else {
        try {
        $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
//            $connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $sql = "";
            if (!isset($_POST["prix"]) || $_POST["prix"] == "") {
            } else {
                $sql .= ("where  prix_moyen<=" . $_POST["prix"]);
            }

            if (!isset($_POST["nbpers"]) || $_POST["nbpers"] == "") {
            } else {
                $sql .= " and ";
                $sql .= ("nb_personne_min<=" . $_POST["nbpers"] . " and " . "nb_personne_max>=" . $_POST["nbpers"]);
            }

            
 //           if (!isset($_POST["ville"]) || $_POST["ville"] == '') {
 //           } else {
 //               $sql .= " and ";
 //               $sql .= ("ville='" . $_POST["ville"] . "'");
 //           }
//    $sql.="and";
//            if (!isset($_POST["heure"]) || $_POST["heure"] == "" || $_POST["heure"] == "indifferent") {
//            } else {
  //              $sql .= " and ";
    //            $sql .= "plage_horaire=";
      //          if ($_POST["heure"] == "journee") {
        //            $sql .= "'journée'";
          //      } else {
            //        $sql .= "'soir'";
              //  }
            //}

            if (!isset($_POST["type_act"]) || $_POST["type_act"] == '') {
            } else {
                if ($_POST["type_act"] == 'culturelle') {
                    $cul = true;
                } elseif ($_POST["type_act"] == 'sportive') {
                    $cul = false;
                }
            }
            echo '<br><br>';
            echo $cul;

            if (!$cul) {
                $res = $connection->query("select Restaurant.nom rn, Restaurant.description rd ,Activite_sportive.nom an, Activite_sportive.description ad from Entreprise  NATURAL JOIN Restaurant   JOIN Activite_sportive  using(id_ent) " . $sql);

            } else {
                
                $res = $connection->query("select Restaurant.nom rn, Restaurant.description rd, Activite_culturelle.nom an, Activite_culturelle.description ad from Entreprise  NATURAL JOIN Restaurant   JOIN Activite_culturelle  using(id_ent)  " . $sql);

//        echo "select * from Entreprise NATURAL JOIN Restaurant NATURAL JOIN Activite_sportive ".$sql;
            }
//    echo "aaa".$res;
            $r = $res->fetchAll();
            $len = count($r);
//    var_dump($r);
            // echo $len;
            if ($len == 0) {
                echo "<div style='margin-top: 100px; background: linear-gradient(to right, ghostwhite,lightgrey, ghostwhite,lightgrey,ghostwhite) ;
height: 50%;text-align: center'>
            <span style=\"text-shadow: 10px 10px 10px  black; font-size:8em; color: #1ad53a; font-weight: bold;\">sorry we find nothing</span>

        </div>
        <div style='text-align: center'>
            <a href='index.php'><button style='background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                cursor: pointer;
                margin-top: 40px'>rentrer</button></a>
        </div>
        ";
            } else {
//        echo "hehe";
//        echo "<span style='font-size: 10em '>hehe";
//        $r=$res->fetchAll();
                $now = 0;
                if (!isset($_SESSION['now'])) {
                    $now = 0;
                    $_SESSION['r'] = $r;
                    $_SESSION['now'] = 1;
                } else {
                    $now = $_SESSION['now'];
                    $_SESSION['now'] = $now + 1;
                }
//        var_dump($r);
                if ($now < count($r)) {
                    echo '
            <div class="row" style="margin-top: 100px">
                
                    <div class="column" style="height: 600px;">
                    <span style="text-shadow: 5px 5px 10px  black; font-size:4em; color: #1ad53a; font-weight: bold;">Restaurant:<br>
                    ' . $_SESSION["r"][$now]['rn'] .'</span>' .'
        
                    
                  <br>
                    <span style="text-shadow: 1px 1px 1px  black; font-size:1em; color: #1ad53a; ">
                   ' .$_SESSION["r"][$now]['rd'].
              '</span>'.
                        '</div>
              <div class="column" style="height: 300px;">
               <span style="text-shadow: 5px 5px 10px  black; font-size:3em; color: #1ad53a; font-weight: bold;">Activity:<br>
                    ' . $_SESSION["r"][$now]['an'] .
                        '</span><span style="text-shadow: 1px 1px 1px  black; font-size:2em; color: #1ad53a; font-weight: bold;"><br>description:<br>
                    ' .
                        $_SESSION["r"][$now]['ad'] .
                        '</span>'.   '          
               </div>
              
                
            </div>
             <div style=\'text-align: center\'>
             <form action="" method="post">
           <input type="submit" value="see more" style=\'background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                cursor: pointer;
                margin-top: 40px\'/>
                </form>
        </div>
            ';
                }
            }


        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

?>


</body>

</html>