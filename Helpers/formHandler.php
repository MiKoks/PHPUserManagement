<?php
require_once __DIR__ . '/../Database/database.php';
require_once __DIR__ . '/../Database/databaseQueries.php';

// Call the function from database.php to get the PDO instance
$pdo = getPDO();

// Validate and sanitize the input data
$name = isset($_POST["name"]) ? trim($_POST["name"]) : "";
$sectors = $_POST["sectors"] ?? [];
$agreed_terms = isset($_POST["agreed_terms"]) && $_POST["agreed_terms"] == "on";
$formType = $_POST["form_type"] ?? "";

// Main function to call
processForm($pdo, $name, $sectors,$agreed_terms);

function preformDataValidation( $name, $sector,$agreed_terms): array
{
    // Perform data validation
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required.";
    } elseif (empty($sector)) {
        $errors[] = "Please select at least one sector.";
    } elseif (!$agreed_terms) {
        $errors[] = "You must agree to the terms.";
    }
    return $errors;
}
function processForm($pdo, $name, $sectors,$agreed_terms): void
{
    $errors = preformDataValidation($name, $sectors,$agreed_terms);
    if (empty($errors)) {
        if (isset($_POST["Save"])) {
            addUserDataQuery($pdo, $name, $sectors, $agreed_terms);
            $userId = $pdo->lastInsertId();
            header("Location: ../profile.php?id=" . $userId);
        } elseif (isset($_POST["Update"])) {
            $userId = $_POST["user_id"];
            updateUserDataQuery($pdo, $name, $sectors, $agreed_terms, $userId);
            header("Location: ../profile.php?id=" . $userId);
        } else {
            echo "Something went Wrong!";
        }

    } else {
        // Display validation errors and refill the form with submitted data
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
}
?>

