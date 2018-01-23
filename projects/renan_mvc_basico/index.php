<?php

define ('DS',DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));

require_once 'controller'.DS.'CrudController.php';

$controller = new CrudController();

$controller->request();
