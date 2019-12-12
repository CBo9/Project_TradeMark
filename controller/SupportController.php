<?php

class SupportController{


	function supportPage(){
		require_once 'view/support.php';
	}

	function newRequest(){
		$request = new SupportRequest($_POST);
		$request->setUserId($_SESSION['user']->getId());
		$supportManager = new SupportManager();
		$supportManager->createRequest($request);
	}

	function viewRequest($reqId){
		$supportManager = new SupportManager();
		$result = $supportManager->getRequest($reqId);
		if($req = $result->fetch()){
			$request = new SupportRequest($req);
			require_once'view/request.php';
		}else{
			require_once'view/404.php';
		}
	}
}