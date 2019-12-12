<?php

$title = "Administration du site";

ob_start()?>

<h1>Bienvenue <?= $_SESSION['user']->getNickname(); ?></h1>
<p>
	<a href="index.php?a=viewAllMembers">Voir les membres</a>
	<span>Total de membres: <?= $usersTotal; ?></span>
</p>
<p>
	<a href="index.php?a=viewAllRequests">Voir les requêtes au support</a>
	<p>Total de requêtes faites: <?= $requestsTotal; ?></p>
	<p>Total de requêtes en attente de réponse par un admin: <?= $reqWaitingAdmin; ?></p>
</p>

<?php
$content = ob_get_clean();

require'view/adminTemplate.php';