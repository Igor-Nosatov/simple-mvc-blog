<?php 
$title = $post->getTitle();
?>

<article class="post--single bg-light p-4 mb-4">
    <header class="post-header">
        <h3 class="post-heading">
            <?= $post->getTitle() ?>
        </h3>
    </header>
    <?= $post->getContent() ?>
</article>

<section class="bg-light p-4">
    <h4>Commentaires</h5>

    <?php foreach ($comments as $comment): ?>
        <article class="comment p-2 mb-2">
            <header class="comment-header">
                <h5 class="comment-heading">
                    <?= htmlspecialchars($comment->getAuthor()) ?> 
                </h5>
            </header>
            <?= nl2br(htmlspecialchars($comment->getContent())) ?>
            <a href="/flagComment/<?= $comment->getId() ?>">Signaler</a>
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
