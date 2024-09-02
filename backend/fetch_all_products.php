<?php
    include_once "./db_connect.php";

    $sql = "SELECT w.warehouse_name, 
                    p.product_name, 
                    p.product_price, 
                    p.product_type, 
                    p.product_ammount, 
                    p.product_image
                FROM products AS p
                LEFT JOIN warehouse AS w 
                ON p.warehouse_code = w.warehouse_code
                ORDER BY p.product_created DESC;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($products);
?>
