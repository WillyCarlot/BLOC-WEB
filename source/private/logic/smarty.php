<?php

require_once('private/smarty/Smarty.class.php');
require_once('private/logic/authentication.php');

$smarty = new Smarty();

$smarty->setTemplateDir('private/templates');
$smarty->setCompileDir('private/templates_c');
$smarty->setCacheDir('private/cache');
$smarty->setConfigDir('private/configs');

$auth = new Authentication();
$smarty->assign('isLogged', $auth->isLogged());