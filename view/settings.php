<?php

$title = "Paramètres du compte";

ob_start()?>

<h1>Paramètres</h1>

<form method="post" action="index.php?a=" id ="signUpForm" class="redBgForm" enctype="multipart/form-data" onsubmit="return suubmit()">
	<h1>MES INFORMATIONS</h1>

	<label for="firstName">Prénom</label>
	<input type="text" id="firstName" name="firstName" placeholder="Prénom" required value="">

	<label for="lastName">Nom</label>
	<input type="text" id="lastName" name="lastName" placeholder="Nom" required value="">

	<label for="email">Email</label>
	<input type="email" id="email" name="email" placeholder="Email" required value="">

	<label for="nickname">Pseudo</label>
	<input type="text" id="nickname" name="nickname" placeholder="Pseudo" required value="">

	<label for="password1"> Nouveau mot de passe (optionnel)</label>
	<input type="password" id="password1" name="newPassword" placeholder="Nouveau mot de passe" value="">

	<label for="password2">Confirmation du nouveau mot de passe (optionnel)</label>
	<input type="password" id="password2" name="newPassword2" placeholder="Confirmez votre nouveau mot de passe"  oninput="formValidation()" value="">

	<label id="passwordError"></label> 

	<label for="currentPassword"> Mot de passe actuel</label>
	<input type="password" id="currentPassword" name="password" placeholder="Mot de passe actuel" required >

	<label for="avatar" class="inputFileButton">
	<span id="addFileText">Modifier votre avatar (optionnel)</span>
	<img class="avatar " src="public/img/avatars/<?= $user->getAvatar();?>" id="preview" alt=" ">
	</label>
	<input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg, .gif"  hidden onchange="avatarPreview()">

	<?php if(isset($signUpError)):?>
		<span id="signUpError"><?= $signUpError;?></span>
	<?php endif;?>

	<input type="submit" value="MODIFIER MES INFOS">
</form>

<?php
$content = ob_get_clean();

require_once'view/mainTemplate.php';

