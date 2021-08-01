<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'dbConnProp.php';
use Classes\Database;
use Classes\Controller;

$database = new Database(SERVERNAME, USERNAME, PASSWORD, DATABASENAME);
$controller = new Controller($database);