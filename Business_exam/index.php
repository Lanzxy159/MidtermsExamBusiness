<?php
session_start(); // Start the session
require_once 'core/models.php';
require_once 'core/dbConfig.php';
?>
<?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="loginstyles.css"> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Midterm Exam</title>
</head>
<body>
    <div class="form-container">
        <h1>Login</h1>
        <form action="core/handleForms.php" method="POST">
            <p>Username: <input type="text" placeholder="Enter username" name="username"></p>
            <p>Password: <input type="password" placeholder="Enter password" name="password"></p>
            <p><input type="submit" value="Login" name="login_button"></p>
        </form>
        <form action="core/handleForms.php" method="POST">
            <p><input type="submit" value="Register" name="register_button"></p>
        </form>
    </div>
</body>
</html>
