<?php

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'status' => 'success',
    'method' => $_SERVER['REQUEST_METHOD'],
    'data' => [
        'message' => 'Hello, World!'
    ]
]);