<?php
/**
 * Contient des fonctions d'affichage en HTML et de conversion (ex : entre date et représentation humaine).
 */

/**
 * Convertit un timestamp en date lisible.
 * @param int $t le timestamp à convertir.
 * @return str la date convertie.
 */
function timestamp_to_string($t)
{
    return date("d/m/Y H:i  ", $t);
}

function formatter_nombre($n, $mot, $feminin = false)
{
    $eFinal = $feminin ? "e" : "";
    if ($n == 0)
        return "Aucun$eFinal $mot";
    elseif ($n == 1)
        return "Un$eFinal $mot";
    else
        return "$n $mot" . "s";
}

function affichePost($post, $show_actions = true, $text_after_name = "", $text_before_name = "")
{
    $author = $post->getAuthor();
    $user = $author ->getUsername();
    $content = $post->toHtml();
    $date = timestamp_to_string($post->getTimestamp());
    $id = $post->getID();
    ?>
    <div class="post-in-feed">
        <div class="post-header">
            <?= $text_before_name ?>
            <a href="/profile/<?= $user ?>" class="post-header-author" title="Se rendre sur le profil de l'auteur.">
                <?= $user ?>
            </a> <?= $text_after_name ?>
            <span class="post-header-date" title="Permalien">
                <a href="/post/<?= $id ?>">
                    <?= $date ?>
                </a>
            </span>
        </div>

        <div class="post-content">
            <?=$content?>
        </div>

        <?php
            if ($show_actions):
        ?>
        <div class="post-actions">
            <span class="post-action">
                <a onClick="likePost('<?=$id?>');" href="#" class="action-like-<?=$id?> action-link" title="J'aime cette publication">
                     <?= formatter_nombre($post->getLikeCount(), "like"); ?>
                </a>
            </span>
            <span class="post-action">
                <a onClick="dislikePost('<?=$id?>');" href="#" class="action-dislike-<?=$id?> action-link" title="Je n'aime pas cette publication.">
                    <?= formatter_nombre($post->getDislikeCount(), "dislike"); ?>
                </a>
            </span>
            <span class="post-action">
                <a onClick="repost('<?=$id?>');"  href="#" class="action-repost-<?=$id?> action-link" title="Republier ce contenu">
                    <?= formatter_nombre($post->getRepostCount(), "recyclage"); ?>
                </a>
            </span>
            <span class="post-action">
                <a onClick="toggleBlock('Response-div-<?=$id?>');"  href="#" class="action-respond-<?=$id?> action-link" title="Répondre à cette publication">
                    Riposter
                </a>
            </span>
            <span class="post-action">
                <a onClick="toggleBlock('report-form-<?=$id?>');"  href="#" class="action-report-<?=$id?> action-link action-link-report" title="Cette publication pose un problème ?">
                    Signaler
                </a>
            </span>
        </div>
        <div style="display: none" class="report-form-wrapper" id="report-form-<?=$id?>">
            <form onSubmit="return reportPost('<?=$id?>')" class="report-form">
                <input type="text" id="report-reason-<?=$id?>" class="report-field" placeholder="Raison du signalement">
                <button type="submit" class="report-submit" title="Confirmer le signalement">
                    Signaler
                </button>
            </form>
        </div>
        <div style="display: none" class="response-form-wrapper" id="Response-div-<?=$id?>">
            <div onBlur="respondPost_onBlur('<?=$id?>')" class="response-field" onFocus="respondPost_onFocus('<?=$id?>')" id="respond-post-<?=$id?>" contenteditable="true">
                  Réponse...
            </div>
            <button class="fas fa-paper-plane response-submit" type="submit" onClick="verifyAndSendResponse('<?=$id?>');" title="Envouer la réponse">

            </button>
        </div>
        <?php
            endif
        ?>
    </div>
    <?php
}

function afficheRepost($repost, $text_after = null) {
    $original = $repost->getOriginalPost();
    $date = timestamp_to_string($repost->getTimestamp());
    $author = $repost->getAuthor()->getUsername();
    if ($text_after == null)
        $text_after = " a retweeté"
    ?>
    <div class="post-in-feed">
        <div class="post-header">
            <a href="/profile/<?=$author?>" class="post-header-author">
                <?=$author?>
            </a>
            <span class="notification-reposted-you"><?= $text_after ?></span>
            <span class="post-header-date"><?=$date?></span>
        </div>

        <div class="post-content">
            <?php affichePost($original, false); ?>
        </div>
        <div class="post-actions">
            <span class="post-action">
                <a onClick="repost('<?=$original->getID()?>');"  href="#" class="action-repost-<?=$original->getID()?> action-link" title="Je souhaite republier ce contenu.">
                    <?= formatter_nombre($original->getRepostCount(), "recyclage"); ?>
                </a>
            </span>
            <span class="post-actions">

            </span>
        </div>
    </div>
    <?php
}