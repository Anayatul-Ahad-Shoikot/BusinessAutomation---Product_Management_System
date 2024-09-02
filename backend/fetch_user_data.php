<?php
    $user_id = $_SESSION['user_id'];
    try {
        $sql = "SELECT users.*, warehouse.*
                FROM users
                JOIN warehouse ON users.user_code = warehouse.user_code
                WHERE users.user_code = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $user_fname = $row['fname'];
            $user_lname = $row['lname'];
            $user_code = $row['user_code'];
            $warehouse_code = $row['warehouse_code'];
            $warehouse_name = $row['warehouse_name'];
            $warehouse_image = $row['warehouse_image'];
            $warehouse_created = $row['warehouse_created'];
            $warehouse_status = $row['warehouse_status'];
            $_SESSION['warehouse_code'] = $row['warehouse_code'];
        } else {
            echo "No record found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $pdo = null;
?>