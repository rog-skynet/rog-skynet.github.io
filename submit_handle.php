<?php
// Allow Cross-Origin Requests (for AJAX)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$response = ["status" => "error", "message" => "Submission failed. Please try again."];

if (isset($_POST['name'], $_POST['git_handle'], $_POST['kaggle_handle'])) {
    $name = $_POST['name'];
    $git_handle = $_POST['git_handle'];
    $kaggle_handle = $_POST['kaggle_handle'];

    // Connect to the SQLite database
    $db = new SQLite3('/var/www/kaggle/handles.db');

    if (!$db) {
        $response['message'] = "Database connection failed: " . $db->lastErrorMsg();
        echo json_encode($response);
        exit;
    }

    // Prepare the SQL statement
    $stmt = $db->prepare("INSERT INTO handles (name, git_handle, kaggle_handle) VALUES (:name, :git_handle, :kaggle_handle)");
    if (!$stmt) {
        $response['message'] = "Failed to prepare statement: " . $db->lastErrorMsg();
        echo json_encode($response);
        exit;
    }

    // Bind parameters
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':git_handle', $git_handle, SQLITE3_TEXT);
    $stmt->bindValue(':kaggle_handle', $kaggle_handle, SQLITE3_TEXT);

    // Execute the statement and check for success
    $result = $stmt->execute();
    if ($result) {
        $response['status'] = "success";
        $response['message'] = "Submission successful!";
    } else {
        $response['message'] = "Database write failed: " . $db->lastErrorMsg();
    }

    // Close the database connection
    $db->close();
}

// Return the JSON response
echo json_encode($response);
