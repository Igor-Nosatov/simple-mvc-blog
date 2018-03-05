<?php 
$title = 'Admin';
ob_start(); 
?>

<h1 class="mb-4">Administration</h1>

<a href="/writePost">Ajouter un post</a>

<section>
    <h3>Commentaires signalés</h4>
    <?php
    foreach ($flaggedComments as $flaggedComment):
    ?>
        <article>
            <header>
                <h4><?= htmlspecialchars($flaggedComment->getAuthor()) ?></h4>
            </header>
            <p><?= $flaggedComment->getContent() ?></p>
            <footer>
                <a href="/unflagComment/<?= $flaggedComment->getId() ?>">Ignorer</a>
                <a href="/deleteComment/<?= $flaggedComment->getId() ?>">Supprimer</a>
            </footer>
        </article>
    <?php
    endforeach;
    ?>
</section>

<?php 
$content = ob_get_clean();
require('template.php');
?>
