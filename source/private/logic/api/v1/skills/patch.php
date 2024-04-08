<?php
$_PATCH = json_decode(file_get_contents('php://input'), true);

// PATCH /api/v1/skill/{id}
// Parameters :
// - first_name : string (optional)
// - last_name : string (optional)
// - email : string (optional)
// - type : int (optional)
// - promotion : int (optional)

require_once('private/logic/objects/skill.php');
require_once('private/logic/authentication.php');

$authorized_roles = [1,2];
$auth = new Authentication();
$auth->checkAuthorization($authorized_roles);

$id = intval(substr($_SERVER['REQUEST_URI'], strlen('/api/v1/skills/')));
$skill_db = new SKILL_DB();
$skill = $skill_db->get($id);

if ($skill == null) {
    http_response_code(404);
    exit;
}

$name = $_PATCH['name'] ?? null;

if ($name != null) {
    $skill->setName($name);
}

try {
    $skill = $skill_db->save($skill);
    http_response_code(200);
    header('Content: application/json');
    echo(json_encode($skill));
} catch (Exception $e) {
    http_response_code(500);
    exit;
}