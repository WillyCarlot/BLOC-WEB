<header>

    <div class="PC-nav-bar">
        <div class="logo">
            <a href="/"><img src="assets/img/logo.png" alt="Hook-up"></a>
        </div>

        <div class="center_cont">
            <nav class="navbar">

                <ul class="category-list">
                    <li><a href="enterprises"><img class="smaller-image" src="assets/img/icons/entreprise.svg"
                                                   alt=""></a></li>
                    <li><a href="users"><img class="smaller-image" src="assets/img/icons/pilote.svg" alt=""></a></li>
                    <li><a href="wishlist"><img class="smaller-image" src="assets/img/icons/etudiant.svg" alt=""></a>
                    </li>
                    <li><a href="offers"><img class="smaller-image" src="assets/img/icons/offres.svg" alt=""></a></li>
                </ul>
            </nav>
        </div>


        <div class="compte">
            {if $isLogged}
                <button onclick="window.location.href='me'">
                    <span class="text">Mon compte</span><span><img src="assets/img/icons/connect.png" alt=""></span>
                </button>

            {else}
                <button onclick="window.location.href='login'">
                    <span class="text">Connexion</span><span><img src="assets/img/icons/connect.png" alt=""></span>
                </button>
            {/if}
        </div>
    </div>
    <div class="phone-nav-bar">
        <div class="phoneHead">
            <div class="btn_menu">
                <button>
                    <span><img src="assets/img/bar.png" alt=""></span>
                    <span><img src="assets/img/bar.png" alt=""></span>
                    <span><img src="assets/img/bar.png" alt=""></span>
                </button>
            </div>

            <div class="btn_conct">
                {if $isLogged}
                <button onclick="window.location.href='me'">
                        <span class="text">Mon compte</span><span><img src="assets/img/icons/connect.png" alt=""></span>
                </button>

                {else}
                <button onclick="window.location.href='login'">
                    <span class="text">Connexion</span><span><img src="assets/img/icons/connect.png" alt=""></span>
                </button>
                {/if}
            </div>
        </div>
        <div class="menuClick">
            <div class="topM">
                <div class="btn_crois">
                    <button>
                        ✖️
                    </button>
                </div>
                <div class="btn_home">
                    <button>
                        🏠
                    </button>
                </div>
            </div>
            <div class="mainM">
                <input type="button" value="Gestion des entreprises" class="b_1">
                <input type="button" value="Gestion offres de stage" class="b_2">

                <input type="button" value="Gestion des pilotes de  promotions" class="b_3">
                <input type="button" value="Gestion des étudiants" class="b_4">
            </div>
        </div>
        <script src="assets/script/generic-script.js"></script>
    </div>
</header>
