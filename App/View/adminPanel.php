<?php 
$title = 'Admin';
ob_start(); 
?>

<a href="index.php?action=writePost">Ajouter un post</a>

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
                <a href="index.php?action=unflagComment&id=<?= $flaggedComment->getId() ?>">Ignorer</a>
                <a href="index.php?action=deleteComment&id=<?= $flaggedComment->getId() ?>">Supprimer</a>
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
