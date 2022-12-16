<?php

require_once __DIR__ . '/../vendor/autoload.php';

const ENV_PATH = __DIR__ . '/..';

$dotenv = Dotenv\Dotenv::createImmutable(ENV_PATH);
$dotenv->load();
