<?php 
$title = 'Admin';
ob_start(); 
?>

<a href="index.php?action=writePost">Ajouter un post</a>

<?php 
$content = ob_get_clean();
require('template.php');
?>
