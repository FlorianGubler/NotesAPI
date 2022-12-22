<?php
require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/controller/usercontroller.class.php";

define("ENDPOINTS", [
    "user" => new UserController()
]);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

foreach ($uri as $key => $uri_part) {
    if (array_key_exists($uri_part, ENDPOINTS)) {
        $strMethodName = $uri[$key + 1] . 'Action';
        $objFeedController = ENDPOINTS[$uri_part];
        $objFeedController->{$strMethodName}();
        exit;
    }
}

//Not Endpoint found
header("HTTP/1.1 404 Not Found");
exit();
