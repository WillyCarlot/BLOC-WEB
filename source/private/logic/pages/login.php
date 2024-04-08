<?php

require_once('private/logic/smarty.php');
require_once('private/logic/authentication.php');
$auth = new Authentication();

// 3 possibilités :
// - aucun paramètre : on affiche le formulaire "stage 1"
// - paramètre "email" : on envoie un OTP et on affiche le formulaire "stage 2"
// - paramètres "email" et "code" : on vérifie l'OTP et on redirige vers l'accueil si c'est bon

$email = $_POST['email'] ?? '';
$code = $_POST['code'] ?? '';

if (empty($email) && empty($code)) {
    // on a rien reçu, on affiche le formulaire
    $smarty->assign('stage', 1);
    $smarty->display('pages/login.tpl');
} elseif (!empty($email) && empty($code)) {
    $auth->requestCode($email);
    $smarty->assign('stage', 2);
    $smarty->assign('email', $email);
    $smarty->display('pages/login.tpl');
} elseif (!empty($email) && !empty($code)) {
    $state = $auth->verify($email, $code);
    // 0 : ok
    // -1 : code incorrect
    // -2 : aucun compte associé à cet email

    if ($state == '0') {
        header('Location: /');
    } elseif ($state == '-1') {
        $smarty->assign('stage', 2);
        $smarty->assign('email', $email);
        $smarty->assign('error', 'Désolé, ce code est incorrect');
        $smarty->display('pages/login.tpl');
    } else {
        $smarty->assign('stage', 1);
        $smarty->assign('error', 'Aucun compte associé à cet email ne semble exister, contactez votre pilote si vous pensez qu\'il s\'agit d\'une erreur');
        $smarty->display('pages/login.tpl');
    }
}