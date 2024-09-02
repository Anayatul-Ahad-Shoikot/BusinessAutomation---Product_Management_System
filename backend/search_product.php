<?php
    include_once "./db_connect.php";

    $query = isset($_GET['query']) ? trim($_GET['query']) : '';

    if (!empty($query)) {
        $sql = "SELECT * FROM products WHERE product_name LIKE :query ORDER BY product_created DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':query' => "%$query%"]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($products);
    } else {
        echo json_encode([]);
    }
?>
