<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../Database/databaseQueries.php';
require_once __DIR__ . '/../../Helpers/formHandler.php';
class formHandlerTest extends TestCase
{

    protected function setUp(): void
    {
        // Set up the PDO instance
        $this->pdo = new PDO('pgsql:host=localhost;dbname=postgres', 'postgres', 'postgres');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function testAddUser(): void
    {
        // Input data
        $name = 'John Doe';
        $sector = ['IT'];
        $agreed_terms = true;

        addUserDataQuery($this->pdo, $name, $sector, $agreed_terms);

        // Get the user data from the database
        $stmt = $this->pdo->prepare("SELECT name, sector FROM users WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Assert that the name is added correctly
        $this->assertEquals($name, $result['name']);
        $this->assertEquals($sector[0], $result['sector']);
    }

    public function testUpdateUserDataQuery()
    {

        // Test data
        $name = "John Doe";
        $sectors = ["Sector A", "Sector B", "Sector C"];
        $agreedTerms = 1;
        $userId = 1;

        updateUserDataQuery($this->pdo, $name, $sectors, $agreedTerms, $userId);

        // Retrieve the updated user data from the database
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $userId);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Assert that the user data has been updated correctly
        $this->assertEquals($name, $userData['name']);
        $this->assertEquals(implode(", ", $sectors), $userData['sector']);
        $this->assertEquals($agreedTerms, $userData['agreed_terms']);
    }

    public function testPreformDataValidation(): void
    {
        $testCases = [
            // Test case: Valid data
            [
                'name' => 'John Doe',
                'sector' => 'IT',
                'agreed_terms' => true,
                'expectedErrors' => [],
            ],
            // Test case: Empty name
            [
                'name' => '',
                'sector' => 'IT',
                'agreed_terms' => true,
                'expectedErrors' => ['Name is required.'],
            ],
            // Test case: Empty sector
            [
                'name' => 'John Doe',
                'sector' => '',
                'agreed_terms' => true,
                'expectedErrors' => ['Please select at least one sector.'],
            ],
            // Test case: Not agreeing to terms
            [
                'name' => 'John Doe',
                'sector' => 'IT',
                'agreed_terms' => false,
                'expectedErrors' => ['You must agree to the terms.'],
            ],
        ];

        foreach ($testCases as $testCase) {
            $errors = preformDataValidation($testCase['name'], $testCase['sector'], $testCase['agreed_terms']);
            $this->assertEquals($testCase['expectedErrors'], $errors);
        }

    }
}
