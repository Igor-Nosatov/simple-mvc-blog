<?php 
$title = 'Ajouter un post';
?>

<h1 class="mb-4">Ajouter un post</h1>

<form action="/addPost" method="post" class="bg-light p-4">
    <div class="form-group">
        <input type="text" name="title" id="title" placeholder="Titre" class="form-control">
    </div>
    <div class="form-group">
        <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <input type="submit" value="Valider" class="btn btn-primary">
</form>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script src="js/tinymce/init.js"></script>
