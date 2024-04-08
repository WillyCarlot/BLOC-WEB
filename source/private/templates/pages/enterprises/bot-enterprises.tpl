

</div>

</div>
<div id="filter-5">
    <div id="btnContainer">
    <div class="pagination">
    {$pageb}
    
    <div class="Ncurent">
        <p>{$pagec}</p>
    </div>
    
    <div class="Nright"><a href="?page={$pagea}">{$pagea}</a></div>

</div>
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
    <input type="text" id="enterpriseNameInput">
    <p>
        Secteur d'activité :
    </p>
    <input type="text" id="sectorInput">
    <p>
        Evaluation :
    </p>
    <input type="text" id="evaluationInput">
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
    <input type="text"  id="nameInputModify">
    <p>
        Secteur d'activité :
    </p>
    <input type="text" id="sectorInputModify">
    <p>
        Evaluation :
    </p>
    <input type="text" id="gradeInputModify">
</div>
<div class="btn_popup">
    <button class="left_btn">Retour</button>
    <button class="delete_btn">Supprimer</button>
    <button class="right_btn">Modifier</button>

</div>
</div>
</div>


<script src="assets/script/entreprise-script.js"></script>
</body>

</html>