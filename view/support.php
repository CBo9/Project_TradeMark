<?php
$title = "Support";

ob_start() ?>

<h1>Bienvenue sur le support</h1>

<p>Si vous cherchez une information, elle se trouve peut-être dans la <a href="#">FAQ</a>. Sinon, vous pouvez remplir le formulaire ci-dessous pour contacter notre support qui vous répondra dans un délai de 24h maximum.</p>

<form method="POST" action="index.php?a=newRequest" id="supportForm">
	<label for="title">Objet</label>
	<input type="text" id="title" name="title" placeholder="Objet">

	<label for="request">Requête</label>
	<textarea name="request" id="request" class="txtArea" placeholder="Écrivez votre requête ici (500 caractères max.)"></textarea>

	<input type="submit" value="ENVOYER MA REQUÊTE">
</form> 


<?php $content = ob_get_clean();
require_once'view/mainTemplate.php';