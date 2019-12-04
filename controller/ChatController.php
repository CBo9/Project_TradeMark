<?php 

class ChatController{

	function sendMessageToUser($receiverId){
		if(isset($_SESSION['user'])){
			$sender = $_SESSION['user'];
			$message = new ChatMessage($_POST);
			$message->setReceiverId($id);
			$message->setSenderId($user->getID());

			$chatManager = new ChatManager();
			$chatManager->createNewMessage($message);

			header('location:index.php?a=chat&userId='.$userId);
		}else{
			require_once'view/connection.php';
		}	
	}

	function viewChatWith($otherUserId){
		if(!isset($_SESSION['user'])){
			header('location:index.php?a=connection');
		}
		$user = $_SESSION['user'];
		$userManager = new UserManager();
		if(!$otherUserName = $userManager->getUserNickname($otherUserId)){
			header('location:index.php?a=myChats');
		}

		$chatManager = new ChatManager();
		$messages = $chatManager->getChatMessagesWithUser($user, $otherUserId);
		require_once'view/chat.php';
	}

	function viewAllChats(){
		if(!isset($_SESSION['user'])){
			header('location:index.php?a=connection');
		}
		$user = $_SESSION['user'];
		$chatManager = new ChatManager();
		$messages = $chatManager->getUserChats($user);
		require_once'view/allChats.php';
	}
	

	
}