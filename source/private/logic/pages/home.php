<?php

require_once('private/logic/smarty.php');
require_once('private/logic/authentication.php');

$authorized_roles = [0,1,2];
$auth = new Authentication();

$logout = $_GET['logout'] ?? false;
if ($logout) {
    $auth->logout();
    header('Location: /');
    http_response_code(302);
    exit;
}

$isLogged = $auth->isLogged();
if (!$isLogged) {
    $smarty->assign('isLogged', false);
} else {
    $smarty->assign('isLogged', true);
    $smarty->assign('user', $auth->getUser(false));
}

$smarty->display('pages/home.tpl');