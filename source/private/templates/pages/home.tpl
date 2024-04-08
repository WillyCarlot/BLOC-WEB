<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="assets/styles/home-style.css">
    {include file="components/head.tpl"}
    <title>Accueil</title>
</head>
<body>
{include file="components/header.tpl"}

<main class="desktop">
    <div class="grid">



        <img src="assets/img/home_img.png" alt="">

        {if $isLogged}
            <input type="button" value="Liste des entreprises" class="b_1" onclick="window.location.href='/enterprises'">
            <input type="button" value="Offres de stage" class="b_2" onclick="window.location.href='/offers'">

            {if $user->getType() == 0}
                <input type="button" value="Ma wishlist" class="b_3" onclick="window.location.href='/wishlist'">
                <input type="button" value="À propos" class="b_4" onclick="window.location.href='/about'">
            {/if}
            {if $user->getType() == 1 }
                <input type="button" value="Gestion des utilisateurs" class="b_3" onclick="window.location.href='/users'">
                <input type="button" value="À propos" class="b_4" onclick="window.location.href='/about'">
            {/if}
            {if $user->getType() == 2 }
                <input type="button" value="Ma wishlist" class="b_3" onclick="window.location.href='/wishlist'">
                <input type="button" value="Gestion des utilisateurs" class="b_4" onclick="window.location.href='/users'">
            {/if}

        {else}
            <input type="button" value="Connexion" class="b_1" onclick="window.location.href='/login'">
            <input type="button" value="À propos" class="b_2" onclick="window.location.href='/about'">
        {/if}

    </div>
</main>
<main class="mobile">
        <h1>Bonjour</h1>
        <span><img src="assets/img/logo.png" alt="Hook-up"></span>
</main>


{include file="components/footer.tpl"}

</body>
</html>