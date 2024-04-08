<?php

require_once('private/logic/smarty.php');



$page = 0;
////////////////////////////////////////////valeur test////////////////////////////////////////////
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















$love_cheker = function ($bool) {
    if ($bool === 1)
        return "❤️";
    else
        return "🖤";
};

$start_index = 0;
//fonction pour trouver dans quel page nous somme//
$pagefinder = function ($var) {
    $currentpage = null;
    $beforepage = null;
    $afterpage = null;
    if (isset ($_GET['page'])) {
        $currentpage = (int) $_GET['page'];
    } else if (!isset ($_GET['page'])) {
        $currentpage = 0;
    }
    switch ($var) {
        case "b":
            $beforepage = $currentpage - 1;
            return $beforepage;
        case "c":
            return $currentpage;
        case "a":
            $afterpage = $currentpage + 1;
            return $afterpage;
        default:
            return null;
    }

};
////




$smarty->display('pages/offers/head-offers.tpl');

$smarty->display('pages/offers/main-top-offers.tpl');
if (isset($_COOKIE['largeur'])){
    if ($_COOKIE['largeur'] > 950){
        for ($i = (3 * $pagefinder("c")); $i < count($offres); $i++) {
            if ($i < (3 * $pagefinder("c") + 3)) { // Limite le nombre d'elemetn a 3 par page
                // Assignation des variables Smarty
                $offre = $offres[$i];
                $smarty->assign('titre', $offre['Titre']);
                $smarty->assign('skils', $offre['Compétence']);
                $smarty->assign('Salaire', $offre['Salaire']);
                $smarty->assign('loc', $offre['Localité']);
                $smarty->assign('fav', $love_cheker($offre['fav']));
                $smarty->assign('N1', $offre['Nombre1']);
                $smarty->assign('N2', $offre['Nombre2']);
                $smarty->display('pages/offers/main-offers.tpl');
            }else{
                break;
            }
        }
    }
    else{
        for ($i = (12 * $pagefinder("c")); $i < count($offres); $i++) {
            if ($i < (12 * $pagefinder("c") + 12)) { // Limite le nombre d'elemetn a 3 par page
                $offre = $offres[$i];
                // Assignation des variables Smarty
                $smarty->assign('titre', $offre['Titre']);
                $smarty->assign('skils', $offre['Compétence']);
                $smarty->assign('Salaire', $offre['Salaire']);
                $smarty->assign('loc', $offre['Localité']);
                $smarty->assign('fav', $love_cheker($offre['fav']));
                $smarty->assign('N1', $offre['Nombre1']);
                $smarty->assign('N2', $offre['Nombre2']);

                $smarty->display('pages/offers/main-offers.tpl');
            }else{
                break;
            }
        }
    }
}



if ($pagefinder("b") > -1) {
    $smarty->assign('pageb', '<div class="Nleft"><a href="?page=' . $pagefinder("b") . '">' . $pagefinder("b") . '</a></div>');
}else{
    $pageb = "";
    $smarty->assign('pageb', $pagefinder(""));
}


$smarty->assign('pagec', $pagefinder("c"));
$smarty->assign('pagea', $pagefinder("a"));

$smarty->display('pages/offers/main-foot-offers.tpl');


if (isset($_COOKIE['largeur'])){
    if ($_COOKIE['largeur'] > 950){
        for ($i = (3 * $pagefinder("c")); $i < count($offres); $i++) {
            if ($i < (3 * $pagefinder("c") + 3)) { // Limite le nombre d'elemetn a 3 par page
                $offre = $offres[$i];
                // Assignation des variables Smarty
                $smarty->assign('nom', $offre['Nom_entreprise']);
                $smarty->assign('title', $offre['Titre']);
                $smarty->assign('loc', $offre['Localité']);
                $smarty->assign('skils', $offre['Compétence']);
                $smarty->assign('salair', $offre['Salaire']);
                $smarty->assign('dc', $offre['Description']);

                $smarty->display('pages/offers/popup-offers.tpl');
            }else{
                break;
            }
        }
    }
    else{
        for ($i = (12 * $pagefinder("c")); $i < count($offres); $i++) {
            if ($i < (12 * $pagefinder("c") + 12)) { // Limite le nombre d'elemetn a 3 par page
                $offre = $offres[$i];
                $smarty->assign('nom', $offre['Nom_entreprise']);
                $smarty->assign('title', $offre['Titre']);
                $smarty->assign('loc', $offre['Localité']);
                $smarty->assign('skils', $offre['Compétence']);
                $smarty->assign('salair', $offre['Salaire']);
                $smarty->assign('dc', $offre['Description']);
                $smarty->display('pages/offers/popup-offers.tpl');
            }else{
                break;
            }
        }
    }
}







$smarty->display('pages/offers/foot-offers.tpl');