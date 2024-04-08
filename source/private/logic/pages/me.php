<?php

require_once('private/logic/smarty.php');
require_once('private/logic/objects/user.php');
require_once('private/logic/authentication.php');

$auth = new Authentication();
$auth->checkAuthorization();
$user = $auth->getUser(true);

$smarty->assign('lastN', $user->getLastName());
$smarty->assign('firsteN', $user->getFirstName());
$smarty->assign('email', $user->getEmail());
$smarty->assign("roll",type_finder($user->getType()));
$smarty->assign('centre', $user->getPromotion()->getCenter()->getName());
$smarty->assign('promotion', $user->getPromotion()->getName());

$offres = array(
    array(
        "Nom_entreprise" =>"coco&co",
        "Titre" => "Développeur Web",
        "Compétence" => "HTML, CSS, JavaScript",
        "Salaire" => 50000,
        "Localité" => "Paris",
        "fav" => 1,
        "Nombre1" => 10,
        "Nombre2" => 20,
        "Description" => "lorem"
    ),
    array("Nom_entreprise" =>"wili&co","Titre" => "Designer Graphique", "Compétence" => "Adobe Photoshop, Illustrator", "Salaire" => 45000, "Localité" => "Lyon", "fav" => 0, "Nombre1" => 15, "Nombre2" => 25, "Description" => "lorem"),
    array("Nom_entreprise" =>"charle&co","Titre" => "Administrateur Système", "Compétence" => "Linux, Windows Server", "Salaire" => 55000, "Localité" => "Marseille", "fav" => 1, "Nombre1" => 20, "Nombre2" => 30,"Description" => "lorem"),
    array("Nom_entreprise" =>"mirna&co","Titre" => "Administrateur Système", "Compétence" => "Linux, Windows Server", "Salaire" => 55000, "Localité" => "Marseille", "fav" => 1, "Nombre1" => 20, "Nombre2" => 30,"Description" => "lorem"),
);

$smarty->assign('Noffre', 20);
$smarty->assign('skils', "vendre manger dormir");

function type_finder($varINT) {
    switch ($varINT) {
        case 0:
            return "student";
        case 1:
            return "pilot";
        case 2:
            return "admin";
        default:
            break;
    }
}

$love_cheker = function ($bool) {
    if ($bool === 1)
        return "❤️";
    else
        return "🖤";
};

$smarty->display('pages/me/me-top.tpl');
foreach ($offres as $offre){
    if($offre['fav']===1){
        $smarty->assign('titre', $offre['Titre']);
        $smarty->assign('skils', $offre['Compétence']);
        $smarty->assign('Salaire', $offre['Salaire']);
        $smarty->assign('loc', $offre['Localité']);
        $smarty->assign('fav', $love_cheker($offre['fav']));
        $smarty->assign('N1', $offre['Nombre1']);
        $smarty->assign('N2', $offre['Nombre2']);

        $smarty->display('pages/offers/main-offers.tpl');
    }
}
$smarty->display('pages/me/me-bot.tpl');
# TODO