function previewImage() {
    var fileInput = document.getElementById('file');
    var uploadedPhoto = document.getElementById('uploaded_photo');
    const uploadButton = document.getElementById('upload');

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            uploadedPhoto.src = e.target.result;
            uploadButton.style.display = 'none';
            uploadedPhoto.style.display = 'block';
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}