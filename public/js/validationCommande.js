window.addEventListener('load', e =>{
    button = document.querySelector('#valide');
    button.addEventListener('click',()=>{
        onclickValidePanier();
    });
});

function onclickValidePanier(){
    selectAdresse = document.querySelector('#adresse');
    valeur = selectAdresse.options[selectAdresse.selectedIndex].value;

    window.location='/commande/new?adresse='+valeur;
}