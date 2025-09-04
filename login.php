<?php
// Include your database connection file
require_once __DIR__ . '/includes/connection.php';

// Check if the user is already logged in, then redirect to the welcome page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: welcome");
    exit;
}

// Check if the request is an AJAX call (sent via fetch/XMLHttpRequest)
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // This part of the code is executed only for AJAX requests
    header('Content-Type: application/json');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT id, password, role FROM users WHERE username = ?";
        $db1 = connectToDatabase('user_auth');
        $stmt = $db1->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role'];
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
    exit; // Stop execution to prevent HTML from being sent
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form id="loginForm" method="post">
        <label>Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label>Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit" id="loginBtn">Login</button>
    </form>
    <p>Forgot Password? <a href="<?php echo BASE_URL; ?>/forgot_password">Click Here</a></p>
    <div id="loader" style="display:none;">Loading...</div>
    <div id="message"></div>

    <script>
        // JavaScript for handling the form submission via AJAX
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

            fetch('login', {
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
    </script>
</body>

</html>