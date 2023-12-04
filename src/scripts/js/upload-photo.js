function previewImage() {
    const fileInput = document.getElementById('file');
    const uploadedPhoto = document.getElementById('uploaded_photo');
    const uploadButton = document.getElementById('upload');

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            uploadedPhoto.src = e.target.result;
            uploadButton.style.display = 'none';
            uploadedPhoto.style.display = 'block';
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}