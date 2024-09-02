<?php
    include_once "./db_connect.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $product_code = $_GET['product_code'] ?? '';
        echo $product_code;
        if (!empty($product_code)) {
            try {
                $check_sql = "SELECT COUNT(*) FROM products WHERE product_code = :product_code";
                $check_stmt = $pdo->prepare($check_sql);
                $check_stmt->bindParam(':product_code', $product_code, PDO::PARAM_STR);
                $check_stmt->execute();
                
                if ($check_stmt->fetchColumn() > 0) {
                    $delete_sql = "DELETE FROM products WHERE product_code = :product_code";
                    $delete_stmt = $pdo->prepare($delete_sql);
                    $delete_stmt->bindParam(':product_code', $product_code, PDO::PARAM_STR);
                    
                    if ($delete_stmt->execute()) {
                        echo "Product removed successfully.";
                        header("Location: ../frontend/user_dash.php");

                    } else {
                        echo "Failed to remove product.";
                        header("Location: ../frontend/user_dash.php");
                    }
                } else {
                    echo "Product not found.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Invalid product code or warehouse code.";
        }
    } else {
        echo "Invalid request method.";
    }
?>
