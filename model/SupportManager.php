<?php

class SupportManager extends Manager{

	function newRequest(){
		$db = $this->dbConnect();
		$insert = $db->prepare("INSERT INTO support (userId, title, request) VALUES (:userId, :title, :request)");
		$insert->execute(["userId"=>,
							"title"=>,
							"request"=>]);
	}

	function newMessage(){
		$db = $this->dbConnect();
		$insert = $db->prepare("INSERT INTO supportMessages (requestId, userId, message) VALUES (:requestId, :userId, :message)");
		$insert->execute(["requestId"=>,
							"userId"=>,
							"message"=>]);
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
