<?php
$_PATCH = json_decode(file_get_contents('php://input'), true);

// PATCH /api/v1/center/{id}
// Parameters :
// - first_name : string (optional)
// - last_name : string (optional)
// - email : string (optional)
// - type : int (optional)
// - promotion : int (optional)

require_once('private/logic/objects/center.php');
require_once('private/logic/authentication.php');

$authorized_roles = [2];
$auth = new Authentication();
$auth->checkAuthorization($authorized_roles);

$id = intval(substr($_SERVER['REQUEST_URI'], strlen('/api/v1/centers/')));
$center_db = new CENTER_DB();
$center = $center_db->get($id);

if ($center == null) {
    http_response_code(404);
    exit;
}

$name = $_PATCH['name'] ?? null;
$location = $_PATCH['location'] ?? null;

if ($name != null) {
    $center->setName($name);
}
if ($location != null && is_numeric($location)){
    $location_db = new LOCATION_DB();
    try{
        $center->setLocation($location_db->get($location));
    } catch (Exception $e) {
        http_response_code(400);
        exit;
    }
}

try {
    $center = $center_db->save($center);
    http_response_code(200);
    header('Content: application/json');
    echo(json_encode($center));
} catch (Exception $e) {
    http_response_code(500);
    exit;
}