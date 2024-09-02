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
    <title>PMS Marketplace</title>
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
                <li><a href="#">Market Place</a></li>
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
            </form>
            <div class="buttons">
                <a id="add-product-btn" style="background-color: grey; cursor:default;">Add Product</a>
                <img src="../assets/warehouse_image/<?php echo $warehouse_image ?>" width="40px" height="40px"/>
            </div>
            
        </div>
        <div class="items">

        </div>
    </div>



    <script src="./js/marketplace.js"></script>

</body>
</html>