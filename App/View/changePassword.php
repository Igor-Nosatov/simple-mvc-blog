<?php $title = 'Changer de mot the passe'; ?>

<h1 class="mb-4">Changer de mot de passe</h1>

<form action="/admin/executeChangePassword" method="post" class="login-form">
    <div class="form-group">
        <label for="username">Ancien mot the passe</label>
        <input type="password" name="old-password" id="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="new-password">Nouveau mot the passe</label>
        <input type="password" name="new-password" id="new-password" class="form-control">
        <label for="new-password-confirm">Confirmer</label>
        <input type="password" name="new-password-confirm" id="new-password-confirm" class="form-control">
    </div>
    <input type="submit" value="Envoyer" class="btn btn-primary">
</form>
