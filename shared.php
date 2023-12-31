<?php
function renderForm($pageTitle, $formTitle, $formAction, $name, $sectorOption, $agreed_terms, $submitButtonLabel, $showIndexLink, $formType = '', $userId = null): void
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="/Css/index.css">
        <script src="Javascript/scrollIntoView.js"></script>
        <title><?php echo $pageTitle; ?></title>
    </head>
    <body>
    <div class="wrapper">
        <h2><?php echo $formTitle; ?></h2>
        <form method="POST" action="<?php echo $formAction; ?>">
            <label for="name">Name</label>
            <br>
            <input type="text" name="name" id="name" required
                   value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
            <br><br>

            <label for="sectors">Sectors</label>
            <select name="sectors[]" id="sectors" multiple size="5" required>
                <?php echo $sectorOption; ?>
            </select>
            <br><br>

            <label for="agreed_terms">Agree to terms</label>
            <br>
            <input type="checkbox" name="agreed_terms" id="agreed_terms"
                   required <?php echo $agreed_terms ? 'checked' : ''; ?>>
            <br><br>

            <input type="hidden" name="form_type" value="<?php echo $formType; ?>">
            <?php if ($formType === 'edit' || $formType === 'remove'): ?>
                <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
            <?php endif; ?>
            <div>
            <input type="submit" value="<?php echo $submitButtonLabel; ?>" name="<?php echo $submitButtonLabel; ?>"
                   class="SubmitButton">
            <?php if ($showIndexLink) : ?>
                <a href="profile.php?id=<?php echo $userId; ?>" class="SubmitButton">Back to profile</a>
                <a href="index.php" class="SubmitButton">Home page</a>
            <?php endif; ?>
            </div>
        </form>
    </div>
    </body>
    </html>
    <?php
}

function renderProfile($name, $sectorName, $userId): void
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="/Css/index.css">
        <title>User Profile</title>
    </head>
    <body>
    <div class="wrapper">
        <h2>User Profile</h2>
        <br>
        <label><strong>Name:</strong> <?php echo $name; ?></label>
        <br>
        <label><strong>Sector:</strong> <?php echo $sectorName; ?></label>
        <br>
        <br>
        <div>
            <a href="index.php" class="SubmitButton">Home</a>
            <a href="editUser.php?id=<?php echo $userId; ?>" class="SubmitButton">Edit User</a>
        </div>
        <br>
    </div>
    </body>
    </html>
    <?php
}

?>