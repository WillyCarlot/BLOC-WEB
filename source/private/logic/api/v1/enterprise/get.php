<?php

require_once('private/logic/objects/location.php');
require_once('private/logic/authentication.php');

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// GET /api/v1/users
// Parameters :
// - search : string (optional)
// - type : list(int) (optional, default : [0, 1, 2])
// - limit : int (optional, default : 10)
// - offset : int (optional, default : 0)

if (str_ends_with($path, 'locations')) {
    $search = $_GET['search'] ?? '';




    $location_db = new LOCATION_DB();
    $location = $location_db->search($search);

    header('Content-Type: application/json');
    echo json_encode($location);
}

// GET /api/v1/skill/{id}

else
{
  


    $id = intval(substr($path, strlen('/api/v1/locations/')));
    $location_db = new LOCATION_DB();
    $location = $location_db->get($id);

    if ($location == null) {
        http_response_code(404);
        exit;
    }

    header('Content-Type: application/json');
    echo(json_encode($location));
}