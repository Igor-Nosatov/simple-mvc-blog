<?php 
$title = 'Admin';
ob_start(); 
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
                        <a href="/deletePost/<?= $post->getId() ?>">Supprimer</a>
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

<?php 
$content = ob_get_clean();
require('template.php');
?>
