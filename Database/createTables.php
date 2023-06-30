<?php
require_once '../Database/database.php';
require_once '../Database/databaseQueries.php';

// Read the schema.sql file
$schema = file_get_contents('..\Database\schema.sql');

try {
    // Call the function from database.php to get the PDO instance
    $pdo = getPDO();
    $tableExists = false;

    // Check if the table exists
    $result = checkIfTableExistsQuery($pdo);

    if ($result && $result['exists']) {
        $tableExists = true;
    }

    if (!$tableExists) {
        $pdo->exec($schema);
        echo "Table created successfully!";
    }
} catch (PDOException $e) {
    die("Table creation failed: " . $e->getMessage());
}