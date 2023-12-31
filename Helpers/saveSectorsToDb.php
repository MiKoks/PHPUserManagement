<?php
require_once __DIR__ . '/../Database/database.php';
require_once __DIR__ . '/../Database/databaseQueries.php';

// Call the function from database.php to get the PDO instance
$pdo = getPDO();

// Array of sector data
function returnCategories(): array
{
    return [
            'id' => 1,
            'name' => 'Manufacturing',
            'children' => [
                ['id' => 19, 'name' => 'Construction materials', 'children' => []],
                ['id' => 18, 'name' => 'Electronics and Optics', 'children' => []],
                [
                    'id' => 6,
                    'name' => 'Food and Beverage',
                    'children' => [
                        ['id' => 342, 'name' => 'Bakery & confectionery products', 'children' => []],
                        ['id' => 43, 'name' => 'Beverages', 'children' => []],
                        ['id' => 42, 'name' => 'Fish & fish products', 'children' => []],
                        ['id' => 40, 'name' => 'Meat & meat products', 'children' => []],
                        ['id' => 39, 'name' => 'Milk & dairy products', 'children' => []],
                        ['id' => 437, 'name' => 'Other', 'children' => []],
                        ['id' => 378, 'name' => 'Sweets & snack food', 'children' => []]
                    ]
                ],
                [
                    'id' => 13,
                    'name' => 'Furniture',
                    'children' => [
                        ['id' => 389, 'name' => 'Bathroom/sauna', 'children' => []],
                        ['id' => 385, 'name' => 'Bedroom', 'children' => []],
                        ['id' => 390, 'name' => 'Children’s room', 'children' => []],
                        ['id' => 98, 'name' => 'Kitchen', 'children' => []],
                        ['id' => 101, 'name' => 'Living room', 'children' => []],
                        ['id' => 392, 'name' => 'Office', 'children' => []],
                        ['id' => 394, 'name' => 'Other (Furniture)', 'children' => []],
                        ['id' => 341, 'name' => 'Outdoor', 'children' => []],
                        ['id' => 99, 'name' => 'Project furniture', 'children' => []]
                    ]
                ],
                [
                    'id' => 12,
                    'name' => 'Machinery',
                    'children' => [
                        ['id' => 94, 'name' => 'Machinery components', 'children' => []],
                        ['id' => 91, 'name' => 'Machinery equipment/tools', 'children' => []],
                        ['id' => 224, 'name' => 'Manufacture of machinery', 'children' => []],
                        ['id' => 97, 'name' => 'Maritime', 'children' => [
                            ['id' => 271, 'name' => 'Aluminium and steel workboats', 'children' => []],
                            ['id' => 269, 'name' => 'Boat/Yacht building', 'children' => []],
                            ['id' => 230, 'name' => 'Ship repair and conversion', 'children' => []]
                        ]],
                        ['id' => 93, 'name' => 'Metal structures', 'children' => []],
                        ['id' => 508, 'name' => 'Other', 'children' => []],
                        ['id' => 227, 'name' => 'Repair and maintenance service', 'children' => []]
                    ]
                ],
                [
                    'id' => 11,
                    'name' => 'Metalworking',
                    'children' => [
                        ['id' => 67, 'name' => 'Construction of metal structures', 'children' => []],
                        ['id' => 263, 'name' => 'Houses and buildings', 'children' => []],
                        ['id' => 267, 'name' => 'Metal products', 'children' => []],
                        ['id' => 542, 'name' => 'Metal works', 'children' => [
                            ['id' => 75, 'name' => 'CNC-machining', 'children' => []],
                            ['id' => 62, 'name' => 'Forgings, Fasteners', 'children' => []],
                            ['id' => 69, 'name' => 'Gas, Plasma, Laser cutting', 'children' => []],
                            ['id' => 66, 'name' => 'MIG, TIG, Aluminum welding', 'children' => []]
                        ]]
                    ]
                ],
                [
                    'id' => 9,
                    'name' => 'Plastic and Rubber',
                    'children' => [
                        ['id' => 54, 'name' => 'Packaging', 'children' => []],
                        ['id' => 556, 'name' => 'Plastic goods', 'children' => []],
                        ['id' => 559, 'name' => 'Plastic processing technology', 'children' => [
                            ['id' => 55, 'name' => 'Blowing', 'children' => []],
                            ['id' => 57, 'name' => 'Moulding', 'children' => []],
                            ['id' => 53, 'name' => 'Plastics welding and processing', 'children' => []]
                        ]],
                        ['id' => 560, 'name' => 'Plastic profiles', 'children' => []]
                    ]
                ],
                ['id' => 5, 'name' => 'Printing', 'children' => [
                    ['id' => 148, 'name' => 'Advertising', 'children' => []],
                    ['id' => 150, 'name' => 'Book/Periodicals printing', 'children' => []],
                    ['id' => 145, 'name' => 'Labelling and packaging printing', 'children' => []]
                ]],
                [
                    'id' => 7,
                    'name' => 'Textile and Clothing',
                    'children' => [
                        ['id' => 44, 'name' => 'Clothing', 'children' => []],
                        ['id' => 45, 'name' => 'Textile', 'children' => []]
                    ]
                ],
                [
                    'id' => 8,
                    'name' => 'Wood',
                    'children' => [
                        ['id' => 337, 'name' => 'Other (Wood)', 'children' => []],
                        ['id' => 51, 'name' => 'Wooden building materials', 'children' => []],
                        ['id' => 47, 'name' => 'Wooden houses', 'children' => []]
                    ]
                ],
                ['id' => 3, 'name' => 'Other', 'children' => [
                    ['id' => 37, 'name' => 'Creative industries', 'children' => []],
                    ['id' => 29, 'name' => 'Energy technology', 'children' => []],
                    ['id' => 33, 'name' => 'Environment', 'children' => []]
                ]],
                ['id' => 2, 'name' => 'Service', 'children' => [
                    ['id' => 25, 'name' => 'Business services', 'children' => []],
                    ['id' => 35, 'name' => 'Engineering', 'children' => []],
                    ['id' => 28, 'name' => 'Information Technology and Telecommunications', 'children' => [
                        ['id' => 581, 'name' => 'Data processing, Web portals, E-marketing', 'children' => []],
                        ['id' => 576, 'name' => 'Programming, Consultancy', 'children' => []],
                        ['id' => 121, 'name' => 'Software, Hardware', 'children' => []],
                        ['id' => 122, 'name' => 'Telecommunications', 'children' => []]
                    ]],
                    ['id' => 22, 'name' => 'Tourism', 'children' => []],
                    ['id' => 141, 'name' => 'Translation services', 'children' => []],
                    ['id' => 21, 'name' => 'Transport and Logistics', 'children' => [
                        ['id' => 111, 'name' => 'Air', 'children' => []],
                        ['id' => 114, 'name' => 'Rail', 'children' => []],
                        ['id' => 112, 'name' => 'Road', 'children' => []],
                        ['id' => 113, 'name' => 'Water', 'children' => []]
                    ]]
                ]]
            ]
        ];
}

// Recursive function to save sectors and their parent-child relationships
function saveSectors($pdo, $category, $parentId = null): void
{
    // Add sectors to database
    $insertStmt = addSectorsQuery($pdo);

    try {
        $insertStmt->execute([$category['name'], $parentId]);
        $sectorId = $pdo->lastInsertId();
    } catch (PDOException $e) {
        echo $e;
        $sectorId = null;
    }

    if (!empty($category['children'])) {
        foreach ($category['children'] as $child) {
            saveSectors($pdo, $child, $sectorId);
        }
    }
}