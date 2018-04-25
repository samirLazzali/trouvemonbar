<?php
include '../src/login/login.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="generator" content=
  "HTML Tidy for HTML5 for Linux version 5.6.0">
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href=
  'https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600'
  rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href=
  "https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <button class="button button-block" id="connect">Connect</button>
  <div id="form" class="form" style="display: none;">
    <ul class="tab-group">
      <li class="tab active">
        <a href="#login">Log In</a>
      </li>
      <li class="tab">
        <a href="#signup">Sign Up</a>
      </li>
    </ul>
    <div class="tab-content">
      <div id="login">
        <h1>Welcome Back!</h1>
        <!-- <form action="status.php" method="post"> -->
        <form action="" method="post">
          <div class="field-wrap">
            <label>Email Address<span class="req">*</span></label>
            <input type="email" name="email" required=""
            autocomplete="off">
          </div>
          <div class="field-wrap">
            <label>Password<span class="req">*</span></label>
            <input type="password" name="password" required=""
            autocomplete="off">
          </div>
          <p class="forgot"><a href="#">Forgot
          Password?</a></p><span class=
          "errorDisp"><?php echo "Error: $error"; ?></span> <button class=
          "button button-block" name="login">Log In</button>
          <!-- <input name="submit" type="submit" value=" Log In"> -->
        </form>
      </div>
      <div id="signup">
        <h1>Sign Up for Free</h1>
        <form action="" method="post">
          <div class="field-wrap">
            <label>Email Address<span class="req">*</span></label>
            <input type="email" name="email" required=""
            autocomplete="off">
          </div>
          <div class="field-wrap">
            <label>Username</label> <input type="text" name=
            "username" autocomplete="off">
          </div>
          <div class="field-wrap">
            <label>Set A Password<span class="req">*</span></label>
            <input type="password" name="password" required=""
            autocomplete="off">
          </div><span class="errorDisp"><?php echo "Error: $error"; ?></span>
          <button type="signup" class="button button-block" name=
          "signup">Get Started</button>
        </form>
      </div>
    </div><!-- tab-content -->
  </div><!-- /form -->
  <script src=
  'http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  
  <script src="js/index.js"></script>
</body>
</html>
