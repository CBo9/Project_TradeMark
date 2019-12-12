<?php 

$title = "Tous les " . $objectType;

ob_start() ?>
<a href="index.php?a=adminHome" class="backBtn">Retour vers l'accueil</a>
<h1>Tous les <?= $objectType;?></h1>
<table class="adminTable">
	
<?php
/*------ MEMBERS TABLE------*/
if (isset($allMembers)):?>
	<thead>
		<td>Id</td>
		<td>Pseudo</td>
		<td>Nom</td>
		<td>Prénom</td>
		<td>Avatar</td>
		<td>Statut</td>
		<td>Actions</td>
	</thead>
	<?php foreach ($allMembers as $member) :?>
		<tr>
			<td><?= $member->getId()?></td>
			<td><?= $member->getNickname()?></td>
			<td><?= $member->getLastName()?></td>
			<td><?= $member->getFirstName()?></td>
			<td><img class="smallAvatar" src="public/img/avatars/<?= $member->getAvatar()?>"></td>
			<td><?= $member->getStatus()?></td>
			<td><span class="updateBtn">MODIFIER</span><span class="deleteBtn">SUPPRIMER</span>
		</tr>
	<?php endforeach;
endif;
/*------ SUPPORT TABLE------*/
if(isset($allRequests)):?>
	<thead>
		<td>Id</td>
		<td>Membre</td>
		<td>Date de publication</td>
		<td>Statut</td>
		<td>Actions</td>
	</thead>
	<?php foreach ($allRequests as $request) :?>
		<tr>
			<td><?= $request->getId()?></td>
			<td><?= $request->getUserName()?></td>
			<td><?= $request->getStartDate()?></td>
			<td><?= $request->getStatus()?></td>
			<td><span class="updateBtn">RÉPONDRE</span><span class="deleteBtn">SUPPRIMER</span>
		</tr>
	<?php endforeach;
endif;?>
</table>

<?php $content = ob_get_clean();

require_once 'view/adminTemplate.php';