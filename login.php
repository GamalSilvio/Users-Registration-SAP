<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Users" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Log in">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new SQLite3('users.db');
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        $result = $stmt->execute();

        $row = $result->fetchArray(SQLITE3_ASSOC);
        if ($row) {
            echo "Welcome, you have logged in successfully " . $row['username'] . "!";
        } else {
            echo "User or password is incorrect.";
        }
    }
    ?>
</body>
</html>