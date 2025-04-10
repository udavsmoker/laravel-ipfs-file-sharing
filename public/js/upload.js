document.addEventListener('DOMContentLoaded', function () {
    const uploadForm = document.getElementById('uploadForm');
    const fileInput = document.getElementById('file');
    const spinner = document.getElementById('loadingSpinner');
    const maxSizeInBytes = 20 * 1024 * 1024;

    const disallowedExtensions = ['exe', 'sh', 'bat', 'php', 'js', 'html', 'vbs', 'msi', 'pl', 'py', 'cgi', 'asp', 'aspx', 'dll', 'com', 'rb', 'wsf', 'jar', 'msm', 'iso', 'apk', 'sys', 'tmp', 'dat'];


    if (!uploadForm) {
        console.error("Upload form not found!");
        return;
    }

    uploadForm.addEventListener('submit', function (e) {
        console.log("Submit event triggered!");

        const file = fileInput.files[0];
        const fileName = file.name;
        const fileExtension = fileName.split('.').pop().toLowerCase();
        console.log(file.size);
        if (file && file.size > maxSizeInBytes) {
            e.preventDefault();
            alert("File is too large. Maximum allowed size is 20 MB.");
            return;
        }

        if (disallowedExtensions.includes(fileExtension)) {
            e.preventDefault();
            alert("This file type is not allowed. Please compress your file into a zip archive and try again.");
            return;
        }

        if (spinner) {
            spinner.classList.remove('d-none');
        }
    });

    var clipboard = new ClipboardJS('.copy-hash');

    clipboard.on('success', function(e) {
        alert('IPFS hash copied to clipboard!');
        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        alert('Failed to copy the IPFS hash.');
    });
});

