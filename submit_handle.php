<?php
// Database file path
$dbFile = 'handles.db';

// Create a new SQLite3 database if it doesn’t exist
$db = new SQLite3($dbFile);

// Create table if it doesn’t exist
$db->exec("CREATE TABLE IF NOT EXISTS handles (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    git_handle TEXT NOT NULL,
    kaggle_handle TEXT NOT NULL
)");

// Prepare and bind parameters to insert user data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $git_handle = htmlspecialchars($_POST["git_handle"]);
    $kaggle_handle = htmlspecialchars($_POST["kaggle_handle"]);

    // Prepare and execute insert statement
    $stmt = $db->prepare("INSERT INTO handles (name, git_handle, kaggle_handle) VALUES (:name, :git_handle, :kaggle_handle)");
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':git_handle', $git_handle, SQLITE3_TEXT);
    $stmt->bindValue(':kaggle_handle', $kaggle_handle, SQLITE3_TEXT);
    $stmt->execute();

    echo "Handles submitted successfully!";
}

// Close the database connection
$db->close();
?>
