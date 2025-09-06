<?php
if (!defined('INSIDE_APP')) {
    header("Location: logout");
    exit;
}
function hasSideBarData()
{
    $db3 = connectToDatabase('admin-application');
    if ($db3 === null) {
        error_log("Database connection failed.");
        return false;
    }
    $categoriesData = [];
    $categories_status = 1;

    $sql = "SELECT * FROM categories WHERE categories_status = ?";
    $stmt = $db3->prepare($sql);
    if ($stmt === false) {
        error_log("Failed to prepare statement for actions: " . $db3->error);
        $db3->close();
        return false;
    }

    $stmt->bind_param("i", $categories_status);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $categoriesData[] = $row;
        if (isset($row['categories_popular']) && $row['categories_popular'] == 1) {
            $popularData[] = $row;
        }
    }

    $stmt->close();
    $db3->close();

    return [
        'categoriesData' => $categoriesData,
        'dataFound' => !empty($categoriesData),
        'popularData' => $popularData,
        'popularDataFound' => !empty($popularData)
    ];
}
?>