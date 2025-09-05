<?php
ob_start();

require_once __DIR__ . '/../includes/connection.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];
        $username = $_SESSION['username'];
        $userrole = $_SESSION['role'];
        $userID = $_SESSION['id'];

        if (empty($oldpassword) || empty($newpassword) || empty($confirmpassword)) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit;
        }

        if ($newpassword !== $confirmpassword) {
            echo json_encode(['success' => false, 'message' => 'New password and Old Password does not matched.']);
            exit;
        }

        $db1 = connectToDatabase('user_auth');
        if ($db1 === null) {
            echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
            exit;
        }

        $sql_verify = "SELECT password FROM users WHERE username = ?";
        $stmt_verify = $db1->prepare($sql_verify);
        $stmt_verify->bind_param("s", $username);
        $stmt_verify->execute();
        $result = $stmt_verify->get_result();

        if ($result->num_rows === 0) {
            echo json_encode(['success' => false, 'message' => 'User not found.']);
            $stmt_verify->close();
            $db1->close();
            exit;
        }

        $row = $result->fetch_assoc();
        $stored_password_hash = $row['password'];

        if (!password_verify($oldpassword, $stored_password_hash)) {
            echo json_encode(['success' => false, 'message' => 'Incorrect old password.']);
            $stmt_verify->close();
            $db1->close();
            exit;
        }
        $stmt_verify->close();

        $newpassword_hash = password_hash($newpassword, PASSWORD_DEFAULT);
        $updated_at = date('Y-m-d H:i:s');
        $sql_update = "UPDATE users SET password = ?, updated_at = ? WHERE username = ?";
        $stmt_update = $db1->prepare($sql_update);

        if ($stmt_update === false) {
            echo json_encode(['success' => false, 'message' => 'Error preparing update statement.']);
            $db1->close();
            exit;
        }

        $stmt_update->bind_param("sss", $newpassword_hash, $updated_at, $username);

        if ($stmt_update->execute()) {
            echo json_encode(['success' => true, 'message' => 'Password updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Something went wrong.']);
        }

        $stmt_update->close();
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