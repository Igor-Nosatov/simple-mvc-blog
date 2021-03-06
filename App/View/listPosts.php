<?php $title = 'Billet simple pour l\'Alaska'; ?>

<div class="row">
    <div class="col-md-3 mb-4 mb-md-0">
        <aside class="bg-white border side-menu">
            <header class="side-menu__header">
                <h5 class="text-center p-3 bg-light side-menu__heading m-0">
                Tous les chapitres<i class="fas fa-caret-down ml-3 d-initial d-md-none caret"></i>
                </h5>
            </header>
            <div class="side-menu__content">
                <ul class="nav flex-column">
                <?php foreach ($postsAsc as $postAsc) : ?>
                    <li class="nav-item">
                        <a href="/post/<?= $postAsc->getId() ?>" class="nav-link" ><?= $postAsc->getTitle() ?></a> 
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </aside>
    </div>

    <div class="col">
        <?php foreach ($posts as $post) : ?>
            <article class="post mb-4 p-2 p-md-4 bg-white border">
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
        <?php endforeach; ?>

        <nav>
            <ul class="pagination">
                <?= $paginator->previous() ?>
                <?= $paginator->pages() ?>
                <?= $paginator->next() ?>
            </ul>
        </nav>
    </div>
</div>

