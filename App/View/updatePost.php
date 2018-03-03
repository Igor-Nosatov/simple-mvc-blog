<?php 
$title = 'Modifier le post';
ob_start(); 
?>

<form action="/executeUpdatePost/<?= $post->getId() ?>" method="post">
    <input type="text" name="title" id="title" value="<?= $post->getTitle() ?>">
    <textarea name="content" id="content" cols="30" rows="10"><?= $post->getContent() ?></textarea>
    <input type="submit" value="Valider">
</form>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

<?php 
$content = ob_get_clean();
require('template.php');
?>
