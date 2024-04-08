<?php

require_once('private/logic/objects/user.php');
require_once('private/logic/authentication.php');

// DELETE /api/v1/users/{id}
// Parameters :
//   aucun

$authorized_roles = [2];
$auth = new Authentication();

$id = intval(substr($_SERVER['REQUEST_URI'], strlen('/api/v1/users/')));
$user_db = new USER_DB();
$user = $user_db->get($id);

if ($user == null) {
    http_response_code(403); // on évite d'exposer une API qui permet de connaitre les utilisateurs existants
    exit;
}

if ($user->getType() == 0){
    $authorized_roles[] = 1;
}
$auth->checkAuthorization($authorized_roles);

try {
    $user_db->delete($user);
    http_response_code(200);
} catch (Exception $e) {
    http_response_code(500);
    exit;
}