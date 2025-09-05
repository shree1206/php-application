<?php
ob_start();
require_once __DIR__ . '/../includes/connection.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && $_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($username) || empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = 2;

        $db1 = connectToDatabase('user_auth');
        if ($db1 === null) {
            echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
            exit;
        }

        // Check if username is already in use
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $db1->prepare($sql);
        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Error preparing username check statement.']);
            $db1->close();
            exit;
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'This username is already in use.']);
            $stmt->close();
            $db1->close();
            exit;
        }
        $stmt->close();

        // Check if email is already in use
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $db1->prepare($sql);
        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Error preparing email check statement.']);
            $db1->close();
            exit;
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'This email is already in use.']);
            $stmt->close();
            $db1->close();
            exit;
        }
        $stmt->close();

        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $db1->prepare($sql);

        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Error preparing statement.']);
            $db1->close();
            exit;
        }

        $stmt->bind_param("sssi", $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Data Saved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Something went wrong.']);
        }
        $stmt->close();
        $db1->close();
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