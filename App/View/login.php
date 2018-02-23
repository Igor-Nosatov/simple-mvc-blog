<?php 
$title = 'login';
ob_start(); 
?>

<form action="index.php?action=authenticate" method="post" class="login-form">
    <input type="text" name="username" id="username">
    <input type="password" name="password" id="password">
    <input type="submit" value="Login">
</form>

<?php 
$content = ob_get_clean();
require('template.php');
?>
