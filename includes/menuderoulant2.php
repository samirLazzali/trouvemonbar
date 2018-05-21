<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/template.css">
    <script>
        function affiche(x) {
            var elt = document.getElementById(x);
            if(elt.style.display=="none") {
                elt.style.display = "block";
            }
            else {
                elt.style.display="none";
            }
        }
    </script>
</head>
<body>
<button onclick="affiche('menu')"><img class="affichemenu" src="img/menu.png" alt="img menu deroulant"></button>
<ul id="menu">
    <li class="optionmenu">
        <a href="index.php">Home</a>
    </li>
    <li class="optionmenu">
        <a href="./login.php">Connexion</a>
    </li>
    <li class="optionmenu">
        <a href="./register.php">Inscription</a>
    </li>
</ul>
</body>