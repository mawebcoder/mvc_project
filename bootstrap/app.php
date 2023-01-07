<?php

use System\Route;

ini_set('display_errors', 1);

/**
 * load configs
 */
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';


/**
 * load define routes routes
 */
require_once __DIR__ . '/../route/web.php';


header('Content-Type:application/json',true,201);







