<?php

$title = "Mes messages";

ob_start() ?>

<h1>Mes messages</h1>

<?php
if(empty($messages)):?>
	<p>Aucun message pour le moment</p>
<?php else:
	$otherUsers = [];
	foreach ($messages as $message) :
		if(!in_array($message->getSenderId(),$otherUsers) AND !in_array($message->getReceiverId(), $otherUsers)):

			if($user->getId() == $message->getReceiverId() ){

				$otherUser =  $message->getSenderName();
				$otherUserId = $message->getSenderId();
				$lastMessageSender = $otherUser;
				$otherUsers[] = $message->getSenderId();

			 }else{

				$otherUser = $message->getReceiverName();
				$otherUserId = $message->getReceiverId();
				$otherUsers[] = $message->getReceiverId();
				$lastMessageSender = "Moi";
			 }
	?>
				<div class="chatConversation" onclick="getChatWith(<?= $otherUserId;?>">
						<h4><a href="index.php?a=chat&amp;userId=<?= $otherUserId;?>#messagesEnd"><?= $otherUser?></a></h4>
						<p class="messageInfos">
							<?= $lastMessageSender;?> : <?= $message->getMessage();?>
							<span><?= $message->getDateSended();?></span>
						</p>
				</div>

		<?php endif;
	endforeach;
endif;
$content = ob_get_clean();

require_once 'view/mainTemplate.php';