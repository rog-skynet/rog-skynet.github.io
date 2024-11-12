<?php
header('Content-Type: application/json');

$realName = $_POST['real-name'] ?? '';
$gitHandle = $_POST['git-handle'] ?? '';
$kaggleHandle = $_POST['kaggle-handle'] ?? '';

try {
    // Assume you have a PDO instance called $pdo
    $pdo = new PDO('sqlite:handles.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ensure the table exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS handles (
        id INTEGER PRIMARY KEY,
        real_name TEXT,
        git_handle TEXT,
        kaggle_handle TEXT
    )");

    // Insert the data
    $stmt = $pdo->prepare("INSERT INTO handles (real_name, git_handle, kaggle_handle) VALUES (:realName, :gitHandle, :kaggleHandle)");
    $stmt->bindParam(':realName', $realName);
    $stmt->bindParam(':gitHandle', $gitHandle);
    $stmt->bindParam(':kaggleHandle', $kaggleHandle);
    $stmt->execute();

    // Respond with success
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Respond with failure
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
