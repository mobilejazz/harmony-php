<?php

use Sample\controllers\IndexController;

require_once __DIR__ . '/../vendor/autoload.php';

$controller = new IndexController();
echo $controller->actionIndex();
