
    const passwordChangeForm = document.getElementById('passwordChangeForm');
    const saveBtn = document.getElementById('saveBtn');
    const loader = document.getElementById('loader');
    const messageDiv = document.getElementById('message');

    passwordChangeForm.addEventListener('submit', function (event) {
        event.preventDefault();

        saveBtn.disabled = true;
        loader.style.display = 'block';
        messageDiv.innerHTML = '';

        const formData = new FormData(passwordChangeForm);

        fetch('/application/ajax/password_change_ajax.php', {
            method: 'POST',
            body: formData,
            // Add a custom header to identify the AJAX request on the server side
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageDiv.innerHTML = `<span style="color: green;">${data.message}</span>`;
                } else {
                    messageDiv.innerHTML = `<span style="color: red;">${data.message}</span>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageDiv.innerHTML = `<span style="color: red;">An error occurred. Please try again.</span>`;
            })
            .finally(() => {
                saveBtn.disabled = false;
                loader.style.display = 'none';
            });
    });