
var id_button = 0;
const inputFilter = ['nomFilter', 'placeFilter', 'stageNumberFilter', 'sectorFilter', 'rateFilter'];

inputFilter.forEach(function(id) {
    document.getElementById(id).addEventListener('change', function() {
        var nom = this.value.trim();
        if (nom !== '') {
            var boutonContainer = document.getElementById('boutonContainer-' + id);

            var nouveauBouton = document.createElement('button');
            var texteBouton = document.createTextNode(nom);
            nouveauBouton.appendChild(texteBouton);
            boutonContainer.appendChild(nouveauBouton);
            nouveauBouton.classList.add('filtreCreated');
            nouveauBouton.id = 'filterCreated-' + id_button;

            id_button += 1;
            this.value = '';

            // Sélectionner tous les boutons de la classe "filtreCreated"
            var boutons = document.getElementsByClassName("filtreCreated");
            nouveauBouton.addEventListener('click', function() {
                this.remove();

                var filterSixDiv = document.getElementById('filter-' + id);
                var currentPaddingBottom = parseFloat(window.getComputedStyle(filterSixDiv).paddingBottom);
                var newPaddingBottom = currentPaddingBottom - 5;
                filterSixDiv.style.paddingBottom = newPaddingBottom + "px";
            });

            // Vérifier s'il y a au moins deux boutons pour obtenir les coordonnées du bouton précédent
            if (boutons.length >= 2) {
                var dernierBoutonY = boutons[boutons.length - 1].getBoundingClientRect().top;
                var avantDernierBoutonY = boutons[boutons.length - 2].getBoundingClientRect().top;

                // Vérifier si le nouveau bouton est sur une nouvelle ligne
                if (dernierBoutonY > avantDernierBoutonY) {
                    var filterSixDiv = document.getElementById('filter-' + id);
                    var currentPaddingBottom = parseFloat(window.getComputedStyle(filterSixDiv).paddingBottom);
                    var newPaddingBottom = currentPaddingBottom + 5;
                    filterSixDiv.style.paddingBottom = newPaddingBottom + "px";
                }
            }
        }
    });
});



document.addEventListener("DOMContentLoaded", function() {
    // Sélection des boutons
    const bestRateBtn = document.getElementById("bestRate");
    const worstRateBtn = document.getElementById("worstRate");
    const blue = '#1B75BB';
    const basicColor = bestRateBtn.style.borderColor;
    const basicSize = bestRateBtn.style.borderWidth;
    const newBorderSize = '2px';
    var checkblue = 0
    // Ajout d'un écouteur d'événements sur chaque bouton
    bestRateBtn.addEventListener("click", function() {
        // Si le bouton est déjà bleu, réinitialiser les propriétés de style
        if (checkblue == 1) {
            bestRateBtn.style.borderColor = basicColor;
            bestRateBtn.style.borderWidth = basicSize;
            console.log("pas blue")
            checkblue = 0;
        } else {
            // Sinon, mettre en bleu et augmenter la taille de la bordure
            bestRateBtn.style.borderColor = blue;
            bestRateBtn.style.borderWidth = newBorderSize;

            // Réinitialiser les propriétés de style du bouton 'worstRate' si nécessaire
            worstRateBtn.style.borderColor = basicColor;
            worstRateBtn.style.borderWidth = basicSize;
            checkblue = 1;
        }
    });

    worstRateBtn.addEventListener("click", function() {
        // Si le bouton est déjà bleu, réinitialiser les propriétés de style
        if (checkblue == 2) {
            worstRateBtn.style.borderColor = basicColor;
            worstRateBtn.style.borderWidth = basicSize;
            checkblue = 0;
        } else {
            // Sinon, mettre en bleu et augmenter la taille de la bordure
            worstRateBtn.style.borderColor = blue;
            worstRateBtn.style.borderWidth = newBorderSize;

            // Réinitialiser les propriétés de style du bouton 'bestRate' si nécessaire
            bestRateBtn.style.borderColor = basicColor;
            bestRateBtn.style.borderWidth = basicSize;
            checkblue = 2;
        }
    });
});



// Sélectionnez toutes les divs companyCard
const companyCards = document.querySelectorAll('.companyCard');

// Parcourez chaque div companyCard
companyCards.forEach(function(companyCard) {
    // Ajoutez un écouteur d'événements pour le survol de la souris
    companyCard.addEventListener('mouseover', function() {
        // Appliquer l'effet de surélévation sur la carte survolée
        companyCard.style.boxShadow = '0px 0px 10px 5px rgba(0, 0, 0, 0.08)';
    });

    // Ajoutez un écouteur d'événements pour lorsque la souris quitte la div
    companyCard.addEventListener('mouseout', function() {
        // Supprimer l'effet de surélévation lorsque la souris quitte la carte
        companyCard.style.boxShadow = 'none';
    });
});



