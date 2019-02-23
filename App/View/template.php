<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md bg-white d-flex justify-content-between border-bottom">
        <a class="navbar-brand" href="/">
            <img class="logo" src="/img/logo.png" alt="logo" title="Accueil">
        </a>
        <?php if (isset($_SESSION['id'])) : ?>
            <?php if ($_SERVER['REQUEST_URI'] === '/admin') : ?>
                <a href="/admin/logout"><i class="fas fa-sign-out-alt mr-1"></i>Deconnexion</a>
            <?php else : ?>
                <a href="/admin">Espace d'administration</a>
            <?php endif; ?>
        <?php endif; ?>
        </nav>
    </header>

    <?php if ($_SERVER['REQUEST_URI'] === '/') : ?>
    <div class="jumbotron jumbotron-fluid d-flex align-items-center justify-content-center">
        <div class="container">
            <h1 class="display-4">Billet simple pour l'Alaska</h1>
            <p class="lead">Par Jean Forteroche - Écrivain et romancier</p>
        </div>
    </div>
    <?php endif; ?>

    <main class="container my-3">
        <?php
        if ($flash->hasMessage()) {
            echo $flash->get();
        }
        ?>

        <?= $content ?> 
    </main>
</body>

<script src="/js/main.js"></script>

</html>
