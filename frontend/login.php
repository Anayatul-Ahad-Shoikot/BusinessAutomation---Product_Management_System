<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMS Login</title>
    <link rel="stylesheet" href="../css/basic.css">
    <link rel="stylesheet" href="../css/login-signup.css">
</head>

<body>
    <div class="wrapper">
        <div class="error">
            <p id="error_msg"></p>
            <?php
                if (isset($_SESSION['success_msg'])) {
                    echo '<p id="success_msg">' . $_SESSION['success_msg'] . '</p>';
                    unset($_SESSION['success_msg']);
                }
            ?>
        </div>
        <section class="form login">
            <header>
                <h1>Login</h1>
            </header>
            <form action="./php/login.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Login">
                </div>
            </form>
            <div class="link">Don't have account? <a href="./register.php">Register</a></div>
        </section>
    </div>

    <script src="./js/login.js"></script>
</body>

</html>