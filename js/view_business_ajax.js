document.addEventListener('DOMContentLoaded', function() {
    const loader = document.getElementById('loader');
    const businessDataContainer = document.getElementById('business-data');
    
    // Show loader and hide data container initially
    loader.style.display = 'block';
    businessDataContainer.style.display = 'none';

    fetch('/application/ajax/fetch_business_data.php', {
            method: 'GET',
            // Add a custom header to identify the AJAX request on the server side
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const business = data.data;
                document.getElementById('name').textContent = business.full_name;
                document.getElementById('business-name').textContent = business.business_name;
                document.getElementById('contact-number').textContent = business.contact_number;
                document.getElementById('category').textContent = business.category;
                document.getElementById('address').textContent = business.address;
                const statusElement = document.getElementById('status');

                if (business.status == 0) {
                    statusElement.innerHTML  = '<strong>Inactive</strong>';
                    statusElement.style.color = 'red';
                } else {
                    statusElement.innerHTML  = '<strong>Active</strong>';
                    statusElement.style.color = 'green';
                }
                
                businessDataContainer.style.display = 'block';
            } else {
                // Display a message if no data is found
                businessDataContainer.innerHTML = `<div class="alert alert-warning text-center">${data.message}</div>`;
                businessDataContainer.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            businessDataContainer.innerHTML = `<div class="alert alert-danger text-center">Failed to load data. Please try again later.</div>`;
            businessDataContainer.style.display = 'block';
        })
        .finally(() => {
            // Hide loader whether successful or not
            loader.style.display = 'none';
        });
});