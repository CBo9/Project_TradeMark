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
		$request = $db->prepare("SELECT * FROM support WHERE id = :reqId");
		$request->execute(["reqId"=>$requestId]);
		if($requestData = $request->fetch()){
			$support = new SupportRequest($requestData);
			return $support;
		}
	}

	function getMessages($reqId){
		$db = $this->dbConnect();
		$dbRequest = $db->prepare("SELECT supportMessages.*, users.nickname as userName FROM supportMessages INNER JOIN users ON users.id = supportMessages.userId WHERE requestId = :reqId ");
		$dbRequest->execute(["reqId"=>$reqId]);
		$nb = 1;
		while($data = $dbRequest->fetch()){
			${'message'.$nb} = new SupportMessage($data);
			$messages[] = ${'message'.$nb};
			$nb++;
		}
		return $messages;
	}
	
	function updateRequest($newStatus,$requestId){
		$db = $this->dbConnect();
		$update = $db->prepare('UPDATE support SET status = :status WHERE id = :reqId');
		$update->execute(["status"=>$newStatus,
						  "reqId"=>$requestId]);
	}

	function deleteRequest($id){
		$db = $this->dbConnect();
		$deletion = $db->prepare("DELETE FROM support WHERE id = $id");
		$deletion->execute();
	}

	function getRequestsByUser(){
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT * FROM support WHERE userId = :id");
		$request->execute(["id"=>$_SESSION['user']->getId()]);
		while($data = $request->fetch()){
			$supportRequest = new SupportRequest($data);
			$supportRequests[] = $supportRequest;
		}
		return $supportRequests;
	}

	function countAllRequests(){
		$db = $this->dbConnect();
		$request = $db->prepare(" SELECT COUNT(*) as count FROM support");
		$request->execute();
		$data = $request->fetch();
		$count = $data['count'];
		return $count;
	}

	function countRequestsByStatus($status){
		$db = $this->dbConnect();
		$request = $db->prepare(" SELECT COUNT(*) as count FROM support WHERE status = :status");
		$request->execute(["status"=>$status]);
		$data = $request->fetch();
		$count = $data['count'];
		return $count;
	}

	function getAllRequests(){
		$db = $this->dbConnect();
		$support = $db->prepare('SELECT support.*, users.nickname as userName FROM support INNER JOIN users ON support.userId = users.id ');
		$support->execute();
		while($requestData = $support->fetch()){
			$request = new SupportRequest($requestData);
			$allRequests[] = $request;
		}
		return $allRequests;
	}
} 
