<?php

$title = "404 - Cette page n'existe pas";

ob_start() ?>

<h1 id="title404">Y-a quelqu'un?</h1>

<p id="message404"> Il semblerait que vous vous êtes perdus. Pas de panique, cliquez <a href="index.php?a=home">ici</a> pour revenir vers l'accueil du site</p>

<?php $content = ob_get_clean();

require_once 'view/mainTemplate.php';