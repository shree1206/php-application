
    const registrationForm = document.getElementById('registrationForm');
    const regBtn = document.getElementById('regBtn');
    const loader = document.getElementById('loader');
    const messageDiv = document.getElementById('message');

    registrationForm.addEventListener('submit', function (event) {
        event.preventDefault();

        regBtn.disabled = true;
        loader.style.display = 'block';
        messageDiv.innerHTML = '';

        const formData = new FormData(registrationForm);

        fetch('/application/ajax/user_business_registration_ajax.php', {
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
                regBtn.disabled = false;
                loader.style.display = 'none';
            });
    });