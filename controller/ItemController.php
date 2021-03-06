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
		$itemsNumber = $itemManager->countAllItems();

		$userManager = new UserManager();
		$usersNumber = $userManager->countAllUsers();
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
		$itemManager = new ItemManager();
		$item = new Item($_POST);
		$item->setOwnerId($_SESSION['user']->getId());
		
		if(isset($_FILES['picture']) AND $_FILES['picture']['error'] == 0){
				if($_FILES['picture']['size'] <= 10000000){
					$fileInfos = pathinfo($_FILES['picture']['name']);
					$fileExtension = $fileInfos['extension'];
					$allowedExtensions =['png','jpg','jpeg','gif'];
					if(in_array($fileExtension, $allowedExtensions)){
						$now = new Datetime();
						$date = $now->format("dmY_His");
						$rawFilename = ucfirst($date . $item->getOwnerId() . basename($_FILES['picture']['name']));
						$filename = preg_replace('/\s+/', '', $rawFilename);
						move_uploaded_file($_FILES['picture']['tmp_name'], 'public/img/items/' . $filename);
						$item->setPicture($filename);
						$itemManager->createItem($item);
						header('location:index.php?a=profile&id='.$item->getOwnerId());
					}else{
						$pictureError = "Fichier non autorisé. Extensions autorisées : .jpg, .gif, .jpeg, .png";
						require_once'view/newItem.php';
					}
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
		$item->setOwnerId($itemOwner);

		if(isset($_SESSION['user']) AND $_SESSION['user']->getId() == $itemOwner){
			if(isset($_FILES['picture']) AND $_FILES['picture']['error'] == 0){
				if($_FILES['picture']['size'] <= 10000000){
					$fileInfos = pathinfo($_FILES['picture']['name']);
					$fileExtension = $fileInfos['extension'];
					$allowedExtensions =['png','jpg','jpeg','gif'];
					if(in_array($fileExtension, $allowedExtensions)){
						$now = new Datetime();
						$date = $now->format("dmY_His");
						$rawFilename = ucfirst($date . $item->getOwnerId() . basename($_FILES['picture']['name']));
						$filename = preg_replace('/\s+/', '', $rawFilename);
						move_uploaded_file($_FILES['picture']['tmp_name'], 'public/img/items/' . $filename);
						$item->setPicture($filename);
						$previousPicture = $itemManager->getItemPicture($item->getId());
						unlink('public/img/items/' . $previousPicture);
					}else{
						$error = "Fichier non autorisé. Extensions autorisées : .jpg, .gif, .jpeg, .png";
					}
				}else{
					$error = "La photo fournie est trop volumineuse";
				}
			}else{
				$picture = $itemManager->getItemPicture($item->getId());
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

	function showMarket(){
		$itemManager = new ItemManager();
		$itemsTotal = $itemManager->countAllItems();
		$itemsPerPage = 5;
		$lastPage = ceil(($itemsTotal / $itemsPerPage));


		$currentPage = isset($_GET['page'])  ? intval($_GET['page']) : 1;

		if($currentPage <= 0 OR $currentPage > $lastPage){
			header('location:index.php?a=error');
		}

		$items = $itemManager->getMarketItems(($currentPage - 1) * $itemsPerPage, $itemsPerPage);
		require_once'view/market.php';
	}


}