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
$content = ob_get_clean();
require('template.php');
?>
