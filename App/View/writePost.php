<?php 
$title = 'Nouveau post';
ob_start(); 
?>

<form action="/addPost" method="post">
    <input type="text" name="title" id="title" placeholder="Titre">
    <textarea name="content" id="content" cols="30" rows="10"></textarea>
    <input type="submit" value="Valider">
</form>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

<?php 
$content = ob_get_clean();
require('template.php');
?>