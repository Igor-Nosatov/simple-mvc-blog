<?php 
$title = 'login';
ob_start(); 
?>

<form action="/authenticate" method="post" class="login-form">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <input type="submit" value="Login" class="btn btn-primary">
</form>

<?php 
$content = ob_get_clean();
require('template.php');
?>
