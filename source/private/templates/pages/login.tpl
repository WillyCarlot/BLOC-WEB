<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="assets/styles/connexion-styles.css">
    {include file="components/head.tpl"}
    <title>Connexion</title>
</head>

<body>
{include file="components/header.tpl"}

{if isset($error)}
    <div class="error">
        <p>{$error}</p>
    </div>
{/if}

<form id="loginForm" action="login" method="post">
<fieldset form="loginForm">
    <h1>Accédons à votre compte</h1>

    {if $stage == 1}
        <p>Connectez-vous avec votre adresse email</p>
        <input type="email" name="email" placeholder="ADRESSE EMAIL">
        <button type="submit">Continuer</button>

    {elseif $stage == 2}
        <p>Entrez le code de validation qui vous a été envoyé par email</p>
        <input type="email" name="email" placeholder="ADRESSE EMAIL" value="{$email}" readonly>
        <input type="text" name="code" placeholder="CODE DE VERIFICATION">
        <button type="submit">Continuer</button>
    {/if}

</fieldset>
</form>
{include file="components/footer.tpl"}
</body>
</html>
