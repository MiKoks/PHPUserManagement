<?php

function getAllUsersQuery($pdo) {
    // Fetch users from the database
    $stmt = $pdo->query("SELECT id, name FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllSectorsQuery($pdo)
{
    // Fetch sectors from the database
    $stmt = $pdo->query("SELECT id, name, parent_id FROM sectors");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateUserDataQuery($pdo, $name, $sectors, $agreed_terms, $userId): void
{
    // Prepare and execute the database query to update the data
    $stmt = $pdo->prepare("UPDATE users SET name = :name, sectors = :sectors, agreed_terms = :agreed_terms WHERE id = :id");
    $stmt->bindParam(":name", $name);
    $sectorsString = implode(", ", $sectors);
    $stmt->bindParam(":sectors", $sectorsString);
    $stmt->bindParam(":id", $userId);
    $stmt->bindParam(":agreed_terms", $agreed_terms);
    $stmt->execute();
}


function getUserDataQuery($pdo, $userId)
{
    // Fetch the user's data from the database
    $stmt = $pdo->prepare("SELECT name, sectors, agreed_terms FROM users WHERE id = :id");
    $stmt->bindParam(":id", $userId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function checkIfTableExistsQuery($pdo) {

    // Check if the table exists
    $stmt = $pdo->prepare("SELECT EXISTS (SELECT FROM information_schema.tables WHERE table_name = 'users')");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addUserDataQuery($pdo, $name, $sectors, $agreed_terms): void
{
    // Insert a new user to the database
    $stmt = $pdo->prepare("INSERT INTO users (name, sectors, agreed_terms) VALUES (:name, :sectors, :agreed_terms)");
    $stmt->bindParam(":name", $name);
    $sectorsString = implode(", ", $sectors);
    $stmt->bindParam(":sectors", $sectorsString);
    $stmt->bindParam(":agreed_terms", $agreed_terms, PDO::PARAM_BOOL);
    $stmt->execute();
}

function addSectorsQuery($pdo)
{
    // Add sectors to database
    return $pdo->prepare("INSERT INTO sectors (name, parent_id) VALUES (?, ?)");
}

function removeUserQuery(PDO $pdo, int $userId): bool {
    $query = "DELETE FROM users WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':id', $userId, PDO::PARAM_INT);
    return $statement->execute();
}

