<?php
// Function to recursively generate the HTML options with indentation
function generateSectorOptionsEditUser($sectors, $selectedSectors, $parentId = 0, $indent = ""): string
{
    $options = "";
    foreach ($sectors as $sector) {
        if ($sector['parent_id'] == $parentId) {
            $selected = in_array($sector['id'], $selectedSectors) ? 'selected' : '';
            $options .= '<option value="' . $sector['id'] . '" ' . $selected . '>' . $indent . $sector['name'] . '</option>';
            $options .= generateSectorOptionsEditUser($sectors, $selectedSectors, $sector['id'], $indent . "&nbsp;&nbsp;&nbsp;&nbsp;");
        }
    }
    return $options;
}
function generateSectorOptionsIndex($sectors, $parentId = 0, $indent = ""): string
{
    $options = "";
    foreach ($sectors as $sector) {
        if ($sector['parent_id'] == $parentId) {
            $options .= '<option value="' . $sector['id'] . '">' . $indent . $sector['name'] . '</option>';
            $options .= generateSectorOptionsIndex($sectors, $sector['id'], $indent . "&nbsp;&nbsp;&nbsp;&nbsp;");
        }
    }
    return $options;
}