<?php

$title = "Support - ". $request->getTitle();

ob_start()?>

<?php if($_SESSION['user']->getStatus() != "admin"){
	echo '<a href="index.php?a=profile">Revenir à mon profil</a>';
}else{
	echo '<a href="index.php?">Retour</a>';
}?>

<h1><?= $request->getTitle();?></h1>

<p><?= $request->getRequest();?></p>

<?php $content = ob_get_clean();

require_once 'view/mainTemplate.php';