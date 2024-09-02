<?php
    include_once "db_connect.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_code = $_POST['product_code'];
        $warehouse_code = $_POST['warehouse_code'];
        $set_clause = [];
        $params = [];

        if (!empty($_POST['product_name'])) {
            $set_clause[] = "product_name = :product_name";
            $params[':product_name'] = $_POST['product_name'];
        }
        if (!empty($_POST['product_price'])) {
            $set_clause[] = "product_price = :product_price";
            $params[':product_price'] = $_POST['product_price'];
        }
        if (!empty($_POST['product_type'])) {
            $set_clause[] = "product_type = :product_type";
            $params[':product_type'] = $_POST['product_type'];
        }
        if (!empty($_POST['product_ammount'])) {
            $set_clause[] = "product_ammount = :product_ammount";
            $params[':product_ammount'] = $_POST['product_ammount'];
        }
        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['product_image']['tmp_name'];
            $file_name = basename($_FILES['product_image']['name']);
            $file_dest = "../assets/product_image/" . $file_name;

            if (move_uploaded_file($file_tmp, $file_dest)) {
                $params[':product_image'] = $file_name;
                $set_clause[] = "product_image = :product_image";
            } else {
                echo "Failed to upload image.";
                exit;
            }
        }

        if (empty($set_clause)) {
            echo "No fields to update.";
            exit;
        }

        $set_clause_string = implode(", ", $set_clause);
        $sql = "UPDATE products 
                SET $set_clause_string 
                WHERE product_code = :product_code AND warehouse_code = :warehouse_code";
        
        $stmt = $pdo->prepare($sql);
        
        $params[':product_code'] = $product_code;
        $params[':warehouse_code'] = $warehouse_code;
        
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        
        if ($stmt->execute()) {
            header("Location: ../frontend/user_dash.php");
        } else {
            header("Location: ../frontend/user_dash.php");
            echo "Failed to update product.";
        }
    } else {
        echo "Invalid request method.";
    }
?>
