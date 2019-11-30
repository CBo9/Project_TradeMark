<?php

$title = "Profil de " . $profile->getNickname();

ob_start() ?>

<h1><?= $profile->getNickname();?></h1>

<?php $content = ob_get_clean();
require_once 'view/mainTemplate.php';
