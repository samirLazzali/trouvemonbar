

<!-- todo : les champs sont entièrement sélectionnés au 1er focus
            Les valeurs par défaut sont écrites en grisé
            le formulaire est centré
            le formulaire est correctement mis en forme en utilisant les classes bootstrap
            faire de meme pour suscrive_view.php -->


<div class="container-fluid justify-content-center">
    <h2> Se connecter à votre compte Guiilde </h2>
    <p> Ou <a href="subscribe.php"> créer votre compte </a> </p>

    <form class="" action="actions/authentication_action.php" method="post">
        <input type="email" name="email" value="Email"/> </br>
        <input type="password" name="password" value="Password"/> </br>
        <input class="btn bg-success text-white" type="submit" value="Se connecter"/>
    </form>
</div>
