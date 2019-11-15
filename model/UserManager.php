<?php
require_once'model/Manager.php';


class UserManager extends Manager{


	function newUser(User $user){
		$db = $this->dbConnect();
		$insert = $db->prepare('INSERT INTO users (nickname, firstName, lastName, email, password, avatar) VALUES (:nickname, :firstName,:lastName, :email, :password, :avatar)');
		$insert->execute([  "nickname"=>$user->getNickname(),
							"firstName"=>$user->getFirstName(),
							"lastName"=>$user->getLastName(),
							"email"=>$user->getEmail(),
							"password"=>$user->getPassword(),
							"avatar"=>$user->getAvatar()]);
	}
}