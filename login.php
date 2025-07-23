<!DOCTYPE html>
<html>
<head>
    <title>Login - MyCMS</title>
    <link rel="stylesheet" href="style-login.css">
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Enter username" required>
            <input type="password" name="password" placeholder="Enter password" required>
            <button type="submit">Login</button>
        </form>
        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("includes/db.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from DB
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Secure password check
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // redirect to dashboard
            exit;
        } else {
            echo "<p style='color:red;'>Invalid password</p>";
        }
    } else {
        echo "<p style='color:red;'>User not found</p>";
    }

    $stmt->close();
    $conn->close();
}

?>

    </div>
</body>
</html>
