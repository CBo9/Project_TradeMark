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
		header('location: index.php?a=myAccount');
	}

	function viewRequest($reqId){
		$supportManager = new SupportManager();
		if($request = $supportManager->getRequest($reqId)){
			if($request->getUserId() == $_SESSION['user']->getId() OR $_SESSION['user']->getStatus() == 'admin'){
				$messages = $supportManager->getMessages($request->getId());
				require_once'view/request.php';
			}else{
				require_once'view/404.php';
			}
		}else{
			require_once'view/404.php';
		}
	}

	function addMessage($reqId){
		$supportManager = new SupportManager();
		$message = new SupportMessage($_POST);
		$message->setRequestId($reqId);
		$message->setUserId($_SESSION['user']->getId());

		if($request = $supportManager->getRequest($message->getRequestId())){
			if($request->getUserId() == $_SESSION['user']->getId() OR $_SESSION['user']->getStatus() == 'admin'){
				
				if($_POST['resolved']== 'on'){
					$request->setStatus('resolved');
				}else if($_SESSION['user']->getStatus() == 'admin'){
					$request->setStatus('member');
				}else if($message->getUserId() == $request->getUserId()){
					$request->setStatus('admin');
				} 
	
				$supportManager->createMessage($message);
				$supportManager->updateRequest($request->getStatus(),$request->getId());
				header("location: index.php?a=viewRequest&reqId=" . $request->getId());
			}else{
				require_once'view/404.php';
			}
		}else{
			require_once'view/404.php';
		}
	}
}