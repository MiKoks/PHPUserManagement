<?php
require_once __DIR__ . '/Database/database.php';
require_once __DIR__ . '/Database/databaseQueries.php';
require_once __DIR__ . '/Helpers/generateSectorOptions.php';

$pdo = getPDO();

$userId = $_GET['id'];

// Get the user's data from the database
$user = getUserDataQuery($pdo, $userId);

// Check if the user exists
if ($user === null) {
    echo "User not found.";
    exit;
}

// Populate the form fields with the user's data
$name = isset($_POST["name"]) ? trim($_POST["name"]) : $user['name'];
$userSelectedSectors = $_POST["sectors"] ?? explode(", ", $user['sector']);
$sector = explode(", ", $user['sector']);
$agreed_terms = $_POST["agreed_terms"] ?? (isset($user['agreed_terms']) && $user['agreed_terms']);

// Fetch sectors from the database
$sectorsData = getAllSectorsQuery($pdo);

// Function to generate Sector options
$sectorOptions = generateSectorOptionsEditUser($sectorsData, $sector);

$pageTitle = "Edit Information";
$formTitle = "Edit Your Information";
$formAction = "Helpers/formHandler.php?id=" . $userId;
$submitButtonLabel = "Update";
$showIndexLink = true;
$formType = 'edit';

// Define the variables array
$templateVariables = compact('pageTitle', 'formTitle', 'formAction', 'name', 'sectorOptions', 'agreed_terms', 'submitButtonLabel', 'showIndexLink');

// Include the template file and extract the variables
extract($templateVariables);

include 'shared.php';

renderForm($pageTitle, $formTitle, $formAction, $name, $sectorOptions, $agreed_terms, $submitButtonLabel, $showIndexLink,$formType, $userId);
?>