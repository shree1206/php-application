<?php
if (!defined('INSIDE_APP')) {
    header("Location: ../../logout");
    exit;
}

function hasSideBarData()
{
    if (isset($_SESSION['prefixed_user_id']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 1) {
        $db3 = connectToDatabase('admin-application');
        if ($db3 === null) {
            error_log("Database connection failed.");
            return false;
        }

        $actionsData = [];
        $action_status = 1;
        $action_option_status = 1;

        // Step 1: Get all actions with status 1
        $sql = "SELECT * FROM actions WHERE action_status = ?";
        $stmt = $db3->prepare($sql);
        if ($stmt === false) {
            error_log("Failed to prepare statement for actions: " . $db3->error);
            $db3->close();
            return false;
        }
        $stmt->bind_param("i", $action_status);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch all rows into the actionsData array
        while ($row = $result->fetch_assoc()) {
            $actionsData[] = $row;
        }
        $stmt->close();

        // Step 2: Loop through the actions and get their options
        if (!empty($actionsData)) {
            $sql_options = "SELECT * FROM action_options WHERE action_option_status = ? AND action_option_fk_action_id = ?";
            $stmt_options = $db3->prepare($sql_options);

            foreach ($actionsData as $key => $action) {
                // Get the action ID for the foreign key lookup
                $action_id = $action['action_id'];

                // Execute the second query for the current action
                $stmt_options->bind_param("ii", $action_option_status, $action_id);
                $stmt_options->execute();
                $result_options = $stmt_options->get_result();

                // Store all options for the current action in a new array
                $options = [];
                while ($option_row = $result_options->fetch_assoc()) {
                    $options[] = $option_row;
                }

                // Add the options array to the parent action in actionsData
                $actionsData[$key]['options'] = $options;
            }
            $stmt_options->close();
        }

        $db3->close();

        // Return the final, modified array
        return [
            'actionsData' => $actionsData,
            'dataFound' => !empty($actionsData),
        ];

    } else {
        return false;
    }
}
?>