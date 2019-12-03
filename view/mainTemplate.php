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
	        <?php if(isset($_SESSION['user'])):?>
	        	<a  href="index.php?a=support">SUPPORT</a>
	        <?php endif; ?>
	        <div id="navRight">
		        <?php if(isset($_SESSION['user'])){?>
		        	<div id="userSlide">
		        		<a  id="userProfile" onclick="userNavSlide()"><?= strtoupper($_SESSION['user']->getNickname());?></a>
		        		<ul id="userNav">
		        			<a href="index.php?a=profile&amp;id=<?= $_SESSION['user']->getId();?>"><li id="link1">Mon Profil</li></a>
		        			<a href="index.php?a=chats"><li id="link2">Mes messages</li></a>
		        			<a href="index.php?a=manageItems"><li id="link3">Gérer mes articles</li></a>
		        			<a onclick="signOutConfirm()"><li id="link4">Déconnexion</li></a>
		        		</ul>
		        	</div>
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
    <script src="public/js/script.js"></script>
    <?php if(isset($additionalScript)){
		echo $additionalScript;
	}?>

</body>
</html>