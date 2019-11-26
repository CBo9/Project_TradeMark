<?php

class UserManager extends Manager{


	function newUser(User $user){
		$db = $this->dbConnect();
		$insert = $db->prepare('INSERT INTO users (nickname, firstName, lastName, email, password, avatar) VALUES (:nickname, :firstName,:lastName, :email, :password, :avatar)');
		$insert->execute([  "nickname"=>$user->getNickname(),
							"firstName"=>$user->getFirstName(),
							"lastName"=>$user->getLastName(),
							"email"=>$user->getEmail(),
							"password"=>password_hash($user->getPassword(), PASSWORD_DEFAULT),
							"avatar"=>$user->getAvatar()]);
	}


	function userConnect(User $user){
		$db = $this->dbConnect();
		$connect = $db->prepare('SELECT * FROM users WHERE nickname = :nickname');
		$connect->execute(["nickname"=>$user->getNickname()]);
		return $connect;
	}
}