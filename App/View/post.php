<?php $title = $post->getTitle(); ?>

<article class="post bg-white p-4 mb-4">
    <header class="post__header pb-2">
        <h3 class="post__heading">
            <?= $post->getTitle() ?>
        </h3>
    </header>
    <div class="post__content pb-4">
        <?= $post->getContent() ?>
    </div>
    <footer class="post__footer d-flex">
        <?php if (!is_null($previousPost)) : ?>
            <a href="/post/<?= $previousPost->getId() ?>" class="post__previous mr-auto">
                <i class="fas fa-long-arrow-alt-left mr-1"></i>
                Précédent
            </a> 
        <?php endif; ?>
        <?php if (!is_null($nextPost)) : ?>
            <a href="/post/<?= $nextPost->getId() ?>" class="post__next ml-auto">
                Suivant
                <i class="fas fa-long-arrow-alt-right ml-1"></i>
            </a> 
        <?php endif; ?>
    </footer>
</article>

<section class="comments bg-white p-4">
    <h4>Commentaires</h4>
    <?php if (empty($comments)) : ?>
    <p>Soyez le premier à poster un commentaire.</p>
    <?php endif; ?>

    <?php foreach ($comments as $comment) : ?>
        <article class="comment p-2 mb-2">
            <header class="comment__header d-flex justify-content-between">
                <h5 class="comment__heading">
                    <?= htmlspecialchars($comment->getAuthor()) ?> 
                </h5>
                <?php if (!isset($_SESSION['id'])) : ?>
                    <a href="/flagComment/<?= $comment->getId() ?>" class="comment__action" title="Signaler">
                        <i class="fas fa-ban"></i>
                    </a>
                <?php elseif (isset($_SESSION['id'])) : ?>
                    <a href="/admin/deleteComment/<?= $comment->getId() ?>" class="comment__action" title="Supprimer">
                        <i class="fas fa-trash"></i>
                    </a>
                <?php endif; ?>
            </header>
            <div class="comment__content">
                <?= nl2br(htmlspecialchars($comment->getContent())) ?>
            </div>
            <div class="comment__footer d-flex justify-content-end">
            </div>
        </article>
    <?php endforeach; ?>

    <h4 class="border-top py-3">Ajouter un commentaire</h4>
    <form action="/addComment/<?= $post->getId() ?>" method="post" class="comment-form">
        <div class="form-group">
            <label for="author">Nom</label>
            <input type="text" name="author" id="author" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">Commentaire</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <input type="submit" value="Envoyer" class="btn btn-primary">
    </form>
</section>
