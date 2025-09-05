
    const passwordChangeForm = document.getElementById('passwordChangeForm');
    const saveBtn = document.getElementById('saveBtn');
    const loader = document.getElementById('loader');
    const messageDiv = document.getElementById('message');
    const messageText = document.getElementById('message-text'); // Get the span for the text

    passwordChangeForm.addEventListener('submit', function (event) {
        event.preventDefault();

        saveBtn.disabled = true;
        loader.style.display = 'block';
        messageDiv.style.display = 'none'; // Hide the alert at the start

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
                 messageDiv.style.display = 'block'; // Show the alert after receiving a response
                if (data.success) {

                    // Set alert class for success
                    messageDiv.classList.remove('alert-danger');
                    messageDiv.classList.add('alert-success');
                    messageText.innerHTML = `<span style="color: green;">${data.message}</span>`;
                    passwordChangeForm.reset();
                } else {
                    messageDiv.classList.remove('alert-success');
                    messageDiv.classList.add('alert-danger');
                    messageText.innerHTML = `<span style="color: red;">${data.message}</span>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageDiv.style.display = 'block';
                messageDiv.classList.remove('alert-success');
                messageDiv.classList.add('alert-danger');
                messageText.innerHTML = `<span style="color: red;">An error occurred. Please try again.</span>`;
            })
            .finally(() => {
                saveBtn.disabled = false;
                loader.style.display = 'none';
            });
    });