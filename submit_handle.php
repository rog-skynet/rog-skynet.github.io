<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$log_file = '/var/www/kaggle/submit_handle_log.txt';

try {
    $database = new SQLite3('/var/www/kaggle/handles.db');
    file_put_contents($log_file, "Database opened successfully\n", FILE_APPEND);

    $name = $_POST['name'] ?? '';
    $git_handle = $_POST['git_handle'] ?? '';
    $kaggle_handle = $_POST['kaggle_handle'] ?? '';

    if (!$name || !$git_handle || !$kaggle_handle) {
        file_put_contents($log_file, "Missing data: name=$name, git_handle=$git_handle, kaggle_handle=$kaggle_handle\n", FILE_APPEND);
        echo json_encode(['success' => false]);
        exit;
    }

    $stmt = $database->prepare("INSERT INTO handles (name, git_handle, kaggle_handle) VALUES (:name, :git_handle, :kaggle_handle)");
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':git_handle', $git_handle, SQLITE3_TEXT);
    $stmt->bindValue(':kaggle_handle', $kaggle_handle, SQLITE3_TEXT);

    if ($stmt->execute()) {
        file_put_contents($log_file, "Inserted: $name, $git_handle, $kaggle_handle\n", FILE_APPEND);
        echo json_encode(['success' => true]);
    } else {
        file_put_contents($log_file, "Failed to insert\n", FILE_APPEND);
        echo json_encode(['success' => false]);
    }
} catch (Exception $e) {
    file_put_contents($log_file, "Exception: " . $e->getMessage() . "\n", FILE_APPEND);
    echo json_encode(['success' => false]);
}
?>
