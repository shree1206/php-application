    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const loader = document.getElementById('loader');
    const messageDiv = document.getElementById('message');

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();

        loginBtn.disabled = true;
        loader.style.display = 'block';
        messageDiv.innerHTML = '';

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
                if (data.success) {
                    window.location.href = 'welcome';
                } else {
                    messageDiv.innerHTML = `<span style="color: red;">${data.message}</span>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageDiv.innerHTML = `<span style="color: red;">An error occurred. Please try again.</span>`;
            })
            .finally(() => {
                loginBtn.disabled = false;
                loader.style.display = 'none';
            });
    });