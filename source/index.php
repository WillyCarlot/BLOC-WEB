<?php

# Définir les routes les plus spécifiques en premier
# '/' doit toujours être en dernier
$routes = [
    'GET' => [
        '/about' => 'private/logic/pages/about.php',                    # --Single pages--
        '/login' => 'private/logic/pages/login.php',                    #
        '/me' => 'private/logic/pages/me.php',                          #
        '/wishlist' => 'private/logic/pages/wishlist.php',              #
        '/applications' => 'private/logic/pages/applications.php',      #
        '/enterprises' => 'private/logic/pages/enterprises/router.php', # --Routers-------
        '/offers' => 'private/logic/pages/offers/router.php',           #
        '/users' => 'private/logic/pages/users.php',             #
        '/api' => 'private/logic/api/router.php',                       #
        '/' => 'private/logic/pages/home.php'                           # --Home page-----
    ],
    'POST' => [
        '/login' => 'private/logic/pages/login.php',
        '/api' => 'private/logic/api/router.php'
    ],
    'PUT' => [
        '/api' => 'private/logic/api/router.php'
    ],
    'PATCH' => [
        '/api' => 'private/logic/api/router.php'
    ],
    'OPTIONS' => [
        '/api' => 'private/logic/api/router.php'
    ],
    'DELETE' => [
        '/api' => 'private/logic/api/router.php'
    ]
];

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];
$path = explode('?', $path)[0];

if (!isset($method)) {
    # 405 parce que le client doit toujours envoyer un verbe
    http_response_code(400);
    header("Location: /errors/HTTP400.html");
    exit;
}

if (!isset($path)) {
    # 500 parce que le serveur devrait toujours retourner une URI
    http_response_code(500);
    header("Location: /errors/HTTP500.html");
    exit;
}

foreach ($routes[$method] as $route => $file) {
    # if path starts with route
    if (str_starts_with($path, $route)){
        require_once($file);
        exit;
    }
}
?>