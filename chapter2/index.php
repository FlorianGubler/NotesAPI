<?php
require __DIR__ . "\src\inc\bootstrap.php";
require PROJECT_ROOT_PATH . "/controller/usercontroller.class.php";
require PROJECT_ROOT_PATH . "/controller/notecontroller.class.php";

define("ENDPOINTS", [
    "user" => new UserController($entityManager),
    "note" => new NoteController($entityManager)
]);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

for ($i = count($uri) - 1; $i >= 0; $i--) {
    if (array_key_exists($uri[$i], ENDPOINTS)) {
        $strMethodName = $_SERVER['REQUEST_METHOD'];
        $objFeedController = ENDPOINTS[$uri[$i]];
        $objFeedController->{$strMethodName}();
        exit;
    }
}

//Not Endpoint found
header("HTTP/1.1 404 Not Found");
exit();
