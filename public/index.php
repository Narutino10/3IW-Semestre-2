<?php

require __DIR__ . '/../vendor/autoload.php';

// Création d'une nouvelle instance de l'application.
$app = new App();

// Activation du mode débogage.
$app->debug(true);

// Activation de la gestion des erreurs.
$app->error_reporting();

// Lancement de l'application.
$app->run();
