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
            <a class="menu-item" href="/login" title="Se connecter">Connexion</a>
            <a class="menu-item" href="/signup" title="S'inscrire">Inscription</a>
        <?php endif ?>
        <a class="menu-item" href="/latest" title="Toutes les publications">Derniers</a>
        <?php if ($loggedin): ?>
            <a class="menu-item" href="/feed" title="Mon fil d'actualité">Fil</a>
            <a class="menu-item" href="/trends" title="Tendances dans les publications">Tendances</a>
            <a class="menu-item" href="/profile/<?=$menu_user->getUsername()?>" title="Mon profil">Profil</a>
            <a class="menu-item" href="/account" title="Modifier les paramètres de compte">Compte</a>
            <a class="menu-item" href="/notifications" title="Mes notifications">Notifications</a>
        <?php endif ?>
        <?php if ($loggedin && $menu_user->getModerator()): ?>
            <a class="menu-item" href="/moderation" title="Afficher et résoudre les signalements">Modération</a>
        <?php endif ?>
        <?php if($loggedin): ?>
            <a class="menu-item" href="/logout" title="Se déconnecter">Déconnexion</a>
        <?php endif; ?>
    </menu>
<?php endif ?>
