<?php 
$title = 'blog';
?>

<?php
foreach ($posts as $post):
?>
    <article class="post mb-4 p-md-4 bg-white border">
        <header class="post__header p-2 border-bottom">
            <a href="/post/<?= $post->getId() ?>">
                <h3 class="post__heading">
                    <?= $post->getTitle() ?>
                </h3>
            </a>
            <p class="font-italic">Le <?= $post->getDateAdded() ?></p>
        </header>
        <div class="post__content p-3">
            <?= $post->excerpt(400) ?>
        </div>
        <footer class="post__footer d-flex justify-content-end">
            <a href="/post/<?= $post->getId() ?>" class="post__read-more border px-4 py-2">Lire la suite</a> 
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
