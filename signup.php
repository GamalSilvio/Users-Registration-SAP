<!DOCTYPE html>
<html>
<head>
    <title>Sign up</title>
</head>
<body>
    <h1>Sign up</h1>
    <form action="signup.php" method="post">
        <input type="text" name="username" placeholder="User" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Sign up">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new SQLite3('users.db');

        // Vulnerable code: SQL injection
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        $result = $db->query($query);

        if ($result) {
            echo "User has signed up successfully.";
        } else {
            echo "Something went wrong with you sign up.";
        }
    }
    ?>
</body>
</html>