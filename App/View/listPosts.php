<?php 
$title = 'blog';
ob_start(); 
?>

<?php
foreach ($posts as $post):
?>
    <article class="post">
        <header class="post-header">
            <a href="/post/<?= $post->getId() ?>">
                <h3 class="post-heading">
                    <?= $post->getTitle() ?>
                </h3>
            </a>
        </header>
        <?= $post->getContent() ?>
    </article>
<?php
endforeach;
?>

<nav>
    <ul class="pagination">
        <?= $paginator->previous() ?>
        <?= $paginator->pages() ?>
        <?= $paginator->next() ?>
    </ul>
</nav>

<?php 
$content = ob_get_clean();
require('template.php');
?>
