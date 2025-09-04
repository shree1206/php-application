<?php
require_once __DIR__ . '/includes/config.php';
// Set the HTTP response status code to 404
http_response_code(404);
?>
<!DOCTYPE html>
<html>

<head>
    <title>404 Not Found</title>
</head>

<body>
    <h1>404 Page Not Found</h1>
    <p>Sorry, the page you are looking for could not be found.</p>
    <p>You can go back to the <a href="<?php echo BASE_URL; ?>/">homepage</a>.</p>
</body>

</html>