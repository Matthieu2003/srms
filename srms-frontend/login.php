<?php
// Start a session to manage user authentication
session_start();

// Check if the user is already logged in, redirect to the form if true
if (isset($_SESSION['username'])) {
    header("Location: index11.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "JCF_2003"; 
    $password = "Sw0rdf!sh12"; 

    // Validate the entered username and password (replace with a secure authentication method)
    if ($_POST["username"] == $username && $_POST["password"] == $password) {
        // Authentication successful, store the username in the session
        $_SESSION['username'] = $username;

        // Redirect to the form page
        header("Location: index11.php");
        exit();
    } else {
        $loginError = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles3.css"> 
    <title>Login Page</title>
</head>
<body>

<div class="logo-container">
    <img src="imgs/jcflogo.png" alt="Logo">
</div>

<div class="login-container">
    <h2>SRMS USER LOGIN</h2>
    
    <?php if (isset($loginError)) { ?>
        <p class="error-message"><?= $loginError ?></p>
    <?php } ?>

    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>
