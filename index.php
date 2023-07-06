<?php
require_once __DIR__ . '/Database/database.php';
require_once __DIR__ . '/Database/createTables.php';
require_once __DIR__ . '/Helpers/generateSectorOptions.php';
require_once __DIR__ . '/Database/databaseQueries.php';
require_once __DIR__ . '/Helpers/saveSectorsToDb.php';

createTables();

$pdo = getPDO();

// Get sectors from the database
$sectors = getAllSectorsQuery($pdo);

if (empty($sectors)) {
    saveSectors($pdo, returnCategories());
    $sectors = getAllSectorsQuery($pdo);
}

// Generate Sector options
$sectorOptions = generateSectorOptionsIndex($sectors);

// Populate the form fields with the user's data
$name = '';
$agreed_terms = '';

$pageTitle = "Please enter your name and pick the Sectors you are currently involved in.";
$formTitle = "Please enter your name and pick the Sectors you are currently involved in.";
$formAction = "Helpers/formHandler.php?id={id}";
$submitButtonLabel = "Save";
$showIndexLink = false;
$formType = "add";

// Define the variables array
$templateVariables = compact('pageTitle', 'formTitle', 'formAction', 'name', 'sectorOptions', 'agreed_terms', 'submitButtonLabel', 'showIndexLink');

// Include the template file and extract the variables
include 'shared.php';

renderForm($pageTitle, $formTitle, $formAction, $name, $sectorOptions, $agreed_terms, $submitButtonLabel, $showIndexLink, $formType);
?>