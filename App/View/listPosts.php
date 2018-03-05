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
        <?php if ($page == 1): ?>
        <li class="page-item disabled">
            <a href="/posts/<?= $page - 1 ?>" class="page-link" tabindex="-1">Precedent</a>
        </li>
        <?php else: ?>
        <li class="page-item">
            <a href="/posts/<?= $page - 1 ?>" class="page-link">Precedent</a>
        </li>
        <?php endif; ?>
        <?php for ($i = 1; $i < $pagesTotal + 1; $i++): ?>
            <?php if ($i == $page): ?>
                <li class="page-item active">
                    <a href="/posts/<?= $i ?>" class="page-link"><?= $i ?></a>
                </li>
            <?php else: ?>
                <li class="page-item">
                    <a href="/posts/<?= $i ?>" class="page-link"><?= $i ?></a>
                </li>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($page == $pagesTotal): ?>
        <li class="page-item disabled">
            <a href="/posts/<?= $page + 1 ?>" class="page-link" tabindex="-1">Suivant</a>
        </li>
        <?php else: ?>
        <li class="page-item">
            <a href="/posts/<?= $page + 1 ?>" class="page-link">Suivant</a>
        </li>
        <?php endif; ?>
    </ul>
</nav>

<?php 
$content = ob_get_clean();
require('template.php');
?>
