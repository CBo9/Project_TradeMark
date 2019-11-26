<?php

class SupportManager extends Manager{

	function newRequest(SupportRequest $request){
		$db = $this->dbConnect();
		$insert = $db->prepare("INSERT INTO support (userId, title, request) VALUES (:userId, :title, :request)");
		$insert->execute(["userId"=>$request->getUserId(),
							"title"=>$request->getTitle(),
							"request"=>$request->getRequest()]);
	}

	function newMessage(){
		$db = $this->dbConnect();
		$insert = $db->prepare("INSERT INTO supportMessages (requestId, userId, message) VALUES (:requestId, :userId, :message)");
		$insert->execute(["requestId"=>$request,
							"userId"=>$request,
							"message"=>$request]);
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
