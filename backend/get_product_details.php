<?php
    include_once "./db_connect.php";

    if (isset($_GET['product_code'])) {
        $product_code = $_GET['product_code'];

        $sql = "SELECT * FROM products WHERE product_code = :product_code";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':product_code', $product_code, PDO::PARAM_STR);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode($product);
    } else {
        echo json_encode([]);
    }
?>