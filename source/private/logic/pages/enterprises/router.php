<?php

$path = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if (!isset($method)) {
    http_response_code(400);
    header("Location: /errors/HTTP400.html");
    exit;
}

if (!isset($path)) {
    http_response_code(500);
    header("Location: /errors/HTTP500.html");
    exit;
}

# *j'aime pas les regex, mais c'est pour la bonne cause*
if (preg_match('/^\/enterprise\/[0-9]+$/', $path)) {
    require_once('private/logic/pages/enterprises/details.php');
} else {
    require_once('private/logic/pages/enterprises/list.php');
}
