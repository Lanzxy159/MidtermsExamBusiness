<?php
session_start(); // Start the session
require_once 'core/models.php';
require_once 'core/dbConfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="register.css"> 
</head>
<body>
    <div class="container">
        <header>
            <h1>Login</h1>
        </header>

        <form action="core/handleForms.php" method="POST" class="login-form">
            <div class="form-group">
                <label for="First_name">First Name</label>
                <input type="text" name="First_name" id="First_name" required placeholder="Enter your first name">
            </div>

            <div class="form-group">
                <label for="Last_name">Last Name</label>
                <input type="text" name="Last_name" id="Last_name" required placeholder="Enter your last name">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required placeholder="Enter your username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="Enter your password">
            </div>

            <div class="form-group">
                <input type="submit" value="Login" name="add_registerbtn" class="submit-btn">
            </div>
        </form>
    </div>
</body>
</html>
