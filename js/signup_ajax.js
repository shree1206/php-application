
    const signupForm = document.getElementById('signupForm');
    const signupBtn = document.getElementById('signupBtn');
    const loader = document.getElementById('loader');
    const messageDiv = document.getElementById('message');
    const messageText = document.getElementById('message-text'); // Get the span for the text

    signupForm.addEventListener('submit', function (event) {
        event.preventDefault();

        signupBtn.disabled = true;
        loader.style.display = 'block';
        messageDiv.style.display = 'none';

        const formData = new FormData(signupForm);

        fetch('/application/ajax/signup_ajax.php', {
            method: 'POST',
            body: formData,
            // Add a custom header to identify the AJAX request on the server side
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                messageDiv.style.display = 'block';
                if (data.success) {
                    messageDiv.classList.remove('alert-danger');
                    messageDiv.classList.add('alert-success');
                    messageText.innerHTML = `<span style="color: green;">${data.message}</span>`;
                    signupForm.reset();
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
                signupBtn.disabled = false;
                loader.style.display = 'none';
            });
    });