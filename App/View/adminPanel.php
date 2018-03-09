<?php 
$title = 'Admin';
?>

<h1 class="mb-4">Administration</h1>

<div class="row mb-4">
    <a href="/writePost">Ajouter un post</a>
</div>

<div class="row">
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
                        <a href="/updatePost/<?= $post->getId() ?>" class="mr-2">Modifier</a>
                        <a data-toggle="modal" data-target="#delete-modal" class="delete-post" href="/deletePost/<?= $post->getId() ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<h3>Commentaires signalés</h4>

<?php foreach ($flaggedComments as $flaggedComment): ?>
    <article>
        <header>
            <h5><?= htmlspecialchars($flaggedComment->getAuthor()) ?></h5>
        </header>
        <p><?= $flaggedComment->getContent() ?></p>
        <footer>
            <a href="/unflagComment/<?= $flaggedComment->getId() ?>">Ignorer</a>
            <a href="/deleteComment/<?= $flaggedComment->getId() ?>">Supprimer</a>
        </footer>
    </article>
<?php endforeach; ?>

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

<script src="js/confirm.js"></script>
