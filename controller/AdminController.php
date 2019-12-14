<?php

class AdminController{

	function isAdmin(){
		if(isset($_SESSION['user']) AND $_SESSION['user']->getStatus() == "admin" ){
			return true;
		}else{
			return false;
		}
	}

	function viewHome(){
		if($this->isAdmin()){
			$itemManager = new ItemManager();
			$itemsNumber = $itemManager->countAllItems();

			$userManager = new UserManager();
			$usersTotal = $userManager->countAllUsers();

			$supportManager = new SupportManager();
			$requestsTotal = $supportManager->countAllRequests();
			$reqWaitingAdmin = $supportManager->countRequestsByStatus('Waiting for Admin');
			require_once'view/adminHome.php';
		}else{
			require_once'view/404.php';
		}
	}

	function showAllMembers(){
		if($this->isAdmin()){
			$userManager = new UserManager();
			$allMembers = $userManager->getAllUsers();

			$objectType = "membres";
			require_once'view/adminTable.php';
		}else{
			require_once'view/404.php';
		}
	}

	function showAllRequests(){
		if($this->isAdmin()){
			$supportManager = new SupportManager();
			$allRequests = $supportManager->getAllRequests();

			$objectType = "requêtes";
			require_once'view/adminTable.php';
		}else{
			require_once'view/404.php';
		}
	}


}