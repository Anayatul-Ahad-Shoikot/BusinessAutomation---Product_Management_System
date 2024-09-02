<?php
include_once "./db_connect.php";
session_start();

$response = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $warehouse_name = trim($_POST['warehouse']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($fname) || empty($lname) || empty($warehouse_name) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        $response = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = 'Invalid email format.';
    } elseif (!preg_match('/^0\d{10}$/', $phone)) {
        $response = 'Phone number must be 11 digits long and start with 0.';
    } elseif ($password !== $confirm_password) {
        $response = 'Passwords do not match.';
    } else {
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE (email = :email OR phone = :phone) OR (fname = :fname AND lname = :lname)");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
            $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->fetchColumn() > 0) {
                $response = 'Email, phone number, or full name already exists.';
            } else {
                $user_code = sprintf('%08d', mt_rand(0, 99999999));
                
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                $pdo->beginTransaction();

                $stmt = $pdo->prepare("INSERT INTO users (user_code, fname, lname, email, phone, password) VALUES (:user_code, :fname, :lname, :email, :phone, :password)");
                $stmt->bindParam(':user_code', $user_code, PDO::PARAM_STR);
                $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
                $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
                $stmt->execute();

                $image = $_FILES['image'];
                $image_path = '';
                if ($image['error'] === UPLOAD_ERR_OK) {
                    $image_name = basename($image['name']);
                    $image_path = '../assets/warehouse_image/' . $image_name;
                    move_uploaded_file($image['tmp_name'], $image_path);
                }
                $warehouse_code = sprintf('%06d', mt_rand(0, 999999));

                $stmt = $pdo->prepare("INSERT INTO warehouse (warehouse_code, user_code, warehouse_name, warehouse_image) VALUES (:warehouse_code, :user_code, :warehouse_name, :warehouse_image)");
                $stmt->bindParam(':warehouse_code', $warehouse_code, PDO::PARAM_STR);
                $stmt->bindParam(':user_code', $user_code, PDO::PARAM_STR);
                $stmt->bindParam(':warehouse_name', $warehouse_name, PDO::PARAM_STR);
                $stmt->bindParam(':warehouse_image', $image_name, PDO::PARAM_STR);
                $stmt->execute();

                $pdo->commit();

                $response = 'success';
                $_SESSION['success_msg'] = 'Registration successful!';
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            $response = 'Database error: ' . $e->getMessage();
        }
    }
} else {
    $response = 'Invalid request method.';
}

echo $response;
?>
