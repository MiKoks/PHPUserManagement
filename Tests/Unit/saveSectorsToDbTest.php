<?php
require_once __DIR__ . '/../../Helpers/saveSectorsToDb.php';

use PHPUnit\Framework\TestCase;

class saveSectorsToDbTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        // Create a PDO instance for testing
        $this->pdo = new PDO('pgsql:host=localhost;dbname=postgres', 'postgres', 'postgres');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function createSectorsTable(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS sectors (
                id SERIAL PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                parent_id INTEGER
            )
        ";

        $this->pdo->exec($sql);
    }

    public function testSaveSectors()
    {

        $this->createSectorsTable();

        $category = [
            'name' => 'Parent Sector',
            'children' => [
                [
                    'name' => 'Child Sector 1',
                    'children' => []
                ],
                [
                    'name' => 'Child Sector 2',
                    'children' => []
                ]
            ]
        ];
        saveSectors($this->pdo, $category);
        // Assert that the sectors have been saved to the database
        $stmt = $this->pdo->query("SELECT name FROM sectors");
        $savedSectors = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Expected categories
        $expectedCategories = ['Parent Sector', 'Child Sector 1', 'Child Sector 2'];

        // Check if the saved sectors contain the expected categories
        foreach ($expectedCategories as $category) {
            $this->assertContains($category, $savedSectors);
        }
    }

    protected function tearDown(): void
    {
        // Clean up the database after each test
        $pdo = getPDO();
        $schema = file_get_contents('Database\schema.sql');
        $pdo->exec($schema);
    }
}

