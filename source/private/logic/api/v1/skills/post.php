<?php

// POST /api/v1/users
// Parameters :
// - first_name : string
// - last_name : string
// - email : string
// - type : int
// - promotion : int

require_once('private/logic/objects/skill.php');
require_once('private/logic/authentication.php');

$authorized_roles = [1, 2];
$auth = new Authentication();
$auth->checkAuthorization($authorized_roles);

$name = $_POST['name'] ?? null;

if ($name == null) {
    http_response_code(400);
    exit;
}

$skill = new skill($name);
$skill_db = new SKILL_DB();
$skill = $skill_db->save($skill);

header('Content: application/json');
echo(json_encode($skill));