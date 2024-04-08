
document.addEventListener("DOMContentLoaded", function() {
        // Votre code ici


    function clickWorkForLove(N){
        for (let i = 0; i < N && i<document.getElementsByClassName("entreprise").length; i++) {
            const entrepris = document.getElementsByClassName("entreprise")[i];
            const fav = document.getElementsByClassName("fav")[0];
            fav.addEventListener('click', function(e) {
                if (fav.innerHTML == "🖤")
                    fav.innerHTML = "❤️";
                else
                    fav.innerHTML = "🖤";

                console.log(fav_or_not());
            });

            function fav_or_not() {
                if (fav.innerHTML == "🖤")
                    return false;
                else
                    return true;
            };
        }
    }

    cherche_bar.addEventListener('focus', function(e) {
        cherche_bar.addEventListener('keypress', function(e) {
            console.log(cherche_bar.value);
        });
    });
    select_place.addEventListener('change', function(e) {
        console.log(select_place.value);
    });


    const salaire = document.getElementsByClassName("salaire")[0];
    console.log(salaire.innerHTML);
    //salaire.innerHTML = "516";



    /////////////////////////////////popup///////////////////////////////////////







    function clickWorkForOffres(N){
        for (let i = 0; i < N && i<document.getElementsByClassName("entreprise").length; i++) {
            const entrepris = document.getElementsByClassName("entreprise")[i];
            const pop_up_cree_offre = document.getElementsByClassName("pop_up_cree_offre")[i];
            const quiter_pop_up_cree_offre = pop_up_cree_offre.getElementsByClassName("left_buton")[0];



            const pop_up_postuler_offre = document.getElementsByClassName("pop_up_postuler_offre")[i];
            const quiter_pop_up_postuler_offre = pop_up_postuler_offre.getElementsByClassName("left_buton")[0];
            const postuler_pop_up_postuler_offre = pop_up_postuler_offre.getElementsByClassName("right_buton")[0];



            const pop_up_cv = document.getElementsByClassName("pop_up_cv")[i];
            const quiter_pop_up_cv = pop_up_cv.getElementsByClassName("left_buton")[0];



            entrepris.addEventListener('click', function(e) {
                console.log("affiche entreprise");
                pop_up_cree_offre.classList.add("show");
                quiter_pop_up_cree_offre.addEventListener('click', function(e) {
                    pop_up_cree_offre.classList.remove("show");
                });
            });

            entrepris.addEventListener('click', function(e) {
                pop_up_postuler_offre.classList.add("show");
                quiter_pop_up_postuler_offre.addEventListener('click', function(e) {
                    pop_up_postuler_offre.classList.remove("show");
                });
                postuler_pop_up_postuler_offre.addEventListener('click', function(e) {
                    pop_up_cv.classList.add("show");
                    quiter_pop_up_cv.addEventListener('click', function(e) {
                        pop_up_cv.classList.remove("show");
                    });
                });
            });
        }
    }

    function clickWidow(){
        if (window.innerWidth>950) {
            clickWorkForOffres(3);
            clickWorkForLove(3);
        }
        else {
            clickWorkForOffres(12);
            clickWorkForLove(12);
        }
    }
    clickWidow();

    window.addEventListener('resize', async function(e) {

        console.log("la taille change");
        clickWidow();
        location.reload(true);
    });
});
