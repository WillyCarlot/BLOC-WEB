<?php

require_once('private/logic/smarty.php');

$page = 0;

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

$enterprises = array(
    array(
        "enterpriseName" =>"coco&co",
        "sector" => "informatique",
        "grad" => "3.5"
       
    ),
    array(
        "enterpriseName" =>"coco&co",
        "sector" => "informatique",
        "grad" => "4"
       
    ),
    array(
        "enterpriseName" =>"coco&co",
        "sector" => "informatique",
        "grad" => "5"
       
    ),
    array(
        "enterpriseName" =>"coco&co",
        "sector" => "informatique",
        "grad" => "3.5"
       
    ),
    array(
        "enterpriseName" =>"coco&co",
        "sector" => "informatique",
        "grad" => "4"
       
    ),
    array(
        "enterpriseName" =>"coco&co",
        "sector" => "informatique",
        "grad" => "5"
       
    ),
    array(
        "enterpriseName" =>"coco&co",
        "sector" => "informatique",
        "grad" => "3.5"
       
    ),
    array(
        "enterpriseName" =>"coco&co",
        "sector" => "informatique",
        "grad" => "4"
       
    ),
    array(
        "enterpriseName" =>"coco&co",
        "sector" => "informatique",
        "grad" => "5"
       
    )
);

// Assuming $i is initialized
$i = 0;
$enterprises_data = $enterprises[$i];
$smarty->assign('enterpriseName', $enterprises_data['enterpriseName']);
$smarty->assign('sector', $enterprises_data['sector']);
$smarty->assign('grad', $enterprises_data['grad']);

if ($pagefinder("b") > -1) {
    $smarty->assign('pageb', '<div class="Nleft"><a href="?page=' . $pagefinder("b") . '">' . $pagefinder("b") . '</a></div>');
}else{
    $pageb = "";
    $smarty->assign('pageb', $pagefinder(""));
}


$smarty->assign('pagec', $pagefinder("c"));
$smarty->assign('pagea', $pagefinder("a"));



$smarty->display('pages/enterprises/top-enterprises.tpl');

        for ($i = (9 * $pagefinder("c")); $i < count($enterprises); $i++) {
            if ($i < (9 * $pagefinder("c") + 9) && isset($enterprises[$i])) { // Limite le nombre d'éléments à 3 par page
                // Assignation des variables Smarty
                $enterprise = $enterprises[$i];
                $smarty->assign('enterpriseName', $enterprise['enterpriseName']);
                $smarty->assign('sector', $enterprise['sector']);
                $smarty->assign('grad', $enterprise['grad']);

                $smarty->display('pages/enterprises/enterprisesCard.tpl');
            }else{
                break;
            }
        }


$smarty->display('pages/enterprises/bot-enterprises.tpl');

if ($pagefinder("b") > -1) {
    $smarty->assign('pageb', '<div class="Nleft"><a href="?page=' . $pagefinder("b") . '">' . $pagefinder("b") . '</a></div>');
}else{
    $pageb = "";
    $smarty->assign('pageb', $pagefinder(""));
}


$smarty->assign('pagec', $pagefinder("c"));
$smarty->assign('pagea', $pagefinder("a"));


