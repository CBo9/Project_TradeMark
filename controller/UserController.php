<?php 

class UserController{

	function signUp(){
		$user = new User($_POST);
		$userManager = new UserManager();
		$user->setAvatar('default.jpg');
		$confirmNickname = $userManager->getUserByNick($user);
		if($nicknameTaken = $confirmNickname->fetch()){
			$signUpError = "Ce pseudo est déjà utilisé";
		}else{
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
					}else{
							$signUpError = "Le format du fichier transmis n'est pas autorisé.Formats autorisés: jpg, png, jpeg, gif";
					}
				}else{
					$signUpError = "Le fichier transmis dépasse la limite autorisée(5Mo)";
				}
			}
			if($userManager->createUser($user)){
				$additionalScript = "<script>alert('Votre inscritpion est complétée.Vous pouvez désormais vous connecter');</script>";
			}else{
				$signUpError = "Une erreur inconnue est survenue. Veuillez réésayer ou contactez-nous";
			}	
		}    
		require_once'view/connection.php';
	}

	function signIn(){
		$user = new User($_POST);
		$userManager = new UserManager();
		$data = $userManager->getUserByNick($user);
		if($member = $data->fetch()){
			if(password_verify($user->getPassword(), $member['password'])){
				$user = new User($member);
				$_SESSION['user'] = $user;
				header('location: index.php?a=profile&id='.$_SESSION['user']->getId());
			}else{
				$error = "Le mot de passe est incorrect.";
			}
		}else{
			$error = "Cet identifiant n'existe pas.";
		}
		require_once'view/connection.php';
	}


	function viewProfile($id){
		$userManager = new UserManager();
		if($profile = $userManager->getUserById($id)){ 
			$itemManager = new ItemManager();
			$items = $itemManager->getItemsByUser($profile->getId());
			require_once 'view/profile.php';
		}else{
			require_once'view/404.php';
		}
		
	}

	function updateUser($userId){
		if($userId == $_SESSION['user']->getId() OR $_SESSION['user']->getStatus() == "admin"){
			$user = new User($_POST);
			$user->setId($userId);
			$userManager = new UserManager();
			$dbUser = $userManager->getUserById($userId);
			if(password_verify($user->getPassword(), $dbUser->getPassword())){

				if($_POST['newPassword'] != "" AND $_POST['newPassword'] == $_POST['newPassword2']){
					$user->setPassword($_POST['newPassword']);
				}

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
								if($dbUser->getAvatar() != "default.jpg"){
									unlink('public/img/items/' . $dbUser->getAvatar());
								}
							}else{
								$formError = "Le format du fichier transmis n'est pas autorisé.Formats autorisés: jpg, png, jpeg, gif";
								require_once'view/profile.php';
							}
					}else{
						$formError = "Le fichier transmis dépasse la limite autorisée(5Mo)";
						require_once'view/profile.php';
					}
				}else{
					$user->setAvatar($dbUser->getAvatar());
				}
			$userManager->updateUser($user);
			header('location:index.php?a=profile&id=' . $user->getId());
			}else{
				$formError = "Mot de passe erroné";
			}
		}
	}

	function deleteAccount($userId){
		if($userId == $_SESSION['user']->getId() OR $_SESSION['user']->getStatus() == "admin"){
			$userManager = new userManager();
			$member = $userManager->getUserById($userId);
			if($member->getAvatar() != "default.jpg"){
				unlink("public/img/avatars/" . $member->getAvatar());
			}

			$itemManager= new ItemManager();
			if($items = $itemManager->getItemsByUser($userId)){
				foreach ($items as $item) {
					unlink("public/img/items/" . $item->getPicture());
				}
			}

			$userManager->deleteUser($userId);
			header("location: index.php?a=signOut");
		}else{
			require_once'view/404.php';
		}

	}

	function signOut(){
		session_destroy();
		header('location:index.php?a=connection');
	}

	function viewAccount(){
		if (!isset($_SESSION['user'])) {
			require_once'view/404.php';
		}else{
			$supportManager = new SupportManager();
			if($supportRequests = $supportManager->getRequestsByUser()){
				require_once'view/account.php';
			}else{
				require_once'view/account.php';
			}
		}
	}


}