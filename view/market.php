<?php 

$title = "Marché";

ob_start();?>

<h1>Le Marché</h1>

<div id="marketItems">
	<?php
	foreach($items as $item):?>
		<div class="marketItem">
			<div class="marketInfos">
				<h1><?= $item->getName();?></h1>
				<div class="container-flex item-flex">
					<img src="public/img/items/<?= $item->getPicture()?>" class="marketPicture">
					<p><?= $item->getDescription()?></p>
				</div>
				<p>Proposé par <?= $item->getOwnerNickname()?></p>
			</div>

			<div class="marketContact">
				<a class="updateBtn" href="index.php?a=profile&id=<?= $item->getOwnerId()?>">VOIR LE PROFIL DE <?= strtoupper($item->getOwnerNickname())?></a>
				<?php if (isset($_SESSION['user'])) :?>
					<a href="index.php?a=chat&userId=<?= $item->getOwnerid()?>">Envoyer un message</a>
				<?php else:?>
					<a href="index.php?a=connection">Connectez-vous pour envoyer un message à <?= $item->getOwnerNickname()?></a>
				<?php endif;?>
			</div>
		</div>
	<?php endforeach;?>
</div>
<div id="paginationLinks">
	<?php if($currentPage >= 2):?>
		<a id="previousPage" class="paginationBtn" href="index.php?a=market&page=<?= $currentPage - 1 ?>">Page précédente</a>
	<?php endif;

	if($currentPage >= 1 AND $currentPage< $lastPage):?>
		<a id="nextPage" class="paginationBtn" href="index.php?a=market&page=<?= $currentPage + 1 ?>">Page suivante</a>
	<?php endif;?>
</div>

<?php $content = ob_get_clean();
require_once'view/mainTemplate.php';