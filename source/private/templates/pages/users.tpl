<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des utilisateurs</title>
  <link rel="stylesheet" href="assets/styles/generic-style.css">
  <link rel="stylesheet" href="assets/styles/gestion_etudiants-style.css">
  {include file="components/head.tpl"}
  <title>Gestion des étudiants</title>
</head>

<body>
{include file="components/header.tpl"}

  <div class="right_contente">
    <div class="zone-droite">
      <div class="search-bar">
        <div class="_blank"></div>
        <img src="assets/img/Recherche.png" alt="Rechercher" class="search-icon">
        <div class="search-bar2 ">
          <input type="search" placeholder="Rechercher" class="search-input" value="{$recherche}"/>
        </div>

      </div>
      <div class="centeredBtn">
        <button id="openModalBtn" class="add-button">Ajouter</button>
      </div>

    </div>
    <div class="zone-interne">

      {foreach $users as $user}
        <div class="user-card" >
          <div class="user-details">
            {if $user->getType() == 0}
              <p>Type : Utilisateur</p>
            {elseif $user->getType() == 1}
              <p>Type : Pilote</p>
            {else}
              <p>Type : Administrateur</p>
            {/if}
            <p>Nom : {$user->getLastName()}</p>
            <p>Prénom : {$user->getFirstName()}</p>
            <p>Centre : {$user->getPromotion()->getCenter()->getName()}</p>
            <p>Promotion : {$user->getPromotion()->getName()}</p>
          </div>
          <img src="assets/img/icons/note.svg" alt="Plus d'infos" class="info-icon" data-id="{$user->getId()}" data-firstname="{$user->getFirstName()}" data-lastname="{$user->getLastName()}" data-email="{$user->getEmail()}" data-type="{$user->getType()}" data-promotion="{$user->getPromotion()->getId()}">
        </div>
      {/foreach}
    </div>


    <!-- La structure de la fenêtre modale -->
    <div id="myModal" class="modal">
      <div class="modal-content">
        <div class="info-bar-line">
          <h2 class="modal-title">Ajout d'un utilisateur</h2>
        </div>
        <form action="/api/v1/users" method="post">
          <div class="input-container">
            <label>Nom :</label>
            <input type="text" id="userName" name="last_name" class="input-field" placeholder="">
          </div>
          <div class="input-container">
            <label>Prénom :</label>
            <input type="text" id="userFirstName" name="first_name" class="input-field" placeholder="">
          </div>
          <div class="input-container">
            <label>Adresse email :</label>
            <input type="email" id="userEmail" name="email" class="input-field" placeholder="">
          </div>
          <div class="input-container">
            <label>Promotion:</label>
            <select id="userPromotion" name="promotion" class="input-field">
              {foreach $promotions as $promotion}
                <option value="{$promotion->getId()}">{$promotion->getName()}</option>
              {/foreach}
            </select>
          </div>
          <div class="input-container">
            <label>Type d'utilisateur :</label>
            <select id="userType" name="type" class="input-field">
                <option value="0">Utilisateur</option>
                {if $authType == 2}
                  <option value="1">Pilote</option>
                  <option value="2">Administrateur</option>
                {/if}
            </select>
          </div>
          <div class="form-buttons">
            <button type="button" class="button cancel">Retour</button>
            <button type="submit" class="button submit">Ajouter</button>
          </div>
        </form>
      </div>
    </div>

    <!--Modifier html-->
    <!-- Fenêtre modale de modification d'un utilisateur -->
    <div id="modifyUserModal" class="modal">
      <div class="modal-content">
        <div class="info-bar-line">
          <h2 class="modal-title">Modifier un utilisateur</h2>
        </div>
        <input type="hidden" id="modifyUserId" name="userId">
        <div class="input-container">
          <label for="modifyUserName">Nom de l'utilisateur :</label>
          <input type="text" id="modifyUserName" name="userName" class="input-field" placeholder="">
        </div>
        <div class="input-container">
          <label for="modifyUserFirstName">Prénom de l'utilisateur :</label>
          <input type="text" id="modifyUserFirstName" name="userFirstName" class="input-field" placeholder="">
        </div>
        <div class="input-container">
          <label for="modifyUserEmail">Adresse email de l'utilisateur :</label>
          <input type="text" id="modifyUserEmail" name="userEmail" class="input-field" placeholder="">
        </div>
        <div class="input-container">
          <label for="modifyUserPromotion">Promotion:</label>
            <select id="modifyUserPromotion" name="userPromotion" class="input-field">
                {foreach $promotions as $promotion}
                <option value="{$promotion->getId()}">{$promotion->getName()}</option>
                {/foreach}
            </select>
        </div>
        <div class="input-container">
          <label for="modifyUserType">Type d'utilisateur :</label>
          <select id="modifyUserType" name="userType" class="input-field">
            <option value="0">Utilisateur</option>
            {if $authType == 2}
              <option value="1">Pilote</option>
              <option value="2">Administrateur</option>
            {/if}
          </select>
        </div>
        <div class="form-buttons">
          <button type="button" class="button cancel" id="closeModifyModal">Retour</button>
          <button type="button" class="button delete" id="deleteUser">Supprimer</button>
          <button type="submit" class="button submit" id="submitModifications">Modifier</button>
        </div>
      </div>
    </div>

    <script src="/assets/script/gestion_etudiants-script.js"></script>
</body>
</html>
