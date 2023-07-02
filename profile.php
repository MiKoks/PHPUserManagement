<?php

require_once 'Database/database.php';
require_once 'Database/databaseQueries.php';

// Call the function from database.php to get the PDO instance
$pdo = getPDO();

// Get the user ID from the URL parameter
$userId = $_GET['id'];

// Get the user's data from the database
$user = getUserDataQuery($pdo, $userId);

// Check if the user exists
if ($user === null) {
    echo "User not found.";
    exit;
}

// Extract the user's data
$pageTitle = "User profile";
$formTitle = "User profile";
$name = $user['name'];
$sector = $user['sector'];
$sectorName = getSectorNameById($pdo, $sector);
$showIndexLink = true;
$formType = 'edit';
$templateVariables = compact('pageTitle', 'formTitle', 'name', 'showIndexLink');

// Include the shared HTML template
include 'shared.php';

// Render the profile information
renderProfile($name, $sectorName, $userId);
