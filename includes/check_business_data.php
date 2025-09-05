<?php
if (!defined('INSIDE_APP')) {
    header("Location: ../");
    exit;
}

function hasBusinessData()
{
    if (isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 2) {
        $db2 = connectToDatabase('user_data');
        if ($db2 === null) {
            error_log("Database connection failed for business data check.");
            return false;
        }

        $user_id = $_SESSION['id'];
        $sql = "SELECT * FROM businesses WHERE fk_user_id = ? LIMIT 1";
        $stmt = $db2->prepare($sql);

        if ($stmt === false) {
            error_log("Failed to prepare statement: " . $db2->error);
            $db2->close();
            return false;
        }

        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $dataFound = ($result->num_rows > 0);
        $businessData = '';
        if ($dataFound) {
            $businessData = $result->fetch_assoc();
        }
        $stmt->close();
        $db2->close();

        return [
            'businessData' => $businessData,
            'dataFound' => $dataFound,
        ];
    } else {
        return false;
    }
}