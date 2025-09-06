 function loadContent(filePath) {
            fetch('load_dynamic_content_admin.php?file=' + encodeURIComponent(filePath), {
                method: 'GET',

                // Add a custom header to identify the AJAX request on the server side
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(content => {
                    document.getElementById('dynamic-content-area').innerHTML = content;
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    document.getElementById('dynamic-content-area').innerHTML = 'An error occurred while loading content.';
                });
        }