<?php

// POST /api/v1/users
// Parameters :
// - first_name : string
// - last_name : string
// - email : string
// - type : int
// - promotion : int

require_once('private/logic/objects/center.php');
require_once('private/logic/objects/location.php');
require_once('private/logic/authentication.php');

$authorized_roles = [2];
$auth = new Authentication();
$auth->checkAuthorization($authorized_roles);

$name = $_POST['name'] ?? null;
$location = $_POST['location'] ?? null;

if ($name == null || $location == null || !is_numeric($location)) {
    http_response_code(400);
    exit;
}

$location_db = new LOCATION_DB();
try{
    $location = $location_db->get($location);
} catch (Exception $e) {
    http_response_code(400);
    exit;
}

$center = new center($name, $location);
$center_db = new CENTER_DB();
$center = $center_db->save($center);

header('Content: application/json');
echo(json_encode($center));