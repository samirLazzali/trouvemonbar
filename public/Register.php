<?php

// Start Session
session_start();

// Application library ( with Library class )
require __DIR__ . '/library.php'; // Ce situe dans le meme dossier que index.php
$app = new Library();

$register_error_message = '';

// check Register request
if (!empty($_POST['btnRegister'])) {
    if ($_POST['name'] == "") {
        $register_error_message = 'Name field is required!';
    } else if ($_POST['email'] == "") {
        $register_error_message = 'Email field is required!';
    } else if ($_POST['username'] == "") {
        $register_error_message = 'Username field is required!';
    } else if ($_POST['password'] == "") {
        $register_error_message = 'Password field is required!';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $register_error_message = 'Invalid email address!';
    } else if ($app->isEmail($_POST['email'])) {
        $register_error_message = 'Email is already in use!';
    } else if ($app->isUsername($_POST['username'])) {
        $register_error_message = 'Username is already in use!';
    } else {
        $user_id = $app->Register($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password'], 'member');
        // set session and redirect user to the profile page
        $_SESSION['user_id'] = $user_id;
        header("Location: profile.php");
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


        <div class="hp-head cc-video">
            <div class="hp-head__copy cc-2">

                    <h4>S'inscrire</h4>

                <div class="form-wrap form-wrap__horizontal cc-hp w-form">

                    <?php
                    if ($register_error_message != "") {
                    echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $register_error_message . '</div>';
                     }
                     ?>

                        <form action="Register.php" method="post">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input type="submit" name="btnRegister" class="btn btn-primary" value="Register" />
                            </div>
                        </form>

                </div>
            </div>

        </div>


    </body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </html>
