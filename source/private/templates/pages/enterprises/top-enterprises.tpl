<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/styles/entreprise-styles.css">
    {include file="components/head.tpl"}
    <title>Connexion</title>
</head>

<body>
{include file="components/header.tpl"}




<div class="container1">

    <div class="filter" id="filter-1">
        <div id="filter-7">
            <button id="createEntreprise" class="bluebutton">Créer une entreprise</button>
        </div>
        <div id="filter-nom">
            <input id="nomFilter" type="text" placeholder="Nom">

            <div id="boutonContainer-nomFilter"></div>
        </div>
        <div id="filter-place">
            <input id="placeFilter" type="text" placeholder="Localité(s)">
            <div id="boutonContainer-placeFilter"></div>
        </div>
        <div id="filter-stageNumber">
            <input id="stageNumberFilter" type="text" placeholder="Nombre de stagiaires">
            <div id="boutonContainer-stageNumberFilter"></div>
        </div>
        <div id="filter-sector">
            <input id="sectorFilter" type="text" placeholder="Secteur d'activité">
            <div id="boutonContainer-sectorFilter"></div>
        </div>
        <div id="filter-rate">
            <input id="rateFilter" type="text" placeholder="Moyenne d'évaluation">
            <div id="boutonContainer-rateFilter"></div>
        </div>
        <div id="filter-6">
            <h2>Trier par</h2>
            <button id="bestRate" class="filtreTrier">Les plus aimées</button>
            <button id="worstRate" class="filtreTrier">Les moins aimées</button>
        </div>
    </div>
    <div class="filter" id="filter-2">
        <div id="filter-3">
            <h1>Recherche d'entreprise</h1>
        </div>
        <div id="filter-4">
   