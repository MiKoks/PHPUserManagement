document.addEventListener('DOMContentLoaded', function() {
    // Get the chosen sectors from the PHP variable
    const chosenSectors = JSON.parse('<?php echo json_encode($sectors); ?>');

    const sectorsSelect = document.getElementById('sectorsSelect');

    // Find the option elements for the chosen sectors and scroll the select to the first found option
    for (let i = 0; i < sectorsSelect.options.length; i++) {
        if (chosenSectors.includes(sectorsSelect.options[i].value)) {
            sectorsSelect.options[i].scrollIntoView();
            break;
        }
    }
});
