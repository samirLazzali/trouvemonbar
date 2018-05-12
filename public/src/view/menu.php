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
        <a class="menu-item" href="/feed">Fil</a>
        <a class="menu-item" href="/latest">Derniers</a>
        <a class="menu-item" href="/trends">Tendances</a>
        <a class="menu-item" href="/profile/<?=$menu_user->getUsername()?>">Profil</a>
        <a class="menu-item" href="/account">Compte</a>
        <a class="menu-item" href="/notifications">Notifications</a>

        <?php if ($loggedin && $menu_user->getModerator()): ?>
            <a class="menu-item" href="/moderation">Modération</a>
        <?php endif ?>

        <?php if ($loggedin): ?>
            <a class="menu-item" href="/logout">Déconnexion</a>
        <?php endif ?>
    </menu>
<?php endif ?>
