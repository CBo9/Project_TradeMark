<?php

class SupportController{


	function supportPage(){
		require_once 'view/support.php';
	}

	function newRequest(){
		$request = new SupportRequest($_POST);
		$request->setUserId($_SESSION['user']->getId());
		$supportManager = new SupportManager();
		$supportManager->newRequest($request);
	}
}