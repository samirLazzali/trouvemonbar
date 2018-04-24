<?php
require_once('Post.php');

/**
 * fichier qui contient des fonctions d'affichage en html de truc
 */

//TODO écrire les fonctions javascript pour les actions onclick

function affichePost($post)
{
    $author = $post->getAuthor()->getUsername();
    $content = $post->toHtml();
    $date = $post->getTimestamp();
    ?>
    <div class="post-in-feed">
        <div class="post-header">
            <a href="profile/Oxymore" class="post-header-author">
                <?= $author ?>
            </a>
            <span class="post-header-date">
                <?= $date ?>
            </span>
        </div>
        <div class="post-content">
            <?= $content ?>
        </div>
        <div class="post-actions">
            <span class="post-action">
                <a onclick="like('<?= $post->getID() ?>')" href="#" class="action-link">
                    Like
                </a>
            </span>
            <span class="post-action">
                <a onclick="dislike('<?= $post->getID() ?>')" href="#" class="action-link">
                    Dislike
                </a>
            </span>
            <span class="post-action">
                <a onclick="respondTo('<?= $post->getID() ?>')" href="#" class="action-link">
                    Riposter
                </a>
            </span>
            <span class="post-action">
                <a onclick="repost('<?= $post->getID() ?>')" href="#" class="action-link">
                    <span class="far fa-redo-alt"></span>
                </a>
            </span>
            <span class="post-action">
                <a onclick="report('<?= $post->getID() ?>')" href="#" class="action-link">
                    Signaler
                </a>
            </span>
        </div>
    </div>
    <?php
}