<?php

$title = "Ajouter un article";

ob_start()?>

<h1><?= $titleAction;?> un article</h1>

<form method="POST" action="index.php<?= $formAction;?>" enctype="multipart/form-data" id="newItemForm" class="redBgForm">

	<label for="name">Nom</label>
	<input type="text" name="name" id="name" placeholder="Nom de votre article" required>

	<label for="description">Description</label>
	<textarea name="description" id="description" placeholder="Description rapide de votre article" required></textarea>

	<label for="picture" class="inputFileButton">Ajouter une photo de votre article</label>
	<input type="file" name="picture" id="picture" hidden aceept=".png, .gif, .jpeg" required>

	<input type="submit" value="Ajouter un article">
</form>

<?php
$content = ob_get_clean();

require_once'view/mainTemplate.php';

