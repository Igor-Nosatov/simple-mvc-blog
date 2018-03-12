<?php 
$title = $post->getTitle();
?>

<article class="post--single bg-white p-4 mb-4">
    <header class="post-header pb-2">
        <h3 class="post-heading">
            <?= $post->getTitle() ?>
        </h3>
    </header>
    <?= $post->getContent() ?>
</article>

<section class="comments bg-white p-4">
    <h4>Commentaires</h4>
    <?php if (empty($comments)): ?>
    <p>Soyez le premier à poster un commentaire.</p>
    <?php endif; ?>

    <?php foreach ($comments as $comment): ?>
        <article class="comment p-2 mb-2">
            <header class="comment__header d-flex justify-content-between">
                <h5 class="comment__heading">
                    <?= htmlspecialchars($comment->getAuthor()) ?> 
                </h5>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle text-muted bg-white border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/flagComment/<?= $comment->getId() ?>">Signaler</a>
                    </div>
                </div>
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
