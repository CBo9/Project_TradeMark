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

	function  getUserById($id){
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM users WHERE id = :id');
		$request->execute(["id"=>$id]);
		if($data = $request->fetch()){
			$user = new User($data);
			return $user;
		}
	}

	function updateUser(User $user){
		$db = $this->dbConnect();
		$update = $db->prepare('UPDATE users SET nickname = :nick, firstName = :firstN, lastName = :lastN, email = :email, password = :password, avatar = :avatar WHERE id = :userId');
		$update->execute(["nick"=>$user->getNickname(),
						  "firstN"=>$user->getFirstName(),
						  "lastN"=>$user->getLastName(),
						  "email"=>$user->getEmail(),
						  "password"=>$user->getPassword(),
						  "avatar"=>$user->getAvatar(),
						  "userId"=>$_SESSION['user']->getId()]);
	}

	function getUserAvatar($userId){
		$db = $this->dbConnect();
		$avatar = $db->prepare("SELECT avatar FROM users WHERE id = :userId");
		$avatar->execute(["userId"=>$userId]);
		return $avatar;
	}

	function deleteUser($userId){
		$db = $this->dbConnect();
		$deletion = $db->prepare('DELETE FROM users WHERE id = :id');
		$deletion->execute(["id"=>$userId]);
	}

	function getUserNickname($userId){
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT nickname FROM users WHERE id = :userId');
		$request->execute(["userId"=>$userId]);
		if($user = $request->fetch()){
			$nickname = $user['nickname'];
			return $nickname;
		}
	}

	function countAllUsers(){
		$db = $this->dbConnect();
		$request = $db->prepare(" SELECT COUNT(*) as count FROM users");
		$request->execute();
		$data = $request->fetch();
		$count = $data['count'];
		return $count;
	}

	function getAllUsers(){
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM users');
		$request->execute();
		while($userData = $request->fetch()){
			$user = new User($userData);
			$allUsers[] = $user;
		}
		return $allUsers;
	}
	
}