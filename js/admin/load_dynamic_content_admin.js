 function loadContent(filePath) {
            fetch('load_dynamic_content_admin.php?file=' + encodeURIComponent(filePath), {
                method: 'GET',
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
                    const container = document.getElementById('dynamic-content-area');
                    document.getElementById('dynamic-content-area').innerHTML = content;
                    const scripts = container.querySelectorAll('script');
                    scripts.forEach(oldScript => {
                        const newScript = document.createElement('script');
                        Array.from(oldScript.attributes).forEach(attr => {
                            newScript.setAttribute(attr.name, attr.value);
                        });
                        if (oldScript.textContent) {
                            newScript.textContent = oldScript.textContent;
                        }
                        oldScript.parentNode.removeChild(oldScript);
                        document.body.appendChild(newScript);
                    });
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    document.getElementById('dynamic-content-area').innerHTML = 'An error occurred while loading content.';
                });
        }