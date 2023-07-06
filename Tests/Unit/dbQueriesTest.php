<?php


use PHPUnit\Framework\TestCase;

class dbQueriesTest extends TestCase
{
    protected function setUp(): void
    {
        // Set up the PDO instance
        $this->pdo = new PDO('pgsql:host=localhost;dbname=postgres', 'postgres', 'postgres');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    function testGetSectorNameById() {
        $categories = ['id' => 1, 'name' => 'Manufacturing', 'children' => []];
        saveSectors($this->pdo, $categories, $parentId = null);
        $sectorName = getSectorNameById($this->pdo, $categories['id']);

        $this->assertEquals($categories['name'], $sectorName);

        // Clean up the test table
        $schema = file_get_contents('Database\schema.sql');
        $this->pdo->exec($schema);
    }

    public function testGetAllSectorsQuery()
    {
        // Create a test table and insert some sample data
        createTables();
        $this->pdo->exec("
            INSERT INTO sectors (id, name, parent_id)
            VALUES
                (45, 'Sector A', NULL),
                (74, 'Sector B', 45),
                (32, 'Sector C', 74)
        ");

        // Call the function being tested
        $sectors = getAllSectorsQuery($this->pdo);

        // Assert the expected sector data
        $this->assertContains(['id' => 45, 'name' => 'Sector A', 'parent_id' => NULL], $sectors);
        $this->assertContains(['id' => 74, 'name' => 'Sector B', 'parent_id' => 45], $sectors);
        $this->assertContains(['id' => 32, 'name' => 'Sector C', 'parent_id' => 74], $sectors);

        // Clean up the test table
        $schema = file_get_contents('Database\schema.sql');
        $this->pdo->exec($schema);
    }

    public function testGetUserDataQuery()
    {

        // Create a test user and insert sample data

        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS  users (
                id INT PRIMARY KEY,
                name VARCHAR(50),
                sector VARCHAR(50),
                agreed_terms INT
            )
        ");


        $this->pdo->exec("
            INSERT INTO users (id, name, sector, agreed_terms)
            VALUES
                (35, 'John Forest', 'Sector F', true)
        ");
        $userId = 35;
        // Call the function being tested
        $userData = getUserDataQuery($this->pdo, $userId);

        // Assert the expected user data
        $expectedUserData = [
            'name' => 'John Forest',
            'sector' => 'Sector F',
            'agreed_terms' => 1
        ];
        $this->assertEquals($expectedUserData, $userData);
    }
}
