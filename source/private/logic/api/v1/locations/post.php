<?php

// POST /api/v1/users
// Parameters :
// - first_name : string
// - last_name : string
// - email : string
// - type : int
// - promotion : int

require_once('private/logic/objects/location.php');
require_once('private/logic/authentication.php');

$authorized_roles = [1, 2];
$auth = new Authentication();
$auth->checkAuthorization($authorized_roles);

$name = $_POST['name'] ?? null;
$street = $_POST['street'] ?? null;
$city = $_POST['city'] ?? null;
$zip = $_POST['zip'] ?? null;
$country = $_POST['country'] ?? null;

if ($name == null || $street == null || $city == null || $zip == null || $country == null) {
    http_response_code(400);
    exit;
}

$location = new location($name, $street, $city, $zip, $country);
$location_db = new LOCATION_DB();
$location = $location_db->save($location);

header('Content: application/json');
echo(json_encode($location));