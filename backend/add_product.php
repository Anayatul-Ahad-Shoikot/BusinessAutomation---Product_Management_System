<?php
    include_once "../backend/db_connect.php";

    if (isset($_POST['add_product'])) {

        $product_name = htmlspecialchars($_POST['product_name']);
        $product_price = (float)$_POST['product_price'];
        $product_type = htmlspecialchars($_POST['product_type']);
        $product_ammount = (int)$_POST['product_ammount'];
        $warehouse_code = htmlspecialchars($_POST['warehouse_code']);
        $product_code = sprintf('%08d', mt_rand(0, 9999));

        $product_image = $_FILES['product_image']['name'];
        $target_dir = "../assets/product_image/";
        $target_file = $target_dir . basename($product_image);
        
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['product_image']['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            exit;
        }
    
        if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }

        $product_name_upper = strtoupper($product_name);
        
        $sql_check = "SELECT * FROM products WHERE UPPER(product_name) = :product_name";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->bindParam(':product_name', $product_name_upper);
        $stmt_check->execute();
        
        if ($stmt_check->rowCount() > 0) {
            echo "<script>alert('Product already exists. You can increase the product amount.'); 
                    window.location.href='../frontend/user_dash.php';
                </script>";
        } else {
            $sql_insert = "INSERT INTO products (product_code, warehouse_code, product_name, product_price, product_type, product_ammount, product_image)
                        VALUES (:product_code, :warehouse_code, :product_name, :product_price, :product_type, :product_ammount, :product_image)";
    
            $stmt_insert = $pdo->prepare($sql_insert);
            
            $stmt_insert->bindParam(':product_code', $product_code);
            $stmt_insert->bindParam(':warehouse_code', $warehouse_code);
            $stmt_insert->bindParam(':product_name', $product_name);
            $stmt_insert->bindParam(':product_price', $product_price);
            $stmt_insert->bindParam(':product_type', $product_type);
            $stmt_insert->bindParam(':product_ammount', $product_ammount);
            $stmt_insert->bindParam(':product_image', $product_image);
            
            if ($stmt_insert->execute()) {
                header("Location: ../frontend/user_dash.php");
            } else {
                echo "Error: Could not insert the data.";
            }
        }
    }
?>
