<?php 

$title = "Se Connecter/S'Inscrire";

ob_start() ?>
<div class="container-flex" id="connectionPage">

	<form method="post" action="index.php?a=signIn" class="redBgForm" id="signInForm">
		<h1>Se connecter</h1>
		<label for="nickname">Pseudo</label>
		<input type="text" id="nickname" name="nickname" placeholder="Pseudo">
		<label for="password">Mot de passe</label>
		<input type="password" id="password" name="password" placeholder="Mot de passe">
		<input type="submit" value="SE CONNECTER">
		<?php if(isset($error)):?>
			<span id="connectionError"><?= $error;?></span>
		<?php endif;?>
	</form>

	<form method="post" action="index.php?a=signUp" id ="signUpForm" class="redBgForm" enctype="multipart/form-data" onsubmit="return suubmit()">
		<h1>S'Inscrire</h1>
		<label for="firstName">Prénom</label>
		<input type="text" id="firstName" name="firstName" placeholder="Prénom" required>
		<label for="lastName">Nom</label>
		<input type="text" id="lastName" name="lastName" placeholder="Nom" required>
		<label for="email">Email</label>
		<input type="email" id="email" name="email" placeholder="Email" required>
		<label for="nickname">Pseudo</label>
		<input type="text" id="nickname" name="nickname" placeholder="Pseudo" required>
		<label for="password">Mot de passe</label>
		<input type="password" id="password1" name="password" placeholder="Mot de passe" required>
		<label for="password2">Confirmation du mot de passe</label>
		<input type="password" id="password2" name="password2" placeholder="Confirmez votre mot de passe" required oninput="formValidation()">
		<label id="passwordError"></label> 
		<label for="avatar" class="inputFileButton">
			
			<span id="addFileText">Ajouter un avatar (optionnel)</span>
			<img class="avatar " src="public/img/avatars/default.jpg" id="preview" alt=" ">
		</label>
		<input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg, .gif"  hidden onchange="avatarPreview()">
		<span id="emptyAvatar" onclick="deleteFile()">Avatar par défaut</span>
		<?php if(isset($signUpError)):?>
			<span id="signUpError"><?= $signUpError;?></span>
		<?php endif;?>

		<input type="submit" value="S'INSCRIRE">
	</form>
</div>

<?php $content = ob_get_clean();

require_once 'view/mainTemplate.php';