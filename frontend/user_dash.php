<?php
    session_start();
    if (isset($_SESSION['user_id'])){
        include "../backend/db_connect.php";
        include_once "../backend/fetch_user_data.php";
    } else {
        header("Location: ./login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMS Dash</title>
    <link rel="stylesheet" href="../css/basic.css">
    <link rel="stylesheet" href="../css/dash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>
    <div class="sidebar">
        <div class="upper-part">
            <div class="logo">
                <img src="../assets/website_logo_image/warehouse.png" alt="Logo">
                <div class="name">
                    <span>Prouduct</span>
                    <span>Management</span>
                    <span>System</span>
                </div>
            </div>
            <ul>
                <li><a href="./market_place.php">Market Place</a></li>
                <li><a href="./user_dash.php">My Dash</a></li>
            </ul>
        </div>
        <div class="bottom-part">
            <p><?php echo $user_fname.$user_lname ?></p>
            <a href="../backend/logout.php">Logout</a>
        </div>
    </div>
    <div class="item-container">
        <div class="nav">
            <form action="#" method="GET">
                <input type="text" name="query" placeholder="Search items...">
                <button type="submit"><i class="ri-search-line"></i></button>
                <a href="./user_dash.php">Reload</a>
            </form>
            <div class="buttons">
                <a href="javascript:void(0);" id="add-product-btn">Add product</a>
                <img src="../assets/warehouse_image/<?php echo $warehouse_image ?>" width="40px" height="40px"/>
            </div>
            
        </div>
        <div class="items">
        <?php
    include "../backend/db_connect.php";
    $warehouse_code = $_SESSION['warehouse_code'];

    $search_query = isset($_GET['query']) ? trim($_GET['query']) : '';

    if (isset($_GET['query']) && !empty($search_query)) {
        $sql = "SELECT * FROM products 
                WHERE warehouse_code = :warehouse_code 
                AND (product_name LIKE :query 
                OR product_type LIKE :query) 
                ORDER BY product_created DESC";

        $stmt = $pdo->prepare($sql);
        $queryParam = "%{$search_query}%";
        $stmt->bindParam(':warehouse_code', $warehouse_code, PDO::PARAM_STR);
        $stmt->bindParam(':query', $queryParam, PDO::PARAM_STR);
    } else {
        $sql = "SELECT * FROM products WHERE warehouse_code = :warehouse_code ORDER BY product_created DESC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':warehouse_code', $warehouse_code, PDO::PARAM_STR);
    }

    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($products) {
        foreach ($products as $product) {
            echo "<div class='product-item'>";
            echo "<img src='../assets/product_image/" . htmlspecialchars($product['product_image']) . "' alt='" . htmlspecialchars($product['product_name']) . "' />";
            echo "<div class='tag'>
                <h3>" . htmlspecialchars($product['product_name']) . "</h3>
                <h2>$" . number_format($product['product_price'], 2) . "</h2>
                </div>";
            echo "<div class='tag'>
                <p>" . htmlspecialchars($product['product_type']) . "</p>
                <p>unit: " . htmlspecialchars($product['product_ammount']) . "</p>
                </div>";
            echo "<div class='actions'>
                    <a href='#' class='btn-update' data-product-code='" . htmlspecialchars($product['product_code']) . "'>Update</a>
                    <a href='../backend/remove_product.php?product_code=" . htmlspecialchars($product['product_code']) . "' class='btn-remove'>Remove</a>
                </div>";
            echo "</div>";
        }
    } else {
        echo "<p>No products found for this warehouse.</p>";
    }
?>

        </div>
    </div>

    <div id="floating-update-form" class="floating-form" style="display:none;">
        <div class="form-content">
            <span class="close-btn" id="close-btnn">&times;</span>
            <h2>Update Product</h2>
            <form id="update-product-form" action="../backend/update_product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="product_code" id="product_code">
                <div class="field input">
                    <input type="text" name="product_name" id="product_name" placeholder="Product Name..">
                </div> 
                <div class="field input"> 
                    <input type="number" name="product_price" id="product_price" step="0.01" placeholder="Enter price">
                </div> 
                <div class="field input"> 
                    <input type="text" name="product_type" id="product_type" placeholder="Product type">
                </div> 
                <div class="field input"> 
                    <input type="number" name="product_ammount" id="product_ammount" placeholder="Product amount">
                </div> 
                    
                <fieldset>
                    <legend>Product Image</legend>
                    <input type="file" id="image" name="product_image" accept="image/*">
                </fieldset>
                <input type="hidden" name="warehouse_code" value="<?php echo $_SESSION['warehouse_code']; ?>">
                <div class="field button">
                    <input type="submit" name="update_product" value="Update">
                </div>
            </form>
        </div>
    </div>

    <div id="floating-form" class="floating-form" style="display:none;">
        <div class="form-content">
            <span class="close-btn" id="close-btn">&times;</span>
            <h2>Add Product</h2>
            <form action="../backend/add_product.php" method="POST" enctype="multipart/form-data">
                <div class="field input">
                    <input type="text" name="product_name" placeholder="Product Name.." required>
                </div> 
                <div class="field input"> 
                    <input type="number" name="product_price" step="0.01" placeholder="Enter price" required>
                </div> 
                <div class="field input"> 
                    <input type="text" name="product_type" placeholder="Product type" required>
                </div> 
                <div class="field input"> 
                    <input type="number" name="product_ammount" placeholder="Product ammount" required>
                </div> 
                    
                <fieldset>
                    <legend>Product Image</legend>
                    <input type="file" id="image" name="product_image" accept="image/*" required >
                </fieldset>
                <input type="text" name="warehouse_code" value="<?php echo $_SESSION['warehouse_code'] ?>" hidden >
                <div class="field button">
                    <input type="submit" name="add_product" value="Done">
                </div>
            </form>
        </div>
    </div>


    <script src="./js/update-product.js"></script>
    <script src="./js/add_itemForm.js"></script>
    <script src="./js/remove-item.js"></script>
</body>
</html>