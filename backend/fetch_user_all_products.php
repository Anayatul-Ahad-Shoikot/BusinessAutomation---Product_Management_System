<?php
    session_start();
    if (!isset($_SESSION['warehouse_code'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Warehouse code not set in session']);
        exit;
    }
    $warehouse_code = $_SESSION['warehouse_code'];
    echo json_encode($warehouse_code);
?>
