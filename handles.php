<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the SQLite database
$database = new SQLite3('/var/www/kaggle/handles.db');

// Fetch all entries from the `handles` table
$results = $database->query("SELECT * FROM handles");

// HTML and table structure
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Handles Database</title>
    <style>
        /* Add some basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Handles Database</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Navn</th>
                <th>Git-handle</th>
                <th>Kaggle-handle</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $results->fetchArray(SQLITE3_ASSOC)) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td>
                        <a href="https://github.com/<?php echo htmlspecialchars($row['git_handle']); ?>" target="_blank">
                            <?php echo htmlspecialchars($row['git_handle']); ?>
                        </a>
                    </td>
                    <td>
                        <a href="https://www.kaggle.com/<?php echo htmlspecialchars($row['kaggle_handle']); ?>" target="_blank">
                            <?php echo htmlspecialchars($row['kaggle_handle']); ?>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
