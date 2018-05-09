<?php
/**
 * Un menu temporaire à mettre en haut des pages.
 */

$menu = true;

$menu_user = getUserFromCookie();
if ($menu_user == null)
    $loggedin = false;
else
    $loggedin = true;

?>

<?php if ($menu): ?>
    <menu class="menu">
        <?php if (!$loggedin): ?>
            <a class="menu-item" href="/login">Connexion</a>
            <a class="menu-item" href="/signup">Inscription</a>
        <?php endif ?>
        <a class="menu-item" href="/feed">Derniers</a>
        <a class="menu-item" href="/trends">Tendances</a>
        <a class="menu-item" href="/profile/Oxymore">Profil</a>
        <a class="menu-item" href="/account">Compte</a>

        <?php if ($loggedin && $menu_user->getModerator()): ?>
            <a class="menu-item" href="/moderation">Modération</a>
        <?php endif ?>
    </menu>
<?php endif ?>
