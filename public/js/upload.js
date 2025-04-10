document.addEventListener('DOMContentLoaded', function () {

    const uploadForm = document.getElementById('uploadForm');
    const fileInput = document.getElementById('file');
    const spinner = document.getElementById('loadingSpinner');
    const maxSizeInBytes = 20 * 1024 * 1024;

    if (!uploadForm) {
        console.error("Upload form not found!");
        return;
    }

    uploadForm.addEventListener('submit', function (e) {
        console.log("Submit event triggered!");

        const file = fileInput.files[0];

        if (file && file.size > maxSizeInBytes) {
            e.preventDefault();
            alert("File is too large. Maximum allowed size is 20 MB.");
            return;
        }
        if (spinner) {
            spinner.classList.remove('d-none');
        }
    });
});
