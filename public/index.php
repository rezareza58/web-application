<?php 

require_once __DIR__.'/../vendor/autoload.php';
$configs= require __DIR__.'/../config/config.php';

use Service\DBConnector;
Service\DBConnector::setconfig($configs['db']);

