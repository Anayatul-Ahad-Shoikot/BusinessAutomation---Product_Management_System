<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMS Register</title>
    <link rel="stylesheet" href="../css/basic.css">
    <link rel="stylesheet" href="../css/login-signup.css">
</head>

<body>
    <div class="wrapper">
        <div class="error">
            <p id="error_msg"></p>
        </div>
        <section class="form signup">
            <header>
                <h1>Register</h1>
            </header>
            <form action="#" method="POST" enctype="multipart/form-data" id="registrationForm" autocomplete="off">
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" id="fname" name="fname" placeholder="First name..." required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" id="lname" name="lname" placeholder="Last name..." required>
                    </div>
                </div>
                <div class="field input">
                    <label>Warehouse Name</label>
                    <input type="text" id="warehouse" name="warehouse" placeholder="Your warehouse name..." required>
                </div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email" required >
                </div>
                <div class="field input">
                    <label>Phone</label>
                    <input type="text" id="phone" name="phone" placeholder="Contact number..." required >
                </div>
                <div class="name-details">
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" id="password" name="password" placeholder="Choose password..." required >
                    </div>
                    <div class="field input">
                        <label>Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password..." required >
                    </div>
                </div>
                <div class="field image">
                    <label>Warehouse Image</label>
                    <input type="file" id="image" name="image" accept="image/*" required >
                </div>
                <div class="field button">
                    <input type="submit" id="submit" name="submit" value="Register">
                </div>
            </form>
            <div class="link">Already registered? <a href="./login.php">login</a></div>
        </section>
    </div>

    <script src="./js/register.js"></script>
</body>
</html>