<?php
if (!defined('INSIDE_APP')) {
    header("Location: ../");
    exit;
} ?>
<script>
    // The variables are already correctly declared
    const categoryForm = document.getElementById('categoryForm');
    const saveBtn = document.getElementById('saveBtn');
    const buttonText = document.getElementById('button-text');
    const spinner = document.getElementById('spinner');
    const progressBar = document.querySelector('.progress');
    const progressBarInner = document.querySelector('.progress-bar');
    const alertMessage = document.getElementById('alert-message');

    categoryForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const form = event.target;

        // Disable button and show spinner
        saveBtn.disabled = true;
        buttonText.style.display = 'none';
        spinner.style.display = 'inline-block';

        // Show progress bar
        progressBar.style.display = 'flex';
        progressBarInner.style.width = '0%';
        progressBarInner.setAttribute('aria-valuenow', 0);

        // Hide previous alerts
        alertMessage.style.display = 'none';

        // Create a new XMLHttpRequest object for progress tracking
        const request = new XMLHttpRequest();
        const formData = new FormData(form);

        request.open('POST', '/application/ajax/admin/upload_category.php', true);

        request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        // Track upload progress
        request.upload.addEventListener('progress', function (e) {
            if (e.lengthComputable) {
                const percent = (e.loaded / e.total) * 100;
                progressBarInner.style.width = percent + '%';
                progressBarInner.setAttribute('aria-valuenow', percent);
            }
        });

        // Handle the response
        request.onload = function () {
            // Re-enable button and hide spinner
            saveBtn.disabled = false;
            buttonText.style.display = 'inline-block';
            spinner.style.display = 'none';
            progressBar.style.display = 'none';

            if (request.status === 200) {
                try {
                    const response = JSON.parse(request.responseText);
                    alertMessage.textContent = response.message;
                    alertMessage.style.display = 'block';
                    alertMessage.className = 'alert ' + (response.success ? 'alert-success' : 'alert-danger');

                    // Clear form on success
                    if (response.success) {
                        form.reset();
                    }
                } catch (e) {
                    alertMessage.textContent = 'Server response error.';
                    alertMessage.style.display = 'block';
                    alertMessage.className = 'alert alert-danger';
                }
            } else {
                alertMessage.textContent = 'Server error: ' + request.status;
                alertMessage.style.display = 'block';
                alertMessage.className = 'alert alert-danger';
            }
        };

        request.onerror = function () {
            saveBtn.disabled = false;
            buttonText.style.display = 'inline-block';
            spinner.style.display = 'none';
            progressBar.style.display = 'none';

            alertMessage.textContent = 'Network error during upload.';
            alertMessage.style.display = 'block';
            alertMessage.className = 'alert alert-danger';
        };

        request.send(formData);
    });
</script>