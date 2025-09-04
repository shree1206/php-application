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

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $db1 = connectToDatabase('user_auth');
    $stmt = $db1->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $db1->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
</head>

<body>
    <h2>Sign Up</h2>
    <form action="signup" method="post">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account?<a href="<?php echo BASE_URL; ?>/login">Login here</a></p>
</body>

</html>