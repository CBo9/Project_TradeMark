<?php

class ItemController{

	function addItem(){
		$item = new Item($_POST);
		$itemManager = new ItemManager();

		if(isset($_FILES['picture']) AND $_FILES['picture']['error'] == 0){
				if($_FILES['picture']['size'] <= 1000000){
					$filename = $item->getName() . basename($_FILES['picture']['name']);
					move_uploaded_file($_FILES['picture']['tmp_name'], 'public/img/items/' . $filename);
					$item->setPicture($filename);
					$itemManager->createItem($item);
					header('location:index.php?a=manageItems');
				}else{
					$pictureError = "Le fichier transmis dépasse la limite autorisée(1Mo)";
					require_once'view/newItem.php';
				}
		}else{
			require_once'view/newItem.php';
		}
	}

	function showCurrentItems(){
		$itemManager = new ItemManager();
		$items = $itemManager->getItemsByUser($_SESSION['user']->getId());
		require_once 'view/manageItems.php';
	}

	/*------ITEM FORMS------*/
	function newItem(){
		$titleAction = "Ajouter";
		$formAction = "?a=addItem";
        require_once'view/newItem.php';
	}

	function updateItemForm($itemId){
		$itemManager = new ItemManager();
		$itemData = $itemManager->getItemById($itemId);
		if($item = $itemData->fetch()){
			$item = new Item($item);
			if($_SESSION['user']->getId() == $item->getOwnerId()){
				$titleAction ="Modifier";
				$formAction = "?a=updateItem&amp;itemId=" . $item->getId(); 
				require_once"view/newItem.php";
			}else{
				$error = "Vous n'êtes pas autorisé à modifier cet article!";
				require_once'view/404.php';
			}
		}else{
			require_once'view/404.php';
		}
	}

	function updateItem($itemId){
		$itemManager = new ItemManager();
		$item = new Item($_POST);
		if(isset($_FILES['picture']) AND $_FILES['picture']['error'] == 0){
			if($_FILES['picture']('size') <= 5000000){
				$filename = $item->getName() . basename($_FILES['picture']['name']);
				move_uploaded_file($_FILES['picture']['tmp_name'], 'public/img/items/' . $filename);
				$item->setPicture($filename);
			}else{
				$error = "La photo fournie est trop volumineuse";
			}
		}else{
			$picture = $itemManager->getItemPicture($itemId);
			$item->setPicture($picture);
		}
		$itemManager->updateItem($item);
		header("location:index.php?a=profile&amp;id=" . $_SESSION['user']->getId());
	}

	function deleteItem($itemId){
		$itemManager = new ItemManager();
		$picture = $itemManager->getItemPicture($itemId);
		$itemManager->deleteItem($itemId);
		unlink('public/img/items/' . $picture);
	}


}