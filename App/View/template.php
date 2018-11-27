<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
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

</html>
