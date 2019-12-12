<?php 

$title = "Bienvenue sur le site";

ob_start() ?>
<div id="maincontent">
	
	<div id="siteHowTo">
		<h1>Déjà <?= $usersNumber;?> membres ont mis en ligne <?= $itemsNumber;?> objets!</h1>

			<ol>
				<li><a href="index.php?a=connection">Inscrivez-vous</a> (si ce n'est pas déjà fait) puis <a href="index.php?a=connection">connectez-vous</a>!</li>
				<li>Cliquez sur "Mon Profil" dans le memu latéral</li>
				<li>Ajouter vos objets sur votre profil en cliquant sur le <span id="plusIcon">+</span></li>
				<li>
			</ol>
	</div>

	<div id="lastItemsAdded">
		<h2>Derniers articles ajoutés</h2>
		<?php foreach ($lastItems as $item) :?>
			<div class='lastItem'>
				<img class="itemSmallPic" src="public/img/items/<?= $item->getPicture();?>">
				<h3><?= $item->getName();?></h3>
				<span>Mis en ligne par 
					<a href="index.php?a=profile&amp;id=<?= $item->getOwnerId();?>">
						<?= $item->getOwnerNickname();?>
					</a>
				</span>
			</div>
		<?php endforeach;?>
	</div>

</div>
<?php $content = ob_get_clean();

require_once 'view/mainTemplate.php';