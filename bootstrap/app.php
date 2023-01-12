<?php

use System\Route;
use System\Routing;

ini_set('display_errors', 1);

/**
 * load configs
 */
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';


$routing = new Routing();

$routing->run();










