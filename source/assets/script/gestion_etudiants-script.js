// contrôler la fenêtre modale

var modal = document.getElementById('myModal');
var btn = document.getElementById('openModalBtn');
var cancelBtn = document.querySelector('.cancel');

btn.onclick = function () {
    modal.style.display = 'block';
}

cancelBtn.onclick = function () {
    modal.style.display = 'none';
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
//Pour modifier un etudiant

document.addEventListener('DOMContentLoaded', (event) => {
    // L'élément qui déclenche l'ouverture de la modale de modification
    var editIcons = document.getElementsByClassName('info-icon');

    // La modale de modification
    var modifyModal = document.getElementById('modifyUserModal');

    // Bouton pour fermer la modale de modification
    var closeModifyModalBtn = document.getElementById('closeModifyModal');

    // Ajoutez un gestionnaire de clic pour chaque icône de modification
    Array.from(editIcons).forEach(function (editIcon) {
        editIcon.addEventListener('click', function () {
            // Ouvrir la modale de modification
            modifyModal.style.display = 'block';
        });
    });

    // Gestionnaire de clic pour fermer la modale de modification
    closeModifyModalBtn.addEventListener('click', function () {
        modifyModal.style.display = 'none';
    });

    // Fermer la modale si l'utilisateur clique en dehors de celle-ci
    window.addEventListener('click', function (event) {
        if (event.target === modifyModal) {
            modifyModal.style.display = 'none';
        }
    });
});


//api

//pour fonctionner la console en ecrivant dans search-bar
document.addEventListener("DOMContentLoaded", function () {
    console.log('Script loaded');
    const searchInput = document.querySelector('.search-input');

    searchInput.addEventListener("search", function () {
        console.log(searchInput.value);
        window.location.href = `/users?recherche=${encodeURI(searchInput.value)}`;
    });
});

// AJOUT d'un utilisateur
document.querySelector('.submit').addEventListener('click', function (event) {
    event.preventDefault();
    const firstName = document.querySelector('#userName').value;
    const lastName = document.querySelector('#userFirstName').value;
    const email = document.querySelector('#userEmail').value;
    const promotion = document.querySelector('#userPromotion').value;
    const type = document.querySelector('#userType').value;
    // POST /api/v1/users puis recherger la page
    fetch('/api/v1/users', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            first_name: firstName,
            last_name: lastName,
            email: email,
            promotion: promotion,
            type: type
        })
    }).then(r => {
        if (r.ok) {
            window.location.reload();
        } else {
            window.alert('Une erreur est survenue');
        }
    })
});


//pour recuperer les memes infos de user-card dans la modale
document.addEventListener('DOMContentLoaded', () => {
    const infoIcons = document.querySelectorAll('.info-icon');

    infoIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            const id = icon.getAttribute('data-id');
            const firstName = icon.getAttribute('data-firstname');
            const lastName = icon.getAttribute('data-lastname');
            const email = icon.getAttribute('data-email');
            const promotion = icon.getAttribute('data-promotion');
            const type = icon.getAttribute('data-type');


            document.getElementById('modifyUserId').value = id;
            document.getElementById('modifyUserName').value = lastName;
            document.getElementById('modifyUserFirstName').value = firstName;
            document.getElementById('modifyUserEmail').value = email;
            document.getElementById('modifyUserPromotion').value = promotion;
            document.getElementById('modifyUserType').value = type;

            // Ouvrir la modale
            document.getElementById('modifyUserModal').style.display = 'block';
        });
    });


//pour afficher les informations dans la console lorsqu'on clique sur "Supprimer"
    document.getElementById('deleteUser').addEventListener('click', function () {
        if (window.confirm('Voulez-vous vraiment supprimer cet utilisateur ?')) {
            // DELETE /api/v1/users/:id puis recharger la page
            fetch(`/api/v1/users/${document.getElementById('modifyUserId').value}`, {
                method: 'DELETE'
            }).then(r => {
                if (r.ok) {
                    window.location.reload();
                } else {
                    window.alert('Une erreur est survenue');
                }
            });
        }
    });

//pour  afficher les informations dans la console lorsqu'on  clique sur "Modifier"
    document.getElementById('submitModifications').addEventListener('click', function () {
        // PATCH /api/v1/users/:id puis recharger la page
        fetch(`/api/v1/users/${document.getElementById('modifyUserId').value}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                first_name: document.getElementById('modifyUserName').value,
                last_name: document.getElementById('modifyUserFirstName').value,
                email: document.getElementById('modifyUserEmail').value,
                promotion: document.getElementById('modifyUserPromotion').value,
                type: document.getElementById('modifyUserType').value
            })
        }).then(r => {
            if (r.ok) {
                window.location.reload();
            } else {
                window.alert('Une erreur est survenue');
            }
        });
    });
});