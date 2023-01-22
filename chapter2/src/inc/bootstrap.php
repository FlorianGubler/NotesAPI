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

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__."/../model/"),
    isDevMode: true,
);

// configuring the database connection
$connection = DriverManager::getConnection([
    'host' => DB_HOST,
    'user' => DB_USERNAME,
    'password' => DB_PASSWORD,
    'dbname' => DB_DATABASE_NAME,
    'driver' => 'pdo_sqlite'
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);

// include the base controller file
require_once PROJECT_ROOT_PATH . "/controller/basecontroller.class.php";

// include the user model file
require_once PROJECT_ROOT_PATH . "/model/usermodel.class.php";

// include the note model file
require_once PROJECT_ROOT_PATH . "/model/notemodel.class.php";
