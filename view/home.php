<?php 

$title = "Bienvenue sur le site";

ob_start() ?>
<h1 class="underlined" id="homeTitle">Donnez, échanger ou vendez vos biens devenus inutiles qui encombrent votre intérieur et faites des heureux!</h1>
<div id="homeContent">
	
	<div id="homeLeftContainer">	

		<h2>Déjà <span><?= $usersNumber;?> membres</span> ont mis en ligne <span><?= $itemsNumber;?> objets!</span> </h2>


		<div id="howTo">
			<h3>Comment ça marche?</h3>
			<ol>
				<li><a href="index.php?a=connection">Inscrivez-vous</a> (si ce n'est pas déjà fait) puis <a href="index.php?a=connection">connectez-vous</a>!</li>
				<li>Cliquez sur "Mon Profil" dans le menu latéral</li>
				<li>Ajouter vos objets sur votre profil en cliquant sur le <span id="icon">+</span></li>
				<li>Faites votre marché sur la page <a href="index.php?a=market"> Market </a> et trouvez des objets qui vous intéressent</li>
				<li>Contactez leur propriétaire pour poser des questions, botenirs des informations et donner votre coordonnées pour recevoir votre article chez vous</li>
			</ol>
		</div>

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