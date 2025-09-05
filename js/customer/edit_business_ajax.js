
document.addEventListener('DOMContentLoaded', function () {
    const editForm = document.getElementById('editForm');
    const updateBtn = document.getElementById('updateBtn');
    const loader = document.getElementById('loader');
    const messageDiv = document.getElementById('message');

    editForm.addEventListener('submit', function (e) {
        e.preventDefault();

        updateBtn.disabled = true;
        loader.style.display = 'block';
        messageDiv.style.display = 'none';

        const formData = new FormData(editForm);

        fetch('/application/ajax/customer/update_business_ajax.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            messageDiv.style.display = 'block';
            if (data.success) {
                loader.style.display = 'none';
                messageDiv.className = 'alert alert-success';
                messageDiv.innerHTML = data.message;
                updateBtn.disabled = true;
                setTimeout(() => {
                    window.location.href = './';
                }, 1500);
            } else {
                loader.style.display = 'none';
                updateBtn.disabled = false;
                messageDiv.className = 'alert alert-danger';
                messageDiv.innerHTML = data.message;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            messageDiv.style.display = 'block';
            messageDiv.className = 'alert alert-danger';
            messageDiv.innerHTML = 'An unexpected error occurred.';
        });
    });
});