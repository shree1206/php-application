    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const loader = document.getElementById('loader');
    const messageDiv = document.getElementById('message');
    const messageText = document.getElementById('message-text'); // Get the span for the text

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();

        loginBtn.disabled = true;
        loader.style.display = 'block';
        messageDiv.style.display = 'none';

        const formData = new FormData(loginForm);

        fetch('/application/ajax/login_ajax.php', {
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
                    window.location.href = 'welcome';
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
                loginBtn.disabled = false;
                loader.style.display = 'none';
    });
    });