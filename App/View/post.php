<?php 
$title = 'blog';
ob_start(); 
?>

<article class="post--single">
    <header class="post-header">
        <h3 class="post-heading">
            <?= $post->getTitle() ?>
        </h3>
    </header>
    <?= $post->getContent() ?>
</article>

<section>
    <h4>Commentaires</h4>
    <?php
    foreach ($comments as $comment):
    ?>
        <article class="comment">
            <header class="comment-header">
                <h4 class="comment-heading">
                    <?= htmlspecialchars($comment->getAuthor()) ?> 
                </h4>
            </header>
            <?= nl2br(htmlspecialchars($comment->getContent())) ?>
            <a href="/flagComment/<?= $comment->getId() ?>">Signaler</a>
        </article>
    <?php
    endforeach;
    ?>

    <h4>Ajouter un commentaire</h4>
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

<?php 
$content = ob_get_clean();
require('template.php');
?>
