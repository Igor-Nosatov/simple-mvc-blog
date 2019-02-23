<?php $title = 'Modification du chapitre'; ?>

<h1 class="mb-4"><?= $title ?></h1>

<form action="/admin/executeUpdatePost/<?= $post->getId() ?>" method="post" class="bg-light p-md-4">
    <div class="form-group">
        <input type="text" name="title" id="title" value="<?= $post->getTitle() ?>" class="form-control">
    </div>
    <div class="form-group">
        <textarea name="content" id="content" cols="30" rows="20" class="form-control"><?= $post->getContent() ?></textarea>
    </div>
    <input type="submit" value="Valider" class="btn btn-primary">
</form>
