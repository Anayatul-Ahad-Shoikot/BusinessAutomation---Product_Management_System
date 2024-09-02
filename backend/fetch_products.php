<?php
    include_once "../backend/db_connect.php";

    if ($pdo === null) {
        die("PDO is not set. Check your database connection.");
    }
    

    if (isset($_SESSION['warehouse_code'])) {
        $warehouse_code = $_SESSION['warehouse_code'];
    
        $sql = "SELECT * FROM products WHERE warehouse_code = :warehouse_code ORDER BY product_created DESC";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':warehouse_code', $warehouse_code, PDO::PARAM_STR);
        
        $stmt->execute();
        
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($products) {
            foreach ($products as $product) {
                echo "<div class='product-item'>";
                echo "<h3>" . htmlspecialchars($product['product_name']) . "</h3>";
                echo "<p>Price: $" . number_format($product['product_price'], 2) . "</p>";
                echo "<p>Type: " . htmlspecialchars($product['product_type']) . "</p>";
                echo "<p>Amount: " . htmlspecialchars($product['product_ammount']) . "</p>";
                echo "<img src='../uploads/" . htmlspecialchars($product['product_image']) . "' alt='" . htmlspecialchars($product['product_name']) . "' />";
                echo "</div>";
            }
        } else {
            echo "<p>No products found for this warehouse.</p>";
        }
    } else {
        echo "<p>Warehouse code not found in session.</p>";
    }
?>