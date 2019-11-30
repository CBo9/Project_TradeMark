<?php

class UserManager extends Manager{


	function createUser(User $user){
		$db = $this->dbConnect();
		$insert = $db->prepare('INSERT INTO users (nickname, firstName, lastName, email, password, avatar) VALUES (:nickname, :firstName,:lastName, :email, :password, :avatar)');
		$insert->execute([  "nickname"=>$user->getNickname(),
							"firstName"=>$user->getFirstName(),
							"lastName"=>$user->getLastName(),
							"email"=>$user->getEmail(),
							"password"=>password_hash($user->getPassword(), PASSWORD_DEFAULT),
							"avatar"=>$user->getAvatar()]);
	}


	function getUserByNick(User $user){
		$db = $this->dbConnect();
		$member = $db->prepare('SELECT * FROM users WHERE nickname = :nickname');
		$member->execute(["nickname"=>$user->getNickname()]);
		return $member;
	}

	function getUserById($id){
		$db = $this->dbConnect();
		$user = $db->prepare('SELECT * FROM users WHERE id = :id');
		$user->execute(["id"=>$id]);
		return $user;
	}

	function deleteUser($userId){
		$db = $this->dbConnect();
		$deletion = $db->prepare('DELETE FROM users WHERE id = :id');
		$deletion->execute(["id"=>$userId]);
	}
}