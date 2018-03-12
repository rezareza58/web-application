<?php
require_once __DIR__ .'/../../vendor/autoload.php';
$configs = require __DIR__.'/../../config/app.conf.php';
use Service\DBConnector;
Service\DBConnector::setConfig($configs['db']);
?>