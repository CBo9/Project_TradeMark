<?php

class AdminController{

	function viewHome(){
		$itemManager = new ItemManager();
		$itemsNumber = $itemManager->countAllItems();

		$userManager = new UserManager();
		$usersTotal = $userManager->countAllUsers();

		$supportManager = new SupportManager();
		$requestsTotal = $supportManager->countAllRequests();
		$reqWaitingAdmin = $supportManager->countRequestsByStatus('Waiting for Admin');
		require_once'view/adminHome.php';
	}

	function showAllMembers(){
		$userManager = new UserManager();
		$allMembers = $userManager->getAllUsers();

		$objectType = "membres";
		require_once'view/adminTable.php';
	}

	function showAllRequests(){
		$supportManager = new SupportManager();
		$allRequests = $supportManager->getAllRequests();

		$objectType = "requêtes";
		require_once'view/adminTable.php';
	}
}