const quiter_menu_click = document.getElementsByClassName("btn_crois")[0].getElementsByTagName("button")[0];
const home_menu_click = document.getElementsByClassName("btn_home")[0].getElementsByTagName("button")[0];
const btn_menu = document.getElementsByClassName("btn_menu")[0].getElementsByTagName("button")[0];
const menu_nav = document.getElementsByClassName("menuClick")[0];
btn_menu.addEventListener("click",function(e) {
    menu_nav.style.display = 'block';
    quiter_menu_click.addEventListener("click",function(e) {
        menu_nav.style.display = 'none';
    });
});


//----------------------------------------------------------------service worker----------------------------------------------------------------



if('serviceWorker' in navigator){
    navigator.serviceWorker.register('assets/script/serviceWorker.js')
        .then( (sw)=> console.log('Le Service Worker a été enregistrer', sw));
}



//Installation du service worker
self.addEventListener('install', evt => {
self.addEventListener('activate', evt => {
console.log('le Service Worker a été installé ');
});
});
