<?php 

class UserController{

	function signUp(){
		$user = new User($_POST);
		$userManager = new UserManager();
		$user->setAvatar('default.jpg');
		if(isset($_FILES['avatar']) AND $_FILES['avatar']['error'] == 0){
			if($_FILES['avatar']['size'] <= 1000000){
				$filename = $user->getNickname() . basename($_FILES['avatar']['name']);
				move_uploaded_file($_FILES['avatar']['tmp_name'], 'public/img/avatars/' . $filename);
				$user->setAvatar($filename);
			}
		}
		$userManager->newUser($user);    
	}

	function signIn(){
		$user = new User($_POST);
		$userManager = new UserManager();
		$data = $userManager->userConnect($user);
		if($member = $data->fetch()){
			if(password_verify($user->getPassword(), $member['password'])){
				$user = new User($member);
				$_SESSION['user'] = $user;
				header('location: index.php?a=home');
			}else{
				$error = "Le mot de passe est incorrect.";
			}
		}else{
			$error = "Cet identifiant n'existe pas.";
		}
		require_once'view/connection.php';
	}
}