<?php
    session_start();
    include_once "./db_connect.php";

    $response = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        if (empty($email) || empty($password)) {
            $response = 'All fields are required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response = 'Invalid email format.';
        } else {
            try {
                $stmt = $pdo->prepare("SELECT email, password, user_code FROM users WHERE email = :email LIMIT 1");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['user_code'];
                    $response = 'success';
                } else {
                    $response = 'Invalid email or password.';
                }
            } catch (PDOException $e) {
                $response = 'Database error: ' . $e->getMessage();
            }
        }
    } else {
        $response = 'Invalid request method.';
    }

    echo $response;
?>
