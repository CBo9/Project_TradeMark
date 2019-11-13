<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/cssRoboto.css">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">
    <title><?= $title ?></title>
</head>
<body>
<!--barre de navigation-->
    <nav class="nav nav-pills flex-column flex-sm-row" id="navbar">
        <a class="flex-sm-fill text-sm-center btn btn-primary" href="index.php">ACCUEIL</a>
        <a class="flex-sm-fill text-sm-center btn btn-success" href="index.php?a=connexion">LIVRES</a>
        <a class="flex-sm-fill text-sm-center btn btn-warning" href="index.php?a=inscription">JEUX VIDÉOS</a>
        <a class="flex-sm-fill text-sm-center btn btn-danger" href="index.php?a=connection">SE CONNECTER</a>
    </nav>



    <?= $content ?>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="public/js/NavbarOnScroll.js"></script>

</body>
</html>