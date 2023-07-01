<?php

function getAllSectorsQuery($pdo)
{
    // Fetch sectors from the database
    $stmt = $pdo->query("SELECT id, name, parent_id FROM sectors");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateUserDataQuery($pdo, $name, $sectors, $agreed_terms, $userId): void
{
    // Prepare and execute the database query to update the data
    $stmt = $pdo->prepare("UPDATE users SET name = :name, sector = :sector, agreed_terms = :agreed_terms WHERE id = :id");
    $stmt->bindParam(":name", $name);
    $sectorsString = implode(", ", $sectors);
    $stmt->bindParam(":sector", $sectorsString);
    $stmt->bindParam(":id", $userId);
    $stmt->bindParam(":agreed_terms", $agreed_terms);
    $stmt->execute();
}


function getUserDataQuery($pdo, $userId)
{
    // Fetch the user's data from the database
    $stmt = $pdo->prepare("SELECT name, sector, agreed_terms FROM users WHERE id = :id");
    $stmt->bindParam(":id", $userId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUserId($pdo){
    $stmt = $pdo->prepare("SELECT id, name, sector FROM users WHERE id = :id");
    $stmt->execute();
    return $pdo->lastInsertId();
}




function checkIfTableExistsQuery($pdo) {

    // Check if the table exists
    $stmt = $pdo->prepare("SELECT EXISTS (SELECT FROM information_schema.tables WHERE table_name = 'users')");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addUserDataQuery($pdo, $name, $sectors, $agreed_terms): int
{
    // Insert a new user to the database
    $stmt = $pdo->prepare("INSERT INTO users (name, sector, agreed_terms) VALUES (:name, :sector, :agreed_terms)");
    $stmt->bindParam(":name", $name);
    $sectorsString = implode(", ", $sectors);
    $stmt->bindParam(":sector", $sectorsString);
    $stmt->bindParam(":agreed_terms", $agreed_terms, PDO::PARAM_BOOL);
    $stmt->execute();
    return $pdo->lastInsertId();
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
function getUserIdByName($pdo, $name)
{
    $query = "SELECT id FROM users WHERE name = :name";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['name' => $name]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['id'] ?? null;
}

function getSectorNameById($pdo, $sectorId)
{
    // Prepare and execute a query to retrieve the sector name based on the sector ID
    $query = "SELECT name FROM sectors WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$sectorId]);

    // Fetch the sector name from the query result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['name'];
}

