<?php

// POST /api/v1/users
// Parameters :
// - first_name : string
// - last_name : string
// - email : string
// - type : int
// - promotion : int

require_once('private/logic/objects/user.php');
require_once('private/logic/objects/promotion.php');
require_once('private/logic/authentication.php');

$authorized_roles = [2];
$auth = new Authentication();

if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
    $_POST = json_decode(file_get_contents('php://input'), true);
}

$first_name = $_POST['first_name'] ?? null;
$last_name = $_POST['last_name'] ?? null;
$email = $_POST['email'] ?? null;
$type = $_POST['type'] ?? null;
$promotion = $_POST['promotion'] ?? null;

if ($type == 0){
    $authorized_roles[] = 1;
}
$auth->checkAuthorization($authorized_roles);

if ($first_name == null || $last_name == null || $email == null || !in_array($type, [0,1,2]) || $promotion == null) {
    http_response_code(400);
    exit;
}

$promotion_db = new PROMOTION_DB();
$promotion = $promotion_db->get($promotion);

if ($promotion == null) {
    http_response_code(400);
    exit;
}

$user = new USER($first_name, $last_name, $email, $type, $promotion);
$user_db = new USER_DB();
$user = $user_db->save($user);

header('Content: application/json');
echo(json_encode($user));