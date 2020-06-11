<?php

$title = "Mon compte";

ob_start()?>

<h1>Mon compte</h1>
<div class="container-flex" id="accountSettings">
	<form method="post" action="index.php?a=updateUser&id=<?= $_SESSION['user']->getId()?>" id ="signUpForm" class="redBgForm" enctype="multipart/form-data" >
		<h1>MES INFORMATIONS</h1>

		<label for="firstName">Prénom</label>
		<input type="text" id="firstName" name="firstName" placeholder="Prénom" required value="<?= $_SESSION['user']->getFirstName();?>">

		<label for="lastName">Nom</label>
		<input type="text" id="lastName" name="lastName" placeholder="Nom" required value="<?= $_SESSION['user']->getLastName();?>">

		<label for="email">Email</label>
		<input type="email" id="email" name="email" placeholder="Email" required value="<?= $_SESSION['user']->getEmail();?>">

		<label for="nickname">Pseudo</label>
		<input type="text" id="nickname" name="nickname" placeholder="Pseudo" required value="<?= $_SESSION['user']->getNickname();?>">

		<label for="password1"> Nouveau mot de passe (optionnel)</label>
		<input type="password" id="password1" name="newPassword" placeholder="Nouveau mot de passe" value="">

		<label for="password2">Confirmation du nouveau mot de passe (optionnel)</label>
		<input type="password" id="password2" name="newPassword2" placeholder="Confirmez votre nouveau mot de passe"  oninput="formValidation()" value="">

		<label id="passwordError"></label> 

		<label for="currentPassword"> Mot de passe actuel (requis pour toute modification)</label>
		<input type="password" id="currentPassword" name="password" placeholder="Mot de passe actuel" required >

		<label for="avatar" class="inputFileButton">
		<span id="addFileText">Modifier votre avatar (optionnel)</span>
		<img class="avatar " src="public/img/avatars/<?= $_SESSION['user']->getAvatar();?>" id="preview" alt=" ">
		</label>
		<span id="emptyAvatar" onclick="deleteFile()">Avatar par défaut</span>
		<input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg, .gif"  hidden onchange="avatarPreview()">

		<input type="submit" value="MODIFIER MES INFOS">
	</form>

	<div id="myRequests">
		<h1>Mes requêtes au support</h1>
		<?php if (!empty($supportRequests)) :
			foreach ($supportRequests as $request): ?>
			<div class="request">
				<a href="index.php?a=viewRequest&reqId=<?= $request->getId();?>"><?= $request->getTitle();?></a>
				<p>blablabla</p>
				<p>
					<?php if($request->getStatus() != 'resolved'):?>
						En attente de <?= $request->getStatus()?>
					<?php else:?>
						Résolu
					<?php endif;?>
				</p>
			</div>
			<?php endforeach;
		else:?>
		<p>Aucune requête au support</p> 
		<?php endif;?>
		
	<a href="index.php?a=support" class="updateBtn">Envoyer une requête au support</a>	
	</div>

	<a id="deleteBtn" class="deleteBtn" onclick="deleteAccount(<?= $_SESSION['user']->getId()?>)">Supprimer mon compte</a>
</div>
<?php
$content = ob_get_clean();

require_once'view/mainTemplate.php';

