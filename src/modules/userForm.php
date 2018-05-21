        <div class="annonce create" id="form_border">
            <form action="editUser.php" method="post">
            <input type="number" name="id" style="display: none;" value="<?php print $user->id; ?>">
            <div class="field-wrap">
                <label class="active">
                    Surnom<span class="req">*</span>
                </label>
                <input type="text" name="username" required autocomplete="off" value="<?php print $user->username; ?>">
            </div>
            <div class="field-wrap">
                <label class="active">
                    Email<span class="req">*</span>
                </label>
                <input type="email" name="email" required autocomplete="off" value="<?php print $user->email; ?>">
            </div>
            <div class="field-wrap">
                <label>
                    Nouveau mot de passe<span class="req">*</span>
                </label>
                <input type="password" name="p1" autocomplete="off" value="">
            </div>
            <div class="field-wrap">
                <label>
                    Répéter le mot de passe<span class="req">*</span>
                </label>
                <input type="password" name="p2" autocomplete="off" value="">
            </div>
	    <span class="choice"><input type="submit" name="submit" value="Modifier"><?php print ($adminView == true && !$user->admin?"<input type=\"submit\" name=\"makeAdmin\" value=\"Rendre Admin\">":""); ?></span>
            </form>
        </div>
    <script src=js/perso.js></script>
