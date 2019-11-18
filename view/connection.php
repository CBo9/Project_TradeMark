<?php 

$title = "Se Connecter/S'Inscrire";

ob_start() ?>
<div class="container-flex">

	<form method="post" action="index.php?a=signUp" id ="signUpForm" class="redBgForm" enctype="multipart/form-data" onsubmit="return suubmit()">
		<h1>S'Inscrire</h1>
		<label for="firstName">Prénom</label>
		<input type="text" id="firstName" name="firstName" placeholder="Prénom" required>
		<br><br>
		<label for="lastName">Nom</label>
		<input type="text" id="lastName" name="lastName" placeholder="Nom" required>
		<br><br>
		<label for="email">Email</label>
		<input type="email" id="email" name="email" placeholder="Email" required>
		<br><br>
		<label for="nickname">Pseudo</label>
		<input type="text" id="nickname" name="nickname" placeholder="Pseudo" required>
		<br><br>
		<label for="password">Mot de passe</label>
		<input type="password" id="password1" name="password" placeholder="Mot de passe" required>
		<br><br>
		<label for="password2">Confirmation du mot de passe</label>
		<input type="password" id="password2" name="password2" placeholder="Confirmez votre mot de passe" required onchange="formValidation()">
		<label id="passwordError"></label> 
		<br><br><br>
		<label for="avatar" class="inputFileButton">Choisir un avatar(Optionnel)</label>
		<img src="#" id="avatarPreview" alt=" "> 
		<br><br><br><br>
		<input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg, .gif"  hidden>
		
		<input type="submit" value="S'INSCRIRE">
	</form>

	<form method="post" action="index.php?a=signIn" class="redBgForm" id="signInForm">
		<h1>Se connecter</h1>
		<label for="nickname">Pseudo</label>
		<input type="text" id="nickname" name="nickname" placeholder="Pseudo">
		<br><br>
		<label for="password">Mot de passe</label>
		<input type="password" id="password" name="password" placeholder="Mot de passe">
		<br><br>
		<input type="submit" value="SE CONNECTER">
		<?php if(isset($error)):?>
			<span id="connectionError"><?= $error;?></span>
		<?php endif;?>
	</form>
</div>

<?php $content = ob_get_clean();

require_once 'view/mainTemplate.php';