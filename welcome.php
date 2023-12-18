<?php
session_start();

// Check if the user is not logged in, redirect to the index page
if (!isset($_SESSION['username'])) {
    header("Location: index_safe.php");
    exit();
}

// Logout logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the index page after logging out
    header("Location: index_safe.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome</h1>
    <?php
    // Display welcome message if the user is logged in
    echo "<p>You are logged in, " . htmlspecialchars($_SESSION['username']) . "!</p>";
    ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="submit" name="logout" value="Log Out">
    </form>
</body>
</html>
