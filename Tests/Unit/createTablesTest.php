<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../Database/createTables.php';
class createTablesTest extends TestCase
{
    protected function setUp(): void
    {
        // Set up the PDO instance
        $this->pdo = new PDO('pgsql:host=localhost;dbname=postgres', 'postgres', 'postgres');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function testCreateTable()
    {
        createTables();

        $tableExists = checkIfTableExistsQuery($this->pdo);

        $this->assertTrue($tableExists['exists']);

    }
}
