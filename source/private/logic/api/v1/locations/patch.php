<?php
$_PATCH = json_decode(file_get_contents('php://input'), true);

// PATCH /api/v1/skill/{id}
// Parameters :
// - first_name : string (optional)
// - last_name : string (optional)
// - email : string (optional)
// - type : int (optional)
// - promotion : int (optional)

require_once('private/logic/objects/location.php');
require_once('private/logic/authentication.php');

$authorized_roles = [1,2];
$auth = new Authentication();
$auth->checkAuthorization($authorized_roles);

$id = intval(substr($_SERVER['REQUEST_URI'], strlen('/api/v1/locations/')));
$location_db = new LOCATION_DB();
$location = $location_db->get($id);

if ($location == null) {
    http_response_code(404);
    exit;
}

$name = $_PATCH['name'] ?? null;
$street = $_PATCH['street'] ?? null;
$city = $_PATCH['city'] ?? null;
$zip = $_PATCH['zip'] ?? null;
$country = $_PATCH['country'] ?? null;


if ($name != null) {
    $location->setName($name);
}
if ($street != null) {
    $location->setStreet($street);
}
if ($city != null) {
    $location->setCity($city);
}
if ($zip != null) {
    $location->setZipCode($zip);
}
if ($country != null) {
    $location->setCountry($country);
}

try {
    $location = $location_db->save($location);
    http_response_code(200);
    header('Content: application/json');
    echo(json_encode($location));
} catch (Exception $e) {
    http_response_code(500);
    exit;
}