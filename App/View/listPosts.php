<?php 
$title = 'blog';
ob_start(); 
?>

<?php
foreach ($posts as $post):
?>
    <article class="post mb-4 p-4 bg-light">
        <header class="post-header">
            <a href="/post/<?= $post->getId() ?>">
                <h3 class="post-heading">
                    <?= $post->getTitle() ?>
                </h3>
            </a>
            <p class="font-italic">Le <?= $post->getDateAdded() ?></p>
        </header>
        <div class="post-content">
            <?= $post->getContent() ?>
        </div>
        <footer class="post-footer d-flex justify-content-end">
            <a href="/post/<?= $post->getId() ?>">Lire la suite</a> 
        </footer>
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
