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
            <div class="companyCard">


                <div class="modifyContainer">
                    <div class="cardParameterName">
                        <p>Nom :</p>
                        <p class="data">Nom</p>
                    </div>
                    <button class="btnModify"><img class="modify-image" src="assets/img/icons/note.png" alt=""></button>
                </div>

                <div class="cardParameter">
                    <p>Secteur d'activité :</p>
                    <p class="data">secteur</p>
                </div>
                <div class="cardParameter">
                    <p>Note :</p>
                    <div class="stars"><span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div> <!-- Indique la note dans la variable CSS --rating -->
                </div>

            </div>

        </div>
        <div id="filter-5">
            <div id="btnContainer">
                <button class="btnPage">1</button>
                <button class="btnPage">2</button>
                <button class="btnPage">3</button>
                <button class="btnPage">4</button>
                <p>...</p>
                <button class="btnPage">14</button>
                <button class="btnPage">15</button>
            </div>
        </div>

    </div>

</div>

<div class="popup_cree_entreprise">
    <div class="popup_contente">
        <div class="title_popup">
            <h2>
                Créer une entreprise
            </h2>
        </div>
        <div class="main_popup">
            <p>
                Nom de l'entreprise
            </p>
            <input type="text">
            <p>
                Secteur d'activité :
            </p>
            <input type="text">
            <p>
                Evaluation :
            </p>
            <input type="text">
            <div class="evaluation">

            </div>
        </div>
        <div class="btn_popup">
            <button class="left_btn">Retour</button>
            <button class="right_btn">Créer</button>
        </div>
    </div>
</div>




<div class="popup_modifier_entreprise">
    <div class="popup_contente">
        <div class="title_popup">
            <h2>
                Modifier une entreprise
            </h2>
        </div>
        <div class="main_popup">
            <p>
                Nom de l'entreprise
            </p>
            <input type="text">
            <p>
                Secteur d'activité :
            </p>
            <input type="text">
            <p>
                Evaluation :
            </p>
            <input type="text">
        </div>
        <div class="btn_popup">
            <button class="left_btn">Retour</button>
            <button class="delete_btn">Supprimer</button>
            <button class="right_btn">Modifier</button>

        </div>
    </div>
</div>
<script src="assets/script/entreprise-script.js"></script>
{include file="components/footer.tpl"}

</body>

</html>