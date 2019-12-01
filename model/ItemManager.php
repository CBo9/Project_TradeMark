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

	function updateItem(){

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
}