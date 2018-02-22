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

<?php
foreach ($comments as $comment):
?>
    <article class="comment">
        <header class="comment-header">
            <h4 class="comment-heading">
                <?= $comment->getAuthor() ?> 
            </h4>
        </header>
        <?= $comment->getContent() ?>
    </article>
<?php
endforeach;
?>

<form action="index.php?action=addComment&id=<?= $post->getId() ?>" method="post" class="comment-form">
    <input type="text" name="author" id="author">
    <textarea name="content" id="content" cols="30" rows="10"></textarea>
    <input type="submit" value="Envoyer">
</form>

<?php 
$content = ob_get_clean();
require('template.php');
?>
