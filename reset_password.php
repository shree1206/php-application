<?php
// Include database connection
require_once __DIR__ . '/includes/connection.php';
// Check if the user is already logged in, then redirect to the welcome page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: welcome");
    exit;
}

$message = '';
$tokenValid = false;
$token = '';
$db1 = connectToDatabase('user_auth');

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    // Validate the token and check for expiration
    $sql = "SELECT user_id FROM password_resets WHERE token = ? AND expires_at > NOW()";
    $stmt = $db1->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $tokenValid = true;
    } else {
        $message = "The password reset link is invalid or has expired." . "<p>Already have an account? <a href='" . BASE_URL . "/login'>Login here</a></p>";
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the form submission for the new password
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    if ($newPassword !== $confirmPassword) {
        $message = "Passwords do not match.<br> <a href=" . BASE_URL . "/reset_password.php?token=" . $token . ">Try Again</a>";
    } else {
        $sql = "SELECT user_id FROM password_resets WHERE token = ? AND expires_at > NOW()";
        $stmt = $db1->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $userId = $user['user_id'];
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $db1->begin_transaction();
            try {
                // Update the user's password
                $sql_update = "UPDATE users SET password = ? WHERE id = ?";
                $stmt_update = $db1->prepare($sql_update);
                $stmt_update->bind_param("si", $hashedPassword, $userId);
                $stmt_update->execute();

                // Delete the token to prevent re-use
                $sql_delete = "DELETE FROM password_resets WHERE token = ?";
                $stmt_delete = $db1->prepare($sql_delete);
                $stmt_delete->bind_param("s", $token);
                $stmt_delete->execute();

                $db1->commit();
                $message = "Your password has been reset successfully. You can now  <a href='" . BASE_URL . "/login'>Login here</a>";
            } catch (Exception $e) {
                $db1->rollback();
                $message = "An error occurred. Please try again.";
            }
        } else {
            $message = "Invalid or expired token.";
        }
    }
} else {
    $message = "Invalid request." . "<p>Already have an account? <a href='" . BASE_URL . "/login'>logIn Here</a></p>";
}
?>
<?php require_once __DIR__ . '/includes/header.php'; ?>
<div class="container-fluid d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Reset Password</h2>
            <p class="text-center text-danger"><?php echo $message; ?></p>
            <?php if (isset($tokenValid) && $tokenValid && empty($message)): ?>
                <form action="reset_password.php" method="post">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password:</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>