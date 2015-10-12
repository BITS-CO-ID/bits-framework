<?php
session_start();
require_once __DIR__.'/vendor/autoload.php';

/**
 * Routes of the apps.
 * Handle all routes of the apps in (app/controllers/routes.php).
 * @var Klein
 */
$route = new Klein\Klein();
require_once 'app/controllers/routes.php';
$route->dispatch();
