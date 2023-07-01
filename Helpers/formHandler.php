<?php
require_once '../Database/database.php';
require_once '../Database/databaseQueries.php';

// Call the function from database.php to get the PDO instance
$pdo = getPDO();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate and sanitize the input data
    $name = trim($_POST["name"]);
    $sectors = $_POST["sectors"];
    $agreed_terms = isset($_POST["agreed_terms"]);
    $formType = $_POST["form_type"];

    function removeUser($pdo): void
    {
        $userId = $_POST["user_id"];
        removeUserQuery($pdo, $userId);

    }

    function addUser($pdo, $name, $sector, $agreed_terms): void
    {
       addUserDataQuery($pdo, $name, $sector, $agreed_terms);
    }

    function updateUserData($pdo, $name, $sector, $agreed_terms): void
    {
        $userId = $_POST["user_id"];
        updateUserDataQuery($pdo, $name, $sector, $agreed_terms, $userId);
    }

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
            if (isset($_POST["delete"])) {
                removeUser($pdo);
            } elseif (isset($_POST["Save"])) {
                addUser($pdo, $name, $sectors, $agreed_terms);
                // Get the newly assigned user ID
                $userId = $pdo->lastInsertId();
            } elseif (isset($_POST["Update"])) {
                updateUserData($pdo, $name, $sectors, $agreed_terms);
                $userId = getUserIdByName($pdo, $name);
            } else {
                echo "Something went Wrong!";
            }
            // Redirect the user to their profile page
            header("Location: ../profile.php?id=" . $userId);
        } else {
            // Display validation errors and refill the form with submitted data
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        }
    }
    // Main function to call
    processForm($pdo, $name, $sectors,$agreed_terms);
}
?>

