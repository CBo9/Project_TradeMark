<?php

class ItemController{

	/*------ITEM VIEWS------*/
	function showCurrentItems(){
		$itemManager = new ItemManager();
		$items = $itemManager->getItemsByUser($_SESSION['user']->getId());
		require_once 'view/manageItems.php';
	}

	function showHome(){
		$itemManager = new ItemManager();
		$lastItems = $itemManager->getLastItems(5);
		require_once'view/home.php';
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
				$formAction = "?a=updateItem&itemId=" . $item->getId(); 
				require_once"view/newItem.php";
			}else{
				$error = "Vous n'êtes pas autorisé à modifier cet article!";
				require_once'view/404.php';
			}
		}else{
			require_once'view/404.php';
		}
	}

	/*------ITEM ACTIONS------*/
	function addItem(){
		$item = new Item($_POST);
		$itemManager = new ItemManager();

		if(isset($_FILES['picture']) AND $_FILES['picture']['error'] == 0){
				if($_FILES['picture']['size'] <= 10000000){
					$rawFilename = ucfirst($item->getName() . basename($_FILES['picture']['name']));
					$filename = preg_replace('/\s+/', '', $rawFilename);
					move_uploaded_file($_FILES['picture']['tmp_name'], 'public/img/items/' . $filename);
					$item->setPicture($filename);
					$itemManager->createItem($item);
					header('location:index.php?a=profile&id='.$_SESSION['user']->getId());
				}else{
					$pictureError = "Le fichier transmis dépasse la limite autorisée(1Mo)";
					require_once'view/newItem.php';
				}
		}else{
			require_once'view/newItem.php';
		}
	}


	function updateItem($itemId){
		$itemManager = new ItemManager();
		$item = new Item($_POST);
		$item->setId($itemId);
		$itemOwner = $itemManager->getUserIdByItem($itemId);
		if(isset($_SESSION['user']) AND $_SESSION['user']->getId() == $itemOwner){
			if(isset($_FILES['picture']) AND $_FILES['picture']['error'] == 0){
				if($_FILES['picture']['size'] <= 5000000){
					$rawFilename = ucfirst($item->getName() . basename($_FILES['picture']['name']));
					$filename = preg_replace('/\s+/', '', $rawFilename);
					move_uploaded_file($_FILES['picture']['tmp_name'], 'public/img/items/' . $filename);
					$item->setPicture($filename);
					$previousPicture = $itemManager->getItemPicture($item->getId());
					unlink('public/img/items/'.$previousPicture);
				}else{
					$error = "La photo fournie est trop volumineuse";
				}
			}else{
				$picture = $itemManager->getItemPicture($itemId);
				$item->setPicture($picture);
			}
			$itemManager->updateItem($item);
			header("location:index.php?a=profile&id=" . $_SESSION['user']->getId());
		}else{
			$error = "Vous ne pouvez pas modifier un article qui ne vous appartiens pas!";
			require_once'view/404.php';
		}
	}

	function deleteItem($itemId){
		$itemManager = new ItemManager();
		$itemUserId = $itemManager->getUserIdByItem($itemId);
		
		if(isset($_SESSION['user']) AND $_SESSION['user']->getId() == $itemUserId){
			$picture = $itemManager->getItemPicture($itemId);
			$itemManager->deleteItem($itemId);
			unlink('public/img/items/' . $picture);
			header("location:index.php?a=profile&id=" . $_SESSION['user']->getId());
		echo $itemUserId;	
		}else{
			require_once 'view/404.php';
		}
	}


}