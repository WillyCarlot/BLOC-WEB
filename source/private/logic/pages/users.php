<?php

require_once('private/logic/smarty.php');
require_once('private/logic/objects/user.php');
require_once('private/logic/authentication.php');

$authorized_roles = [1,2];
$auth = new Authentication();
$auth->checkAuthorization($authorized_roles);

$authType = $auth->getUser(false)->getType();

$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : "";
if ($authType == 2) {
    $searchType = [0,1,2];
} else {
    $searchType = [0];
}

$user_db = new USER_DB();
$users = $user_db->search($recherche, $searchType);

$promotions_db = new PROMOTION_DB();
$promotions = $promotions_db->search('');


$smarty->assign('users', $users);
$smarty->assign('recherche', $recherche);
$smarty->assign('promotions', $promotions);
$smarty->assign('authType', $authType);


$smarty->display('pages/users.tpl');
