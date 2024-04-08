<?php

require_once('private/logic/objects/center.php');
require_once('private/logic/authentication.php');

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// GET /api/v1/users
// Parameters :
// - search : string (optional)
// - type : list(int) (optional, default : [0, 1, 2])
// - limit : int (optional, default : 10)
// - offset : int (optional, default : 0)

if (str_ends_with($path, 'centers')) {
    $search = $_GET['search'] ?? '';

    $authorized_roles = [0,1,2];
    $auth = new Authentication();
    $auth->checkAuthorization($authorized_roles);

    $center_db = new CENTER_DB();
    $center = $center_db->search($search);

    header('Content-Type: application/json');
    echo json_encode($center);
}

// GET /api/v1/center/{id}

else
{
    $authorized_roles = [0,1,2];
    $auth = new Authentication();
    $auth->checkAuthorization($authorized_roles);

    $id = intval(substr($path, strlen('/api/v1/centers/')));
    $center_db = new CENTER_DB();
    $center = $center_db->get($id);

    if ($center == null) {
        http_response_code(404);
        exit;
    }

    header('Content: application/json');
    echo(json_encode($center));
}