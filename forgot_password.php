<?php
// Include the database connection and Composer's autoloader
require_once __DIR__ . '/includes/connection.php';
// Check if the user is already logged in, then redirect to the welcome page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: welcome");
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailOrUsername = $_POST['email_or_username'];

    // Find user by either email or username
    $sql = "SELECT id, email, password FROM users WHERE email = ? OR username = ?";
    $db1 = connectToDatabase('user_auth');
    $stmt = $db1->prepare($sql);
    $stmt->bind_param("ss", $emailOrUsername, $emailOrUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userId = $user['id'];
        $userEmail = $user['email'];
        $userPassword = $user['password'];

        // Generate a secure, unique token
        $token = bin2hex(random_bytes(32));
        $expiresAt = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Store the token in the password_resets table
        $sql = "INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE token=?, expires_at=?";
        $stmt = $db1->prepare($sql);
        $stmt->bind_param("issss", $userId, $token, $expiresAt, $token, $expiresAt);
        $stmt->execute();

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true); // Passing `true` enables exceptions

        try {
            // Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = SMTP_USERNAME;                 // SMTP username (your Gmail address)
            $mail->Password = SMTP_PASSWORD;           // SMTP password (the app password you created)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
            $mail->Port = 587;                                    // TCP port to connect to

            // Recipients
            $mail->setFrom(SENT_FROM, 'Vaibhav');
            $mail->addAddress($userEmail, 'Vivek');  // Add a recipient

            // Contenf
            $resetLink = '' . BASE_URL . '/reset_password.php?token=' . $token;
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = 'Click the following link to reset your password: <a href="' . $resetLink . '">' . $resetLink . '</a>';
            $mail->AltBody = 'Click the following link to reset your password: ' . $resetLink;

            $mail->send();
            $message = "A password reset link has been sent to your email address.";
        } catch (Exception $e) {

            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
<?php require_once __DIR__ . '/includes/header.php'; ?>
<div class="container-fluid d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Forgot Password</h2>
            <p class="text-center text-info"><?php echo htmlspecialchars($message); ?></p>
            <form action="forgot_password.php" method="post">
                <div class="mb-3">
                    <label for="email_or_username" class="form-label">Enter Email or Username:</label>
                    <input type="text" id="email_or_username" name="email_or_username" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Send Reset Link</button>
                </div>
            </form>
            <p class="text-center mt-3">
                Already have an account? <a href="<?php echo BASE_URL; ?>/login">Login here</a>
            </p>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>