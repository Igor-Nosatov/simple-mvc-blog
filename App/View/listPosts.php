<?php 
$title = 'blog';
ob_start(); 
?>

<?php
foreach ($posts as $post):
?>
    <article class="post">
        <header class="post-header">
            <h3 class="post-heading">
                <?= $post->getTitle() ?>
            </h3>
        </header>
        <?= $post->getContent() ?>
    </article>
<?php
endforeach;
?>

<?php 
$content = ob_get_clean();
require('template.php');
?>
