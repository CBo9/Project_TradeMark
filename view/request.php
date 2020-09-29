<?php

$title = "Support - ". $request->getTitle();

ob_start()?>

<?php if($_SESSION['user']->getStatus() != "admin"){
	echo '<a href="index.php?a=myAccount">Revenir à mon profil</a>';
}else{
	echo '<a href="index.php?a=viewAllRequests">Retour</a>';
}?>

<div id="supportRequest">
	<div>
		<h1><?= $request->getTitle();?></h1>

		<p><?= $request->getRequest();?></p>

		<?php
		if(!empty($messages)):
			foreach ($messages as $message):
				if($_SESSION['user']->getId() == $message->getUserId()) : ?>
						<div class="sendedMessage supportMessage ">
				<?php else:?> 
						<div class="receivedMessage supportMessage">
				<?php endif;?>
					<p><?= $message->getMessage();?></p>
					<p><?= $message->getUserName()." ".$message->getDate();?></p>
				</div>
			<?php endforeach;
		endif;?>

		<?php if($request->getStatus() != 'resolved'):?>
			<form method="POST" class="redBgForm" action="index.php?a=newSupportMessage&amp;reqId=<?= $request->getId();?>" id="supportForm">
				<h3>Ajouter une réponse</h3>
				<textarea name="message" placeholder="Écrivez votre message(500 caractères max)"></textarea>
				<div>
					<input type="checkbox" id="resolved" name="resolved"><label for="resolved">Marquer comme résolu</label>
				</div>
				<input type="submit" value="Envoyer">
			</form>
		<?php endif;?>
	</div>
</div>

<?php $content = ob_get_clean();

require_once 'view/mainTemplate.php';