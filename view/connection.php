<?php 

$title = "Se Connecter/S'Inscrire";

ob_start() ?>

<h1>Se connecter</h1>

<form method="post" action="index.php?a=signIn" class="redBgForm">
	<label for="login">Pseudo</label>
	<input type="text" id="login" name="login" placeholder="Pseudo">
	<br><br>
	<label for="password">Mot de passe</label>
	<input type="text" id="password" name="password" placeholder="Password">
	<br><br>
	<input type="submit" value="SE CONNECTER">
</form>

<h1>Se connecter</h1>

<form method="post" action="index.php?a=signAA" class="redBgForm">
	<label for="login">Pseudo</label>
	<input type="text" id="login" name="login" placeholder="Pseudo">
	<br><br>
	<label for="password">Mot de passe</label>
	<input type="text" id="password" name="password" placeholder="Mot de passe">
	<br><br>
	<label for="email">Email</label>
	<input type="text" id="email" name="email" placeholder="Email">
	<br><br>
	<input type="submit" value="S'INSCRIRE">
</form>


<?php $content = ob_get_clean();

require_once 'view/mainTemplate.php';