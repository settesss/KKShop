document.addEventListener("DOMContentLoaded", function() {
    const cartOrderButton = document.getElementById('cart__button');
    const popUp = document.getElementById('success__modal');
    const popUpClose = document.getElementById('success__close');

    const isPopupOpen = localStorage.getItem('popupOpen') === 'true';

    if (isPopupOpen) {
        popUp.style.display = "flex";
    }

    cartOrderButton.addEventListener("click", () => {
        popUp.style.display = "flex";
        localStorage.setItem('popupOpen', 'true');
    })

    popUpClose.addEventListener("click", () => {
        popUp.style.display = "none";
        localStorage.setItem('popupOpen', 'false');
    })
})