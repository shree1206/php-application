<?php
session_start();
// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login");
    exit;
} else {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
        header("location: admin");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Welcome</title>
</head>

<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
    <p>You have successfully logged in.</p>
    <p><a href="<?php echo BASE_URL; ?>/logout">Logout</a></p>
</body>

</html>