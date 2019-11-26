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
	<div id="container">
	    <nav id="navbar">
	        <a  href="index.php">ACCUEIL</a>
	        <a  href="index.php?a=connexion">LIVRES</a>
	        <a  href="index.php?a=inscription">JEUX VIDÉOS</a>
	        <?php if(isset($_SESSION['id'])):?>
	        	<a  href="index.php?a=support">SUPPORT</a>
	        <?php endif; ?>
	        <div id="navRight">
		        <?php if(isset($_SESSION['id'])){?>
		        	<a href="index.php?a=profile"><?= $login ?></a>
		        <?php }else{?>
	        		<a  href="index.php?a=connection">SE CONNECTER</a>
	        	<?php }?>
	        </div>
	    </nav>


	    <div id="mainContent">
	    	<?= $content ?>
	    </div>

	    <footer></footer>
	</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="public/js/NavbarOnScroll.js"></script>

</body>
</html>