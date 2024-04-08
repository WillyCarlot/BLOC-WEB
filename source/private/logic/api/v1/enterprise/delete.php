<?php

require_once('private/logic/objects/location.php');
require_once('private/logic/authentication.php');

// DELETE /api/v1/skills/{id}
// Parameters :
//   aucun

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

try {
    $location_db->delete($location->getId());
    http_response_code(200);
} catch (Exception $e) {
    http_response_code(500);
    exit;
}