<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";

// include the base controller file
require_once PROJECT_ROOT_PATH . "/controller/basecontroller.class.php";

// include the user model file
require_once PROJECT_ROOT_PATH . "/model/usermodel.class.php";

// include the note model file
require_once PROJECT_ROOT_PATH . "/model/notemodel.class.php";
