<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/cssRoboto.css">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">
    <link rel="stylesheet" href="public/css/media_queries.css" type="text/css">
    <title><?= $title ?></title>
</head>
<body id="body">
<!--barre de navigation-->
	<div id="container">
	    <nav id="navbar">
	        <a  href="index.php">ACCUEIL</a>
	        <a href=index.php?a=market>MARCHÉ</a>
	        <?php if(isset($_SESSION['user'])):?>
	        	<a  href="index.php?a=support">SUPPORT</a>
	        	<?php if ($_SESSION['user']->getStatus() == 'admin'):?>
	        		<a  href="index.php?a=adminHome">ADMIN</a>
	        	<?php endif;
	        endif; ?>

	        <div id="navRight">
		        <?php if(isset($_SESSION['user'])){?>
		        	<div id="userSlide">
		        		<a  id="userProfile" onclick="userNavSlide()"><?= strtoupper($_SESSION['user']->getNickname());?></a>
		        		<ul id="userNav">
		        			<a href="index.php?a=profile&amp;id=<?= $_SESSION['user']->getId();?>"><li id="link1">Mon Profil</li></a>
		        			<a href="index.php?a=myChats"><li id="link2">Mes messages</li></a>
		        			<a href="index.php?a=myAccount"><li id="link3">Mon compte</li></a>
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

	    <footer id="footer">
	    	<ul>
	    		<li><a href="index.php#howTo">FAQ</a></li>
	    		<li><a href="index.php?a=support">Support</a></li>
	    		<li><a href="#">A propos</a></li>
	    		<li><a href="#">Jobs</a></li>
	    	</ul>
	    	<ul>
	    		<li>Crée par Clément</li>
	    		<li><a href="https://github.com/CBo9/Project_TradeMark">Voir le projet sur GitHub</a></li>
	    	</ul>
	    </footer>
	</div>
	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="public/js/script.js"></script>
    <?php if(isset($additionalScript)){
		echo $additionalScript;
	}?>

</body>
</html>