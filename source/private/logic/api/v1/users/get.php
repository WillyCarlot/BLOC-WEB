<?php

require_once('private/logic/objects/user.php');
require_once('private/logic/authentication.php');

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// GET /api/v1/users
// Parameters :
// - search : string (optional)
// - type : list(int) (optional, default : [0, 1, 2])
// - limit : int (optional, default : 10)
// - offset : int (optional, default : 0)

if (str_ends_with($path, '/api/v1/users')) {
    $search = $_GET['search'] ?? '';
    $type = $_GET['type'] ?? [0];
    $limit = $_GET['limit'] ?? null;
    $offset = $_GET['offset'] ?? null;

    $authorized_roles = [2];
    if (!in_array(1, $type) && !in_array(2, $type)) {
        $authorized_roles[] = 1;
    }
    $auth = new Authentication();
    $auth->checkAuthorization($authorized_roles);

    $user_db = new USER_DB();
    $users = $user_db->search($search, $type, $limit, $offset);

    header('Content-Type: application/json');
    echo json_encode($users);
}

// GET /api/v1/users/{id}

else
{
    $authorized_roles = [2];
    $auth = new Authentication();

    $id = intval(substr($path, strlen('/api/v1/users/')));
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

    header('Content: application/json');
    echo(json_encode($user));
}