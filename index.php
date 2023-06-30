<?php
require_once 'Database/database.php';
require_once 'Helpers/generateSectorOptions.php';
require_once 'Database/databaseQueries.php';
require_once 'Helpers/saveSectorsToDb.php';


// Call the function from database.php to get the PDO instance
$pdo = getPDO();

// Fetch sectors from the database

$sectors = getAllSectorsQuery($pdo);

if (empty($sectors)) {
    saveSectors($pdo, returnCategories());
    $sectors = getAllSectorsQuery($pdo);
}

// Function to generate Sector options
$sectorOptions = generateSectorOptionsIndex($sectors);

// Populate the form fields with the user's data
$name = '';
$agreed_terms = '';

$pageTitle = "Please enter your name and pick the Sectors you are currently involved in.";
$formTitle = "Please enter your name and pick the Sectors you are currently involved in.";
$formAction = "Helpers/processForm.php";
$submitButtonLabel = "Save";
$showIndexLink = false;
$formType = "add";

// Define the variables array
$templateVariables = compact('pageTitle', 'formTitle', 'formAction', 'name', 'sectorOptions', 'agreed_terms', 'submitButtonLabel', 'showIndexLink');

// Include the template file and extract the variables

include 'sharedHTML.php';

renderForm($pageTitle, $formTitle, $formAction, $name, $sectorOptions, $agreed_terms, $submitButtonLabel, $showIndexLink, $formType);
?>