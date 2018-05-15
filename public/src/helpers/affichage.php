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

//TODO écrire les fonctions javascript pour les actions onclick => à faire dans un fichier JS, pas ici !

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
            <a href="/profile/<?= $user ?>" class="post-header-author">
                <?= $user ?>
            </a> <?= $text_after_name ?>
            <span class="post-header-date">
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
                            <a onClick="likePost('<?=$id?>');" href="#" class="action-like-<?=$id?> action-link">Like</a>
                        </span>
            <span class="post-action">
                            <a onClick="dislikePost('<?=$id?>');" href="#" class="action-dislike-<?=$id?> action-link">Dislike</a>
                        </span>
            <span class="post-action">
                            <a onClick="repost('<?=$id?>');"  href="#" class="action-repost-<?=$id?> action-link">Recycler</a>
                        </span>
            <span class="post-action">
                            <a onClick="toggleBlock('Response-div-<?=$id?>');"  href="#" class="action-respond-<?=$id?> action-link">Riposter</a>
                        </span>
            <span class="post-action">
                            <a onClick="toggleBlock('report-form-<?=$id?>');"  href="#" class="action-report-<?=$id?> action-link">Signaler</a>
                        </span>
        </div>
        <div style="display: none" class="report-form-wrapper" id="report-form-<?=$id?>">
            <form onSubmit="return reportPost('<?=$id?>')" class="report-form">
                <input type="text" id="report-reason-<?=$id?>" class="report-field" placeholder="Raison du signalement">
                <button type="submit" class="report-submit">
                    Signaler
                </button>
            </form>
        </div>
        <div style="display: none" id="Response-div-<?=$id?>">
            <div class="new-post-wrapper">
                <div onBlur="respondPost_onBlur('<?=$id?>')" onFocus="respondPost_onFocus('<?=$id?>')" id="respond-post-<?=$id?>" contenteditable="true">
                      Réponse .....
                </div>
            </div>
            <button class="fas fa-paper-plane button-send" type="submit" onClick="SendResponse('<?=$id?>');">
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
    </div>
    <?php
}