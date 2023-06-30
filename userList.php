<?php
require_once 'Database/database.php';
require_once 'Database/databaseQueries.php';

// Call the function from database.php to get the PDO instance
$pdo = getPDO();

// Fetch users from the database
$users = getAllUsersQuery($pdo)
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Css/index.css">
    <title>User List</title>
</head>
<body>
    <div class="wrapper">
        <h2 class="Title">User List</h2>
            <ul class="ListItSelf">
                <?php foreach ($users as $user) : ?>
                <div class="ListContainer">
                    <a href="editUser.php?id=<?php echo $user['id']; ?>" class="ListItems Links"><?php echo $user['name']; ?></a>
                </div>
                <?php endforeach; ?>
            </ul>
        <a href="index.php" class="SubmitButton">Back to main</a>
    </div>
</body>
</html>
