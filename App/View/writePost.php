<?php $title = 'Écrire un chapitre'; ?>

<h1 class="mb-4"><?= $title ?></h1>

<form action="/admin/addPost" method="post" class="bg-light p-md-4">
    <div class="form-group">
        <input type="text" name="title" id="title" placeholder="Titre" class="form-control">
    </div>
    <div class="form-group">
        <textarea name="content" id="content" cols="30" rows="20" class="form-control"></textarea>
    </div>
    <input type="submit" value="Valider" class="btn btn-primary">
</form>
