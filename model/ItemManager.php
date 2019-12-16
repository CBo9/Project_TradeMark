<?php

class ItemManager extends Manager{

	function createItem(Item $item){
		$db = $this->dbConnect();
		$insert = $db->prepare("INSERT INTO items (name, description, picture, ownerId) VALUES(:name, :descr, :pic, :ownerId)");
		$insert->execute(["name"=>$item->getName(),
						  "descr"=>$item->getDescription(),
						  "pic"=>$item->getPicture(),
						  "ownerId"=>$item->getOwnerId()]);
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

	function countAllItems(){
		$db = $this->dbConnect();
		$request = $db->prepare(" SELECT COUNT(*) as count FROM items");
		$request->execute();
		$data = $request->fetch();
		$count = $data['count'];
		return $count;
	}


	function getMarketItems($currentPage, $itemsPerPage){
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT items.*, users.nickname as ownerNickname FROM items INNER JOIN users ON users.id = items.ownerId  LIMIT $itemsPerPage OFFSET $currentPage");
		$request->execute();
		while ($itemData = $request->fetch()) {
			$item = new Item($itemData);
			$items[] = $item;
		}
		return $items;
	}
}