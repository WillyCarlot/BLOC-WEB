<?php

$routes = [
    '/api/v1/users' => 'private/logic/api/v1/users/',
    '/api/v1/enterprises' => 'private/logic/api/v1/enterprises/',
    '/api/v1/offers' => 'private/logic/api/v1/offers/',
    '/api/v1/wishlist' => 'private/logic/api/v1/wishlist/',
    '/api/v1/skills' => 'private/logic/api/v1/skills/',
    '/api/v1/locations' => 'private/logic/api/v1/locations/',
    '/api/v1/centers' => 'private/logic/api/v1/centers/',
];

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

if ($method === 'OPTIONS') {
    header('Allow: ' . implode(', ', get_allowed_methods($routes[$path])));
    exit;
}

foreach ($routes as $route => $route_path) {
    if (str_starts_with($path, $route)) {
        $file = $route_path . strtolower($method) . '.php';
        if (file_exists($file)) {
            require_once($file);
            exit;
        }
    }
}

function get_allowed_methods($path): array
{
    $methods = ['OPTIONS'];
    foreach (['get', 'post', 'put', 'delete', 'patch'] as $method) {
        if (file_exists($path . '/' . $method . '.php')) {
            $methods[] = strtoupper($method);
        }
    }
    return $methods;
}