<?php 
$title = 'Admin';
?>

<div class="admin-inner container bg-white">
<h1 class="py-4 px-2">Administration</h1>

<div class="mb-4">
    <a href="/admin/writePost">Ajouter un post</a>
    <a href="/admin/changePassword">Changer de mot de passe</a>
</div>

<table class="table">
    <caption>Tous les posts</caption>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post): ?>
            <tr>
                <td>
                    <a href="/post/<?= $post->getId() ?>"><?= $post->getTitle() ?></a>
                </td>
                <td>
                    <?= $post->getDateAdded() ?>
                </td>
                <td>
                    <a href="/admin/updatePost/<?= $post->getId() ?>" class="mr-2">Modifier</a>
                    <a data-toggle="modal" data-target="#delete-modal" class="delete-post" href="/admin/deletePost/<?= $post->getId() ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<section class="comments">
    <h3>Commentaires signalés</h3>
    <?php if (empty($flaggedComments)): ?>
    <p>Pas de commentaire signalé.</p>
    <?php endif; ?>

    <?php foreach ($flaggedComments as $flaggedComment): ?>
        <article class="comment">
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
            <a class="btn btn-primary" id="delete" href="">Confirmer</a>
        </div>
        </div>
    </div>
</div>
</div>

<script src="js/confirm.js"></script>
