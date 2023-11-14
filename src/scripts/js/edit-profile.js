(function () {
    document.addEventListener("DOMContentLoaded", function () {
        const buttonSave = document.getElementById('button_save');
        const buttonEdit = document.getElementById('button_edit');
        const inputs = document.querySelectorAll('input');
    
        inputs.forEach(input => input.disabled = buttonSave.disabled);
        buttonEdit.disabled = !buttonSave.disabled;
    
        buttonEdit.addEventListener('click', function() {
            buttonEdit.disabled = true;
            buttonSave.disabled = false;
            buttonEdit.classList.add('button--disabled');
            buttonSave.classList.remove('button--disabled');
            buttonEdit.classList.remove('button--gray');
            
            inputs.forEach(input => input.disabled = false);
        });
    
        buttonSave.addEventListener('click', function() {
            const formData = new FormData();
            inputs.forEach(input => formData.append(input.name, input.value));

            fetch('../php/vendor/update-data.php', {
                method: 'POST',
                body: formData
            });

            buttonSave.disabled = true;
            buttonEdit.disabled = false;
            buttonSave.classList.add('button--disabled');
            buttonEdit.classList.remove('button--disabled');
            buttonEdit.classList.add('button--gray');
            
            inputs.forEach(input => input.disabled = true);
        });
    });
})();