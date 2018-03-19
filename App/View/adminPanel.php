<?php $title = 'Administration'; ?>

<section class="administration bg-white">
    <header class="d-flex justify-content-between p-4 align-items-center">
        <h1 class="">Administration</h1>
    </header>

    <div class="mb-4 px-2 d-flex justify-content-around flex-md-row flex-column">
        <a href="/admin/writePost"><i class="fas fa-pencil-alt mr-1"></i> Écrire un chapitre</a>
        <a href="/admin/changePassword"><i class="fas fa-key mr-1"></i> Changer de mot de passe</a>
    </div>

    <table class="table table-striped posts-table">
        <caption>Tous les posts</caption>
        <thead>
            <tr>
                <th class="d-sm-table-cell d-none">Titre</th>
                <th class="d-sm-table-cell d-none">Date</th>
                <th class="d-sm-table-cell d-none">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td class="d-sm-table-cell d-block">
                        <a href="/post/<?= $post->getId() ?>"><?= $post->getTitle() ?></a>
                    </td>
                    <td class="d-sm-table-cell d-block">
                        <?= $post->getDateAdded() ?>
                    </td>
                    <td class="d-sm-table-cell d-block">
                        <a href="/admin/updatePost/<?= $post->getId() ?>" class="btn btn-primary">Modifier</a>
                        <a data-toggle="modal" data-target="#delete-modal" class="btn btn-warning delete-btn" href="/admin/deletePost/<?= $post->getId() ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <section class="flagged-comments p-4">
        <header class="mb-4">
            <h3>Commentaires signalés</h3>
            <?php if (empty($flaggedComments)): ?>
            <p>Pas de commentaire signalé.</p>
            <?php endif; ?>
        </header>

        <?php foreach ($flaggedComments as $flaggedComment): ?>
            <article class="comment mb-4">
                <header class="comment__header">
                    <h5 class="comment__heading">
                        <?= htmlspecialchars($flaggedComment->getAuthor()) ?>
                    </h5>
                </header>
                <div class="comment__content py-2">
                    <?= $flaggedComment->getContent() ?>
                </div>
                <footer class="comment__footer">
                    <a class="mr-2" href="/admin/unflagComment/<?= $flaggedComment->getId() ?>">Ignorer</a>
                    <a class="mr-2" href="/admin/deleteComment/<?= $flaggedComment->getId() ?>">Supprimer</a>
                    <a href="/post/<?= $flaggedComment->getPostId() ?>">Lien vers le post</a>
                </footer>
            </article>
        <?php endforeach; ?>
    </section>

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Suppression du post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes vous sûr ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <a class="btn btn-primary" id="delete" href="#">Confirmer</a>
            </div>
            </div>
        </div>
    </div>
</section>

<script src="js/confirm.js"></script>
