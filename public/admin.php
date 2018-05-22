<?php
require __DIR__ . '/library.php';
// Start Session
session_start();

// check user login
if(empty($_SESSION['user_id']))
{
    header("Location: index.php");
}

if($_SESSION['role'] != 'admin'){
    header("Location: index.php");
}


$app = new Library();

$user = $app->UserDetails($_SESSION['user_id']); // get user details

include('changeUsername.php');
include('changeEmail.php');
include('changeName.php');
include('setInformation.php');

if(!isset($changedName)){
    $changedName = false;
}

if(!isset($name_error_message)){
    $name_error_message = "";
}

if(isset($_POST['btnSubmit'])){
    $changedName = false;

    if($_POST['newName']==""){
        $name_error_message = "Veuillez renseigner un nom";
    }
    else if ($app->isAliment($_POST['newName'])) {
        $name_error_message = "L'aliment est déjà répertorié";
    }
    else{
        if(isset($_POST['newProteine'])){
            $newProteine = $_POST['newProteine'];
        }
        else{
            $newProteine = 0;
        }

        if(isset($_POST['newGlucide'])){
            $newGlucide = $_POST['newGlucide'];
        }
        else{
            $newGlucide = 0;
        }

        if(isset($_POST['newLipide'])){
            $newLipide = $_POST['newLipide'];
        }
        else{
            $newLipide = 0;
        }

        if(isset($_POST['newEnergie'])){
            $newEnergie = $_POST['newEnergie'];
        }
        else{
            $newEnergie = 0;
        }

        if(isset($_POST['newFibre'])){
            $newFibre = $_POST['newFibre'];
        }
        else{
            $newFibre = 0;
        }

        $app->addAlim($newName, $newProteine, $newGlucide, $newGlucide, $newEnergie, $newFibre);
        $changedName = true;
    }
}

?>
<!doctype html>
<html lang="fr">

<?php
$title = "Profil";
?>

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="lorem_favicon.jpg">
    <link rel="icon" type="image/png" sizes="96x96" href="lorem_favicon.jpg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Admin Dashboard</title>

    <meta content='width=device-width initial-scale=1' name='viewport' />
    <meta name="viewport" content="width=device-width initial-scale=1 maximum-scale=1" />


    <!-- Bootstrap core CSS     -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard.css" />
    <link rel="stylesheet" href="css/themify-icons.css" >
</head>

<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="black" data-active-color="info">

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text">
                    <h4>HEALTHCARE</h4>
                </a>
            </div>

            <ul class="nav">

                <?php if($_SESSION['role'] == 'admin'): ?>
                    <li class="active" >

                        <a href="admin.php">
                            <i class="ti-panel"></i>
                            <p>Admin Dashboard</p>
                        </a>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="profile.php">
                        <i class="ti-plus"></i>
                        <p>Profil Utilisateur</p>
                    </a>
                </li>

                <li>
                    <a href="selectNutriment.php">
                     <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
            </ul>
            
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="selectNutriment.php">
                                <i class="ti-panel"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="ti-settings"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-10">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Ajouter un aliment</h4>
                                    <div class="content">

                                <form action="admin.php" method="POST">
                                    <?php $app->alertMessage($changedName, $name_error_message, "Nouvel aliment")?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nom de l'aliment</label>
                                                <input type="text" name="newName" class="form-control border-input" placeholder="Ex : Carotte">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Taux de Protéines</label>
                                                <input type="number" name="newProteine" class="form-control border-input" placeholder="mg/100g" min="0" max="100" step="0.001">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Taux de Glucides</label>
                                                <input type="number" name="newGlucide" class="form-control border-input" placeholder="mg/100g" min="0" max="100" step="0.001">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Taux de Lipides</label>
                                                <input type="number" name="newLipide" class="form-control border-input" placeholder="mg/100g" min="0" max="100" step="0.001">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Taux de Fibres</label>
                                                <input type="number" name="newFibre" class="form-control border-input" placeholder="mg/100g" min="0" max="100" step="0.001">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Énergie</label>
                                                <input type="number" name="newEnergie" class="form-control border-input" placeholder="kcal" min="0" step="0.001">
                                            </div>
                                        </div>
                                    </div>
                                    <center>
                                        <button type="submit" name="btnSubmit" class="btn btn-fill">VALIDER</button>
                                    </center>

                                </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.js"></script>

<script src="js/dashboard.js" type="text/javascript"></script>

</html>