<?php
if(isset($_SESSION['user']) AND $profile->getId() == $_SESSION['user']->getId()){
	$title = "Mon profil";
}else{
	$title = "Profil de " . $profile->getNickname();

}

ob_start() ?>
<div id="profileInfo">
	<img src="public/img/avatars/<?= $profile->getAvatar();?>" class="avatar">
	<h1><?= ucfirst($profile->getNickname());?></h1>
</div>


<?php if(!empty($items)):
	echo '<div class="container-flex">';
	 foreach ($items as $item):?>
		<div class="myItem">
			<h4><?= $item->getName();?></h4>
			<?php if($item->getPicture()!= NULL):?>
				<img src="public/img/items/<?= $item->getPicture();?>" class="itemMiddlePic" alt="pas de photo pour <?= $item->getName();?>">
			<?php endif;?>
			<p><?= $item->getDescription();?></p>
			<?php if(isset($_SESSION['user']) AND $_SESSION['user']->getId() == $item->getOwnerId()):?>
				<a href="index.php?a=updateItemForm&itemId=<?= $item->getId();?>">Modifier</a>
				<a href="index.php?a=deleteItem&itemId=<?= $item->getId();?>">Supprimmer</a>
			<?php endif;?>
		</div>
	<?php endforeach;
	echo '</div>';
endif;

if(empty($items)){
	echo 'Aucun article pour le moment';
}

$content = ob_get_clean();
require_once 'view/mainTemplate.php';
