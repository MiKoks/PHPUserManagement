<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../Helpers/generateSectorOptions.php';

class generateSectorOptionsTest extends TestCase
{
    public function testGenerateSectorOptionsEditUser()
    {
        // sample sectors and selected sectors
        $sectors = [
            ['id' => 1, 'name' => 'Sector 1', 'parent_id' => 0],
            ['id' => 2, 'name' => 'Subsector 1', 'parent_id' => 1],
            ['id' => 3, 'name' => 'Sector 2', 'parent_id' => 0],
        ];
        $selectedSectors = [2];

        $options = generateSectorOptionsEditUser($sectors, $selectedSectors);

        $expectedOptions = '<option value="1">Sector 1</option>' .
            '<option value="2"selected>&nbsp;&nbsp;&nbsp;&nbsp;Subsector 1</option>' .
            '<option value="3">Sector 2</option>';
        $this->assertEquals($expectedOptions, $options);
    }

    public function testGenerateSectorOptionsIndex()
    {
        // sample sectors
        $sectors = [
            ['id' => 1, 'name' => 'Sector 1', 'parent_id' => 0],
            ['id' => 2, 'name' => 'Subsector 1', 'parent_id' => 1],
            ['id' => 3, 'name' => 'Sector 2', 'parent_id' => 0],
        ];

        $options = generateSectorOptionsIndex($sectors);

        $expectedOptions = '<option value="1">Sector 1</option>' .
            '<option value="2">&nbsp;&nbsp;&nbsp;&nbsp;Subsector 1</option>' .
            '<option value="3">Sector 2</option>';
        $this->assertEquals($expectedOptions, $options);
    }

}
