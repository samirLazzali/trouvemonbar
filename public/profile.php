<?php
require __DIR__ . '/library.php';
// Start Session
session_start();

// check user login
if(empty($_SESSION['user_id']))
{
    header("Location: index.php");
}

$app = new Library();

$user = $app->UserDetails($_SESSION['user_id']); // get user details

include('changeUsername.php');
include('changeEmail.php');
include('changeName.php');
include('setInformation.php');
include('delAccount.php');




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

    <title>Profil utilisateur</title>

    <meta content='width=device-width initial-scale=1' name='viewport' />
    <meta name="viewport" content="width=device-width initial-scale=1 maximum-scale=1" />

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
                <li>
                    <a href="admin.php">
                        <i class="ti-panel"></i>
                        <p>Admin Dashboard</p>
                    </a>
                </li>
                <?php endif; ?>

                <li class="active">
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
                    <a class="navbar-brand" href="#">Profil de <?php echo $user->name ?></a>
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
                                <h4 class="title">Modifier votre profil</h4>
                            </div>
                            <div class="content">

                                <!-- form begin -->
                                <form action="profile.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <!-- change Username -->
                                            <div class="form-group">
                                                <?php $app->alertMessage($changed_username, $change_error_message_username, "Nom utilisateur")?>
                                                <label>Nom utilisateur</label>
                                                <input type="text" name="newUsername" class="form-control border-input" placeholder="Issouuuuu" value=<?php if($changed_username){echo "$newUser" ;}else{echo "$user->username";}?> >
                                            </div>
                                        </div>


                                        <div class="col-md-5">
                                            <!-- change email -->
                                            <div class="form-group">
                                                <?php $app->alertMessage($changed_email, $change_error_message_email, "email")?>
                                                <label for="exampleInputEmail1">Addresse Mail </label>
                                                <input type="email" name="newEmail" class="form-control border-input" placeholder="Email" value=<?php if($changed_email){echo "$newEmail" ;}else{echo "$user->email";}?> >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php $app->alertMessage($changed_name, $change_error_message_name, "Nom")?>
                                                <label>Nom complet</label>
                                                <input type="text" name="newName" class="form-control border-input" placeholder="johan chagnon" value=<?php if($changed_name){echo "$newName" ;}else{echo "$user->name";}?>>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?php $app->alertMessage($changed_address, $change_error_message_address, "Adresse")?>
                                                <label>Addresse</label>
                                                <input type="text" name="newAddress" class="form-control border-input" placeholder="8 avenue de la licorne enchantée" value=<?php if($changed_address){echo "$newAddress" ;}else{echo "$user->address";}?>>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Ville</label>
                                                <?php $app->alertMessage($changed_city, $change_error_message_city, "Ville")?>
                                                <input type="text" name="newCity" class="form-control border-input" placeholder="EVRY" value=<?php if($changed_city){echo "$newCity" ;}else{echo "$user->city";}?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pays</label>
                                                <?php $app->alertMessage($changed_country, $change_error_message_country, "Pays")?>
                                                <input type="text" name="newCountry" class="form-control border-input" placeholder="Pays Merveilleux" value=<?php if($changed_country){echo "$newCountry" ;}else{echo "$user->country";}?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php $app->alertMessage($changed_zip, $change_error_message_zip, "Code Postal")?>
                                                <label>Code Postal</label>
                                                <input type="number" name="newZip" class="form-control border-input" placeholder="42 420" value=<?php if($changed_zip){echo "$newZip" ;}else{echo "$user->zip";}?>>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?php $app->alertMessage($changed_bio, $change_error_message_bio, "Biographie")?>
                                                <label>Petite Bio</label>
                                                <textarea rows="9" name="newBio" class="form-control border-input"
                                                          placeholder="Si tu lis ceci, tu vas nous danser la danse du limousin, le limousin à dis met moi 20 au projet WEB"><?php if($changed_bio){echo "$newBio" ;}else{echo "$user->bio";}?>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"name="saveAllChange" class="btn btn-fill">Sauvegarder</button>
                                        
                                        <button type="submit" name="btnDelete" class="btn btn-fill-dangerous" value="Oui">Supprimer</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>


                                <!-- form end -->
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
<script src="js/dashboard.js"></script>


</html>
