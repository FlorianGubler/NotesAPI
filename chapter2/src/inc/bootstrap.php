<?php

//Config
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";

//Doctrine
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__."/../../vendor/autoload.php";

$paths = [__DIR__.'/../model'];
$isDevMode = false;

// the connection configuration
$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => DB_USERNAME,
    'password' => DB_PASSWORD,
    'dbname'   => DB_DATABASE_NAME,
    'host' => DB_HOST
];

$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);

// include the base controller file
require_once PROJECT_ROOT_PATH . "/controller/basecontroller.class.php";

// include the user model file
require_once PROJECT_ROOT_PATH . "/model/usermodel.class.php";

// include the note model file
require_once PROJECT_ROOT_PATH . "/model/notemodel.class.php";
