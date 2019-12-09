<?php
if(isset($_SESSION['user']) AND $profile->getId() == $_SESSION['user']->getId()){
	$title = "Mon profil";
}else{
	$title = "Profil de " . $profile->getNickname();

}

ob_start() ?>
<div id="profileHeader">
	<img src="public/img/avatars/<?= $profile->getAvatar();?>" class="avatar">
	<h1><?= ucfirst($profile->getNickname());?></h1>
</div>



<?php if(isset($_SESSION['user'])):
	if($profile->getId() == $_SESSION['user']->getId()):?>
		<div id="addNewItem">
			<a id="addItemIcon" href="index.php?a=newItem">+</a>
			<span id="addItemText">Ajouter un article</span>
		</div>
	<?php else:?>
		<a href="index.php?a=chat&amp;userId=<?= $profile->getId();?>"><button>ENVOYER UN MESSAGE</button></a>
	<?php endif;
else:?>
	<a href="index.php?a=connection">Connectez-vous pour pouvoir envoyer un message</a> 
<?php endif;?>

<?php if(!empty($items)):
	echo '<div class="container-flex" id="ItemShelf">';
	 foreach ($items as $item):?>
		<div class="myItem">
			<h4><?= $item->getName();?></h4>
			<?php if($item->getPicture()!= NULL):?>
				<img src="public/img/items/<?= $item->getPicture();?>" class="itemMiddlePic" alt="pas de photo pour <?= $item->getName();?>">
			<?php endif;?>
			<p><?= $item->getDescription();?></p>
			<?php if(isset($_SESSION['user']) AND $_SESSION['user']->getId() == $item->getOwnerId()):?>
				<a class='updateBtn' href="index.php?a=updateItemForm&amp;itemId=<?= $item->getId();?>">
					Modifier
				</a>
				<a id="deleteItem<?= $item->getID();?>"  class="deleteBtn"  onclick="deleteItem(<?= $item->getId();?>)">
					Supprimer
				</a>
			<?php endif;?>
		</div>
	<?php endforeach;
	echo '</div>';
endif;

if(empty($items)){
	echo '<p>Aucun article pour le moment</p>';
}?>




<?php
$content = ob_get_clean();
require_once 'view/mainTemplate.php';
