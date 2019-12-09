<?php
$title = "Chat avec". $otherUserName;

ob_start() ?>

<h1 id="redirect">Discuter avec <?= $otherUserName;?></h1>
<div id="chatContainer">
	<div id="AllMessages">
		<p>Ceci est le début de votre discussion avec  <?= $otherUserName;?></p>
		<?php 
		if(!empty($messages)):
			foreach ($messages as $message) :?>
				<div class="messageContainer">
					<a href="index.php?a=profile&amp;id=<?= $message->getSenderId();?>">
						<h4><?= $message->getSenderName();?></h4>
					</a>
					<p><?= $message->getMessage();?></p>
					<span><?= $message->getDateSended();?></span>
				</div>
			<?php endforeach;
		endif;?>
		<span id="messagesEnd"></span>
	</div>
	<form method="POST" action='index.php?a=sendMessage&amp;userId=<?= $otherUserId;?>' id='chatForm'>
		<textarea name="message" id="message" placeholder="Envoyer un message à <?= $otherUserName;?>"></textarea>
		<input type="submit" value='ENVOYER'>
	</form>
</div>
<?php
$content = ob_get_clean();

$additionalScript = "<script>chatScroll()</script>";

require_once'view/mainTemplate.php';