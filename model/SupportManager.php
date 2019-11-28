<?php

class SupportManager extends Manager{

	function createRequest(SupportRequest $request){
		$db = $this->dbConnect();
		$insert = $db->prepare("INSERT INTO support (userId, title, request) VALUES (:userId, :title, :request)");
		$insert->execute(["userId"=>$request->getUserId(),
							"title"=>$request->getTitle(),
							"request"=>$request->getRequest()]);
	}

	function createMessage(SupportMessage $message){
		$db = $this->dbConnect();
		$insert = $db->prepare("INSERT INTO supportMessages (requestId, userId, message) VALUES (:requestId, :userId, :message)");
		$insert->execute(["requestId"=>$message->getRequestId(),
							"userId"=>$message->getUserId(),
							"message"=>$message->getMessage()]);
	}

	function getRequest($requestId){
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT * FROM support WHERE id = :reqId AND userId = :userId");
		$request->execute(["reqId"=>$requestId,"userId"=>$_SESSION['user']->getId()]);
		return $request;
	}

	function getMessages($reqId){
		$db = $this->dbConnect();
		$dbRequest = $db->prepare("SELECT supportMessages.*, users.nickname FROM supportMessages INNER JOIN users ON users.id = supportMessages.userId WHERE requestId = :reqId ");
		$dbRequest->execute(["reqId"=>$reqId]);
		$nb = 1;
		while($data = $dbRequest->fetch()){
			${'message'.$nb} = new SupportMessage($data);
			${'message'.$nb}->nickname = $data['nickname'];
			$messages[] = ${'message'.$nb};
			$nb++;
		}
		return $messages;
	}
	
	function updateRequest($newStatus,$requestId){
		$db = $this->dbConnect();
		$update = $db->prepare('UPDATE support SET status = :status WHERE requestId = :requestId');
		$update->execute(["status"=>$newStatus,"requestId"=>$requestId]);
	}

	function deleteRequest($id){
		$db = $this->dbConnect();
		$deletion = $db->prepare("DELETE FROM support WHERE id = $id");
		$deletion->execute();
	}
} 
