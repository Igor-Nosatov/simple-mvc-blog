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

<?php 
$content = ob_get_clean();
require('template.php');
?>
