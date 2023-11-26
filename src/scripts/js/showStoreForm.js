(function () {
    document.addEventListener("DOMContentLoaded", function () {
    const storeLink = document.getElementById('store_link');
    const storeForm = document.getElementById('store__form');

    function showStoreForm() {
        if (storeForm.style.display === 'none' || storeForm.style.display === '') {
            storeForm.style.display = 'flex';
        } else {
            storeForm.style.display = 'none';
        }
    }

    storeLink.addEventListener('click', showStoreForm);
});
})();