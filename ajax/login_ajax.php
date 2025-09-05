<?php
ob_start();
require_once __DIR__ . '/../includes/connection.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && $_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT id, password, role, prefixed_user_id FROM users WHERE username = ?";
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
                $_SESSION['prefixed_user_id'] = $user['prefixed_user_id'];
                echo json_encode(['success' => true, 'message' => 'Successfully LoggedIn.']);
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
    header('Content-Type: application/json');
    ob_end_flush();
    exit;
} else {
    header("Location: ../index.php");
    exit;
}
?>