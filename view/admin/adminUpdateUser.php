<?php
$title = "Modification de membre";

ob_start();?>


<form method="post" action="index.php?a=adminUpdateUser&id=<?= $user->getId()?>" id ="signUpForm" class="redBgForm" enctype="multipart/form-data" >
		<h1>MODIFICATION DES INFORMATIONS DE <?= strtoupper($user->getNickname())?></h1>

		<label for="firstName">Prénom</label>
		<input type="text" id="firstName" name="firstName" placeholder="Prénom" required value="<?= $user->getFirstName();?>">

		<label for="lastName">Nom</label>
		<input type="text" id="lastName" name="lastName" placeholder="Nom" required value="<?= $user->getLastName();?>">

		<label for="email">Email</label>
		<input type="email" id="email" name="email" placeholder="Email" required value="<?= $user->getEmail();?>">

		<label for="nickname">Pseudo</label>
		<input type="text" id="nickname" name="nickname" placeholder="Pseudo" required value="<?= $user->getNickname();?>">

		<label for="avatar" class="inputFileButton">
		<span id="addFileText">Modifier votre avatar (optionnel)</span>
		<img class="avatar " src="public/img/avatars/<?= $user->getAvatar();?>" id="preview" alt=" ">
		</label>
		<span id="emptyAvatar" onclick="deleteFile()">Avatar par défaut</span>
		<input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg, .gif"  hidden onchange="avatarPreview()">

		<input type="submit" value="MODIFIER">
	</form>


	<?php $content = ob_get_clean();

	require_once $this->viewPath.'adminTemplate.php';