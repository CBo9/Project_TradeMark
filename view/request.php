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

<?php
if(!empty($messages)):
	foreach ($messages as $message):?>
		<div class="message">
			<p>
				<?= $message->getMessage();?>
				<span><?= $message->nickname." ".$message->getDate();?>	
			</p>
		</div>
	<?php endforeach;
endif;?>


<form method="POST" action="index.php?a=newMessage&amp;reqId=<?= $request->getId();?>">
<h3>Ajouter une réponse</h3>
<textarea name="message" placeholder="Écrivez votre message(500 caractères max)"></textarea>
<input type="submit" value="Envoyer">

<?php $content = ob_get_clean();

require_once 'view/mainTemplate.php';