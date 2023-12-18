<!DOCTYPE html>
<html>
<head>
    <title>Sign up</title>
</head>
<body>
    <h1>Sign up</h1>
    <form action="signup_safe.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Sign up">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new SQLite3('users_safe.db');

        $stmt = $db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        $result = $stmt->execute();

        if ($result) {
            echo "User has signed up successfully.";
            // Redirect to login_safe.php after successful signup
            header("Location: login_safe.php");
            exit();
        } else {
            echo "Something went wrong with your sign up.";
        }
    }
    ?>
</body>
</html>
