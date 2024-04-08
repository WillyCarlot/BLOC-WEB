<?php
// merci stackoverflow pour le php://input :p
// cela dit cet endpoint supporte que le JSON en entrée du coup
// tant pis pour le form/multipart
$_PATCH = json_decode(file_get_contents('php://input'), true);

// PATCH /api/v1/users/{id}
// Parameters :
// - first_name : string (optional)
// - last_name : string (optional)
// - email : string (optional)
// - type : int (optional)
// - promotion : int (optional)

require_once('private/logic/objects/user.php');
require_once('private/logic/objects/promotion.php');
require_once('private/logic/authentication.php');

$authorized_roles = [2];
$auth = new Authentication();

$id = intval(substr($_SERVER['REQUEST_URI'], strlen('/api/v1/users/')));
$user_db = new USER_DB();
$user = $user_db->get($id);

if ($user == null) {
    http_response_code(403);
    exit;
}

if ($user->getType() == 0){
    $authorized_roles[] = 1;
}

$auth->checkAuthorization($authorized_roles);

$first_name = $_PATCH['first_name'] ?? null;
$last_name = $_PATCH['last_name'] ?? null;
$email = $_PATCH['email'] ?? null;
$type = $_PATCH['type'] ?? null;
$promotion = $_PATCH['promotion'] ?? null;

if ($first_name != null) {
    $user->setFirstName($first_name);
}
if ($last_name != null) {
    $user->setLastName($last_name);
}
if ($email != null) {
    $user->setEmail($email);
}
if ($type != null) {
    $user->setType($type);
}
if ($promotion != null) {
    $promotion_db = new PROMOTION_DB();
    $promotion = $promotion_db->get($promotion);
    if ($promotion == null) {
        http_response_code(400);
        exit;
    }
    $user->setPromotion($promotion);
}

try {
    $user_db->save($user);
    http_response_code(200);
    header('Content: application/json');
    echo(json_encode($user));
} catch (Exception $e) {
    http_response_code(500);
    exit;
}