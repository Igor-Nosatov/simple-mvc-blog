<?php 
$title = 'Modifier le post';
?>

<h1 class="mb-4">Modifier un post</h1>

<form action="/executeUpdatePost/<?= $post->getId() ?>" method="post" class="bg-light p-4">
    <div class="form-group">
        <input type="text" name="title" id="title" value="<?= $post->getTitle() ?>" class="form-control">
    </div>
    <div class="form-group">
        <textarea name="content" id="content" cols="30" rows="10" class="form-control"><?= $post->getContent() ?></textarea>
    </div>
    <input type="submit" value="Valider" class="btn btn-primary">
</form>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script src="/js/tinymce/init.js"></script>
