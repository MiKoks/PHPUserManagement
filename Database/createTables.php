<?php
require_once 'database.php';
require_once 'databaseQueries.php';


function createTables(): void
{
    // Read the schema.sql file
    $schema = file_get_contents('Database\schema.sql');
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
        }
    } catch (PDOException $e) {
        die("Table creation failed: " . $e->getMessage());
    }
}