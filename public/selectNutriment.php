<?php

require __DIR__ . '/library.php';

// Start Session
session_start();



// check user login
if(empty($_SESSION['user_id'])){
	header("Location: index.php");
}

$app = new Library();

$user = $app->UserDetails($_SESSION['user_id']); // get user details

//$user = $app->UserDetails($_SESSION['user_id']); // get user details

if(isset($_POST['btnReset'])){
	unset($_SESSION['nutrimentList']);
}

if(!isset($_SESSION['nutrimentList'])){
	$_SESSION['nutrimentList'] = $app->getNutrimentList([]);
	$_SESSION['userNutrimentList'] = [];
	$nbAlim = count($_SESSION['nutrimentList']);
}
if(!isset($nbAlim) || !isset($nbNutri)){
	$nbAlim = $app->getCountAliments();
	$nbNutri = $app->getCountNutriments();
}

for($i=0; $i<count($_SESSION['userNutrimentList']); $i++){
	if(isset($_POST["del$i"])){
		$_SESSION['nutrimentList'][] = $_SESSION['userNutrimentList'][$i];
		unset($_SESSION['userNutrimentList'][$i]);
		$_SESSION['userNutrimentList']=array_values($_SESSION['userNutrimentList']);
	}
}

if(isset($_POST['btnAdd'])){
	$_SESSION['userNutrimentList'][] = $_POST['nutriment'];
	$_SESSION['nutrimentList'] = $app->getNutrimentList($_SESSION['userNutrimentList']);
}

function printList($T){ // T le tableau, $type selon si la liste est sans ordre (0) ou avec(1)
	echo "<form method=POST action=selectNutriment.php>";
	for($i=0; $i<count($T); $i++){
		echo "<label> $T[$i] : </label><br/>";
		printDeleteButton($i);
	}
	if(count($T)>0){
		echo '<center><input type="submit" name="btnCal" class="btn btn-primary" value="Calculer" /><br/></center>';
	}
	echo "</form>";
}

function printDeleteButton($id){
	if(!isset($_POST["slider$id"])){
		$_POST["slider$id"] = 0.5;
	}
	echo "<input type='submit' class=\"btn btn-fill\"  name='del".$id."' value='Supprimer'/>";
	echo "<input type='range' name='slider".$id."' min='0' max='1' step='0.01' value='".$_POST["slider$id"]."' /><br/>";
}

function getScore(){
	$score = 0;	
	for($i=0; $i<count($_SESSION['userNutrimentList']); $i++){
		$score = $score + $_POST["slider$i"];
	}
								
	return $score;
}

if(isset($_POST['btnCal'])){
	for($i=0; $i<$nbNutri; $i++){
		$coeff[] = 0;
	}
	for($i=0; $i<count($_SESSION['userNutrimentList']); $i++){
		if(isset($_POST["slider$i"])){
			$coeff[$app->getNutri_id($_SESSION['userNutrimentList'][$i])-1] = $_POST["slider$i"];
		}
	}
	$nutriScoreList = $app->getNutriScore($coeff);
	arsort($nutriScoreList);
}

//echo $app->getNutri_id($_SESSION['userNutrimentList'][1])-1;

//printL($_SESSION['userNutrimentList']);

function printAlimentList($T){
	$app = new Library();	
	echo "<ul class=\"list-group\">";
	for($i=0; $i<count($T); $i++){
		echo "<li class=\"list-group-item\">";
		echo key($T)." : <br/>";
		echo "Nutri-score : ".$T[key($T)]."</li>";
		next($T);
	}
	echo "</ul>";
}

?>

	<!DOCTYPE HTML>
		<html lang="fr">

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

                <li class="">
                    <a href="profile.php">
                        <i class="ti-plus"></i>
                        <p>Profil Utilisateur</p>
                    </a>
                </li>
                <li class="active">
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
                                <h4 class="title">Calculer votre Nutriscore et generer un menu adapté</h4>
                            </div>
                            <div class="content">

                                <!-- form begin -->
  							<?php
							printList($_SESSION['userNutrimentList'], 1);
							?>
							<form method = "POST" action = "selectNutriment.php">
								<select class="custom-select" name='nutriment'>
								
								<?php
								for($i = 0; $i < count($_SESSION['nutrimentList']); $i++){ ?>
								
									<option value="<?php echo 
                                    $_SESSION['nutrimentList'][$i]; ?>">
									<?php echo $_SESSION['nutrimentList'][$i]; ?>
									</option>
									
								<?php } ?>
								
                                <input type="submit" name="btnAdd" class="btn btn-fill" value="Ajouter" />
								
								<div class="content">
								<?php
								if(isset($_POST['btnCal'])){
									printAlimentList($nutriScoreList);
								}
								?>
                                    </div>
                            
							    </select>
							       <div class="content">
							 <button type="submit" name="btnReset" class=" btn btn-primary btn-block" value="Reset" >RESET</button>
                                </div>

					
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