//================================================================POP UP CREATE=====================================================

const create_btn = document.getElementById("createEntreprise");

const pop_up_cree_Entreprise = document.getElementsByClassName("popup_cree_entreprise")[0];
const quitter_pop_up_cree_Entreprise = pop_up_cree_Entreprise.getElementsByClassName("left_btn")[0];
const creer_pop_up_cree_Entreprise = pop_up_cree_Entreprise.getElementsByClassName("right_btn")[0];

console.log(quitter_pop_up_cree_Entreprise);

// Define the event listener functions separately
function quitterPopUpCree(e) {
    pop_up_cree_Entreprise.style.display = "none";
    console.log("retire cree entreprise");
}

function creerPopUpCree(e) {
    pop_up_cree_Entreprise.style.display = "none";
    // Function to retrieve input values and process them
    var enterpriseName = document.getElementById("enterpriseNameInput").value;
    var sector = document.getElementById("sectorInput").value;
    var evaluation = document.getElementById("evaluationInput").value;

    // Example: You can do something with these values here, such as sending them to a server
    console.log("Nom de l'entreprise:", enterpriseName);
    console.log("Secteur d'activité:", sector);
    console.log("Evaluation:", evaluation);
    console.log("entreprise cree entreprise");
}

// Add event listeners
create_btn.addEventListener('click', function(e) {
    console.log("affiche cree entreprise");
    pop_up_cree_Entreprise.style.display = "block";
    
    quitter_pop_up_cree_Entreprise.addEventListener('click', quitterPopUpCree);
    creer_pop_up_cree_Entreprise.addEventListener('click', creerPopUpCree);
});

// Remove event listeners when necessary
function removeEventListeners() {
    quitter_pop_up_cree_Entreprise.removeEventListener('click', quitterPopUpCree);
    creer_pop_up_cree_Entreprise.removeEventListener('click', creerPopUpCree);
}



//================================================================POP UP MODIFY=====================================================
const modify_btn = document.getElementsByClassName("btnModify")[0];

const pop_up_modify_btn_Entreprise = document.getElementsByClassName("popup_modifier_entreprise")[0];
const quitter_pop_up_modify_btn_Entreprise = pop_up_modify_btn_Entreprise.getElementsByClassName("left_btn")[0];
const modifier_pop_up_modify_btn_Entreprise = pop_up_modify_btn_Entreprise.getElementsByClassName("right_btn")[0];
const delete_pop_up_modify_btn_Entreprise = pop_up_modify_btn_Entreprise.getElementsByClassName("delete_btn")[0];

console.log(modifier_pop_up_modify_btn_Entreprise);

// Define the event listener functions separately
function quitterPopUpModify(e) {
    pop_up_modify_btn_Entreprise.style.display = "none";
    console.log("quitter modifier entreprise");
}

function modifierPopUpModify(e) {
    pop_up_modify_btn_Entreprise.style.display = "none";
    var enterpriseNameModify = document.getElementById("nameInputModify").value;
    var sectorModify = document.getElementById("sectorInputModify").value;
    var evaluationModify = document.getElementById("gradeInputModify").value;

    console.log("Nom de l'entreprise:", enterpriseNameModify);
    console.log("Secteur d'activité:", sectorModify);
    console.log("Evaluation:", evaluationModify);
    console.log("entreprise modifier entreprise");
}

function deletePopUpModify(e) {
    pop_up_modify_btn_Entreprise.style.display = "none";
    console.log("supprimer entreprise");
}

// Add event listeners
modify_btn.addEventListener('click', function(e) {
    console.log("affiche modifier entreprise");
    pop_up_modify_btn_Entreprise.style.display = "block";

    quitter_pop_up_modify_btn_Entreprise.addEventListener('click', quitterPopUpModify);
    modifier_pop_up_modify_btn_Entreprise.addEventListener('click', modifierPopUpModify);
    delete_pop_up_modify_btn_Entreprise.addEventListener('click', deletePopUpModify);
});

// Remove event listeners when necessary
function removeEventListeners() {
    quitter_pop_up_modify_btn_Entreprise.removeEventListener('click', quitterPopUpModify);
    modifier_pop_up_modify_btn_Entreprise.removeEventListener('click', modifierPopUpModify);
    delete_pop_up_modify_btn_Entreprise.removeEventListener('click', deletePopUpModify);
}
