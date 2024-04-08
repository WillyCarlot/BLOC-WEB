<!DOCTYPE html>
<html lang="fr">

    <head>
        <link rel="stylesheet" href="assets/styles/me-styles.css">
        {include file="components/head.tpl"}
        <title>Connexion</title>
    </head>

    <body>
        {include file="components/header.tpl"}
        <main>
        <h1><span>{$firsteN}</span><span> </span><span>{$lastN}</span></h1>
        <div class="info">
            <h2>{$email}</h2>
            <h2>{$roll}</h2>
            <div class="localiter">
                <h2>{$centre}</h2>
                <h2>{$promotion}</h2>
            </div>
            <h2>{$skils}</h2>
        </div>
        <div class="offre">
            
            <div class="ofEnFav">
                <p class="textInfo">favorie :</p>
                <div class="favOF">