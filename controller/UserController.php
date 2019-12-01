<?php 

class UserController{

	function signUp(){
		$user = new User($_POST);
		$userManager = new UserManager();
		$user->setAvatar('default.jpg');
		$confirmNickname = $userManager->getUserByNick($user);
		if($nicknameTaken = $confirmNickname->fetch()){
			$signUpError = "Ce pseudo est déjà utilisé";
			require_once'view/connection.php';	
		}else{
			if(isset($_FILES['avatar']) AND $_FILES['avatar']['error'] == 0){
				if($_FILES['avatar']['size'] <= 1000000){
					$filename = $user->getNickname() . basename($_FILES['avatar']['name']);
					move_uploaded_file($_FILES['avatar']['tmp_name'], 'public/img/avatars/' . $filename);
					$user->setAvatar($filename);
					$userManager->createUser($user);
				}else{
					$signUpError = "Le fichier transmis dépasse la limite autorisée(1Mo)";
					require_once'view/connection.php';
				}
			}else{
				$userManager->createUser($user);
			}
		}    
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
		$userData = $userManager->getUserById($id);
		if($userData = $userData->fetch()){
			$profile = new User($userData);

			$itemManager = new ItemManager();
			$items = $itemManager->getItemsByUser($profile->getId());
			require_once 'view/profile.php';
		}else{
			require_once'view/404.php';
		}
		
	}

	function deleteAccount($userId){
		$userManager = new userManager();
		$userManager->deleteUser($userId);
	}

	function signOut(){
		session_destroy();
		header('location:index.php?a=connection');
	}
}