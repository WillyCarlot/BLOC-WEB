<?php

require_once('private/logic/objects/skill.php');
require_once('private/logic/authentication.php');

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// GET /api/v1/users
// Parameters :
// - search : string (optional)
// - type : list(int) (optional, default : [0, 1, 2])
// - limit : int (optional, default : 10)
// - offset : int (optional, default : 0)

if (str_ends_with($path, 'skills')) {
    $search = $_GET['search'] ?? '';

    $authorized_roles = [0,1,2];
    $auth = new Authentication();
    $auth->checkAuthorization($authorized_roles);

    $skill_db = new SKILL_DB();
    $skill = $skill_db->search($search);

    header('Content-Type: application/json');
    echo json_encode($skill);
}

// GET /api/v1/skill/{id}

else
{
    $authorized_roles = [0,1,2];
    $auth = new Authentication();
    $auth->checkAuthorization($authorized_roles);

    $id = intval(substr($path, strlen('/api/v1/skills/')));
    $skill_db = new SKILL_DB();
    $skill = $skill_db->get($id);

    if ($skill == null) {
        http_response_code(404);
        exit;
    }

    header('Content: application/json');
    echo(json_encode($skill));
}