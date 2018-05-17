<h2>Profil de <?php echo htmlspecialchars($user->firstname,$user->lastname); ?></h2>


    <span class="label_profil">Pseudo</span> : <?php echo $user->nick; ?><br/>
    <span class="label_profil">Adresse email</span> : <?php echo htmlspecialchars($user->mail); ?><br />
</p>
