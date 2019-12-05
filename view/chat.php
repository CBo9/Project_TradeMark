<?php
$title = "Chat avec". $otherUserName;

ob_start() ?>

<h1>Discuter avec <?= $otherUserName;?></h1>
<div id="chatContainer">
	<div id="AllMessages">
		<?php foreach ($messages as $message) :?>
			<div class="messageContainer">
				<a href="index.php?a=profile&amp;id=<?= $message->getSenderId();?>">
					<h4><?= $message->getSenderName();?></h4>
				</a>

				<p><?= $message->getMessage();?></p>
				<span><?= $message->getDateSended();?></span>
			</div>
		<?php endforeach;?>
	</div>
	<form method="POST" action='index.php?a=sendMessage&amp;userId=<?= $otherUserId;?>' id='chatForm'>
		<textarea name="message" id="message" placeholder="Envoyer un message à <?= $otherUserName;?>"></textarea>
		<input type="submit" value='ENVOYER'>
	</form>
</div>
<?php
$content = ob_get_clean();

require_once'view/mainTemplate.php';