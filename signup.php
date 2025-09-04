<?php
require_once __DIR__ . '/includes/connection.php';

// Check if the user is already logged in, then redirect to the welcome page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: welcome");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Set the role for a new user to 2
    $role = 2;

    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $db1 = connectToDatabase('user_auth');
    $stmt = $db1->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $db1->error;
    }
    $stmt->close();
}
?>


<?php require_once __DIR__ . '/includes/header.php'; ?>
<div class="container-fluid d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Sign Up</h2>
            <form action="signup" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>
            </form>
            <p class="text-center mt-3">
                Already have an account?<a href="<?php echo BASE_URL; ?>/login">Login here</a>
            </p>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>