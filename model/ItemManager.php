<?php

class ItemManager extends Manager{

	function createItem(Item $item){
		$db = $this->dbConnect();
		$insertion = $db->prepare("INSERT INTO items (ownerId, name, description, picture) VALUES (:ownerId, :name, :description, :picture)");
		$insertion->execute(["ownerId"=>$_SESSION['user']->getId(),
							 "name"=>$item->getName(),
							 "description"=>$item->getDescription(),
							 "picture"=>$item->getPicture()]);
	}

	function updateItem(Item $item){
		$db = $this->dbConnect();
		$update = $db->prepare("UPDATE items SET name = :name, description = :descr, picture = :picture WHERE id = :itemId");
		$update->execute(["name"=>$item->getName(),
						  "descr"=>$item->getDescription(),
						  "picture"=>$item->getPicture(),
						  "itemId"=>$item->getId()]);
	}

	function deleteItem($itemId){
		$db = $this->dbConnect();
		$deletion = $db->prepare('DELETE FROM items WHERE id = :id');
		$deletion->execute(["id"=>$itemId]);
	}

	function getItemsByUser($userId){
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT * FROM items WHERE ownerId = :userId");
		$request->execute(["userId"=>$userId]);
		while($itemData = $request->fetch()){
			${'item'.$itemData['id']} = new Item($itemData);
			$items[] = ${'item'.$itemData['id']};
		}
		return $items;
	}

	function getItemById($itemId){
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT * FROM items WHERE id = :id");
		$request->execute(["id"=>$itemId]);
		return $request;
	}

	function getUserIdByItem($itemId){
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT ownerId FROM items WHERE id = :id");
		$request->execute(["id"=>$itemId]);
		if($user = $request->fetch()){
			$userId = $user['ownerId'];
		}else{
			$userId = "not found";
		}
		return $userId;
	}

	function getItemPicture($itemId){
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT picture FROM items WHERE id = :id");
		$request->execute(["id"=>$itemId]);
		if($item = $request->fetch()){
			$picture = $item['picture'];
		}
		return $picture;
	}

	function getLastItems($itemsNb){
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT items.*, users.nickname as ownerNickname FROM items INNER JOIN users ON users.id = items.ownerId ORDER BY addingDate DESC LIMIT $itemsNb ");
		$request->execute();
		while($itemData = $request->fetch()){
			$item = new Item($itemData);
			$items[] = $item;
		}
		return $items;
	}
}