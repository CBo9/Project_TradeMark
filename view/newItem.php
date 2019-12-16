<?php

$title = $titleAction . " un article";

ob_start()?>

<h1><?= $titleAction;?> un article</h1>

<form method="POST" action="index.php<?= $formAction;?>" enctype="multipart/form-data" id="newItemForm" class="redBgForm">

	<label for="name">Nom</label>
	<input type="text" name="name" id="name" placeholder="Nom de votre article" required>

	<label for="description">Description</label>
	<textarea name="description" id="description" placeholder="Description rapide de votre article" required></textarea>

	<label for="picture" class="inputFileButton">
		<span id="addFileText">><?= $titleAction;?> une photo de votre article</span>
		<img class="itemSmallPic " src="#" id="preview" alt=" ">
	</label>
	<input type="file" name="picture" id="picture" hidden accept=".png, .gif, .jpg" onchange="itemPicturePreview()">

	<input type="submit" value="Ajouter un article">
</form>


<?php
if (isset($pictureError)) {
	echo $pictureError;
}
$content = ob_get_clean();

if (isset($item)) :
ob_start();?>
<script> updateFormFill("<?= $item->getName()?>","<?= $item->getDescription()?>","<?= $item->getPicture();?>");</script>
<?php $additionalScript = ob_get_clean();
endif;

require_once'view/mainTemplate.php';