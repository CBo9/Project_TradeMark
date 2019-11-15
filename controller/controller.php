<?php 
require_once'class/User.php';
require_once'model/UserManager.php';


class Controller{

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
}