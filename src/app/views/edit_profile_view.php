
pseudo:<?php echo $user->nick?> </br>
e-mail: <?php echo $user->mail?>


<form action="actions/edit_profile_action.php?userid=<?php echo $user->userid?>" method="post">
    nouvel e-mail:<input type="email" name="mail" placeholder="Email"/> </br>
    nouveau mot de passe:<input type="password" name="password" placeholder="Password"/> </br>
    <input class="btn bg-success text-white" type="submit" name="Changer mon profile" value="change mon profile"/>
</form>