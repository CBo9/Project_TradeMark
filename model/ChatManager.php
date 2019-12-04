<?php

class ChatManager extends Manager{

	function createChat(ChatMessage $message){
		$db = $this->dbConnect();
		$insert = $db->prepare("INSERT INTO chat(senderId, receiverId, message) 
								VALUES (:sender, :receiver, :message)");
		$insert->execute(["sender"=>$message->getSenderId(),
						  "receiver"=>$message->getReceiverId(),
						  "message"=>$message->getReceiverId()]);
	}

	function getChatMessagesWithUser(User $user,$receiverId){
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT chat.*,sender.nickname as senderName, receiver.nickname as receiverName
								 FROM chat INNER JOIN users as sender ON sender.id = chat.senderId INNER JOIN users as receiver ON receiver.id = chat.receiverId 
								 WHERE (receiverId = :receiver AND senderId = :sender) OR (receiverId = :sender AND senderId = :receiver)  
								 ORDER BY dateSended ASC');
		$request->execute(["receiver"=>$receiverId,
						   "sender"=>$user->getId()]);
		while($messageData = $request->fetch()){
			$message = new ChatMessage($messageData);
			$messages[] = $message;
		}
		return $messages;
	}

	function getUserChats(User $user){
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT chat.*,sender.nickname as senderName, receiver.nickname as receiverName 
								 FROM chat INNER JOIN users as sender ON sender.id = chat.senderId INNER JOIN users as receiver ON receiver.id = chat.receiverId 
								 WHERE senderId = :userId OR ReceiverId = :userId
								 ORDER BY dateSended DESC ');
		$request->execute(["userId"=>$user->getId()]);
		while($messageData = $request->fetch()){
			$message = new ChatMessage($messageData);
			$messages[] = $message; 
		}
		return $messages;
	}
}