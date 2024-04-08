<div class='pop_up_cree_offre'>
    <div class='pop_pu_content'>
        <div class='head_of_pop_up'>
            <input class='entrepris' placeholder='Nom enterprise' value="{$nom}">
            <input class='titre' placeholder='titre' value="{$title}">
        </div>
        <div class='left_content'>
            <div class='ville'>
                <p class='ville_title'>
                    ville :
                </p>
                <input type='text' placeholder='ville' value="{$loc}">
            </div>
            <div class='competance'>
                <p class='competance_title'>
                    competance :
                </p>
                <input type='text' value="{$skils}">
                <p class='plus'>
                    +
                </p>
            </div>
            <div class='salary'>
                <p class='title_salary'>
                    salaire :
                </p>
                <input type='number' class='min' placeholder='min' value="{$salair}">
                <p class='tiret'>
                    -
                </p>
                <input type='number' class='max' placeholder='max' value="{$salair}">
            </div>
        </div>
        <div class='description'>
            <textarea placeholder='ecrie une descripation'>{$dc}</textarea>
        </div>
        <div class='btn_de_popup'>
            <button class='left_buton'>retour</button>
            <button class='btn_sup'>suprimer</button>
            <button class='right_buton'>sauvgarder</button>
        </div>
    </div>
</div>
<div class='pop_up_postuler_offre'>
    <div class='pop_pu_content'>
        <div class='head_of_pop_up'>
            <p class='entrepris'>{$nom}</p>
            <p class='titre'>{$title}</p>
        </div>
        <div class='left_content'>
            <div class='ville'>
                <p class='ville_title'>
                    ville :
                </p>
                <p class='ville_content'>{$loc}</p>
            </div>
            <div class='competance'>
                <p class='competance_title'>{$skils}</p>
                <div class='competance_content'>
                    <p>competance</p>
                </div>
            </div>
            <div class='salary'>
                <p class='title_salary'>
                    salaire :
                </p>
                <p class='min'>{$salair}</p>
                <p class='tiret'>
                    -
                </p>
                <p class='max'>{$salair}</p>
            </div>
        </div>
        <div class='description'>
            <p class='descripation'>{$dc}</p>
        </div>
        <div class='btn_de_popup'>
            <button class='left_buton'>retour</button>
            <button class='right_buton'>postuler</button>
        </div>
    </div>
    <div class='pop_up_cv'>
        <div class='pop_pu_content'>
            <div class='head_of_pop_up'>
                <p>postuler</p>
            </div>
            <div class='cv_et_motviation'>
                <div class='cv'>
                    <p>CV :</p>
                    <button>deposer cv</button>
                </div>
                <div class='motivation'>
                    <p>motivation :</p>
                    <textarea></textarea>
                </div>
            </div>
            <div class='btn_de_popup'>
                <button class='left_buton'>retour</button>
                <button class='right_buton'>envoyer</button>
            </div>
        </div>
    </div>
</div>
