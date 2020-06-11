<?php

class AdminController{

	private $viewPath = "view/admin/";

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
			require_once $this->viewPath.'adminHome.php';
		}else{
			require_once'view/404.php';
		}
	}

	function showAllMembers(){
		if($this->isAdmin()){
			$userManager = new UserManager();
			$allMembers = $userManager->getAllUsers();

			$objectType = "membres";
			require_once $this->viewPath.'adminTable.php';
		}else{
			require_once'view/404.php';
		}
	}

	function showAllRequests(){
		if($this->isAdmin()){
			$supportManager = new SupportManager();
			$allRequests = $supportManager->getAllRequests();

			$objectType = "requêtes";
			require_once $this->viewPath.'adminTable.php';
		}else{
			require_once'view/404.php';
		}
	}

	function adminUpdate($userId){
		if($this->isAdmin()){
			$userManager = new UserManager();
			$user = $userManager->getUserById($userId);

			require_once $this->viewPath.'adminUpdateUser.php';
		}else{
			require_once'view/404.php';
		}
	}

	function updateUser($userId){
		if($this->isAdmin()){
			$userManager= new UserManager();
			$user = new User($_POST);
			$user->setId($userId);
			$dbUser = $userManager->getUserById($userId);


			if(isset($_FILES['avatar']) AND $_FILES['avatar']['error'] == 0){
				if($_FILES['avatar']['size'] <= 5000000){
					$fileInfos = pathinfo($_FILES['avatar']['name']);
					$fileExtension = $fileInfos['extension'];
					$allowedExtensions =['png','jpg','jpeg','gif'];
					if(in_array($fileExtension, $allowedExtensions)){	
						$rawFilename = ucfirst('user_avatar'. $user->getNickname() . basename($_FILES['avatar']['name']));
						$filename = preg_replace('/\s+/', '', $rawFilename);
						move_uploaded_file($_FILES['avatar']['tmp_name'], 'public/img/avatars/' . $filename);
						$user->setAvatar($filename);
						if($dbUser->getAvatar() != "default.png"){
							unlink('public/img/items/' . $dbUser->getAvatar());
						}
					}else{
						$formError = "Le format du fichier transmis n'est pas autorisé.Formats autorisés: jpg, png, jpeg, gif";
						header('location: index.php?a=adminUpdate&id=' . $userId);
					}
				}else{
					$formError = "Le fichier transmis dépasse la limite autorisée(5Mo)";
					header('location: index.php?a=adminUpdate&id=' . $userId);
				}
			}else{
				$user->setAvatar($dbUser->getAvatar());
			}
			$userManager->updateUserNoPassword($user);
			//header('location: index.php?a=viewAllMembers');
		}else{
			require_once'view/404.php';
		}
	}


}