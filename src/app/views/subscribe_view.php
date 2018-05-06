


<!-- todo : les champs sont entièrement sélectionnés au 1er focus
            Les valeurs par défaut sont écrites en grisé
            le formulaire est centré
            le formulaire est correctement mis en forme en utilisant les classes bootstrap
            faire de meme pour authentication_view.php
             Modèle : https://trello.com/login
     todo : add password and nickname strength check with js (password strenght, nickname length)
     todo : add mail and nick uniqueness check  with jquery
     -->


<div class="container-fluid justify-content-center">
<h2> Créer un compte Guiilde </h2>
<p> Ou <a href="authentication.php"> se connecter à votre compte </a> </p>

<form action="actions/subscribe_action.php" method="post">
    <input type="email" name="mail" placeholder="Email"/> </br>
    <input type="text" name="nick" placeholder="Pseudo"/> </br>
    <input type="password" name="password" placeholder="Password"/> </br>
    <input class="btn bg-success text-white" type="submit" name="Créer un nouveau compte" value="Créer un nouveau compte"/>
</form>
</div>