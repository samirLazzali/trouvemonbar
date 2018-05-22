<?php

// Start Session
session_start();

// Application library ( with Library class )
require __DIR__ . '/library.php'; // Ce situe dans le meme dossier que index.php
$app = new Library();
$login_error_message = '';
$register_error_message = '';


// check Login request
if (!empty($_POST['btnLogin'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $_SESSION['username'] = $username; // set Session

    if ($username == "") {
        $login_error_message = 'Username field is required!';
    } else if ($password == "") {
        $login_error_message = 'Password field is required!';
    } else {
        $user_id = $app->Login($username, $password); // check user login
        $role = $app->getRole($user_id);
        $_SESSION['role'] = $role;

        if($user_id > 0 AND $role == 'member')
        {
            $_SESSION['user_id'] = $user_id; // Set Session
            header("Location: profile.php"); // Redirect user to the profile.php

        }

        if($user_id > 0 AND $role == 'admin')
        {
            $_SESSION['user_id'] = $user_id; // Set Session
            header("Location: admin.php"); // Redirect user to the profile.php
        }


        else
        {
            $login_error_message = 'Invalid login details!';
        }
    }
}


?>
<!doctype html>
<html lang="fr">

<?php
$title = "Login | Register";
include("head.php");
?>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>

<body class="body--black">

<?php include('navMenu.php') ?>


<section class="hp-head cc-video">
    <div class="hp-head__copy cc-2">


    <h4>Login</h4>
        <div class="form-wrap form-wrap__horizontal cc-hp w-form">
        <?php
        if ($login_error_message != "") {
        echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $login_error_message . '</div>';
            }
        ?>

    <form action="login.php" method="post">
        <div class="form-group">
            <label for="">Username/Email</label>
            <input type="text" name="username" class="form-control" />
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control" />
        </div>
        <div class="form-group">
            <input type="submit" name="btnLogin" class="btn btn-primary" value="Login" />
        </div>
    </form>
    
        </div>
    </div>
</section>

</body>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</html>