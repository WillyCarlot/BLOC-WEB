<?php

require_once('private/logic/objects/skill.php');
require_once('private/logic/authentication.php');

// DELETE /api/v1/skills/{id}
// Parameters :
//   aucun

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

try {
    $skill_db->delete($skill->getId());
    http_response_code(200);
} catch (Exception $e) {
    http_response_code(500);
    exit;
}