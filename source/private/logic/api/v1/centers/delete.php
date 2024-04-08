<?php

require_once('private/logic/objects/center.php');
require_once('private/logic/authentication.php');

// DELETE /api/v1/centers/{id}
// Parameters :
//   aucun

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

try {
    $center_db->delete($center->getId());
    http_response_code(200);
} catch (Exception $e) {
    http_response_code(500);
    exit;
}