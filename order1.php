<?php
    include 'components/connect.php'; 
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }
?>

<style type="text/css">
    <?php  include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="style.css" type="text/css"> -->
    <link rel="icon" href="../uploaded_img/icon.png" type="image">
    <title>Crave Harbour - my order Page</title>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
   
    <div class="banner">
        <div class="detail">
            <h1>my order </h1>
            <a href="home.php">Home</a> <span> <i class="bx bx-right-arrow-alt"></i> my order </span>
        </div>
    </div>

    <div class="orders">
    <div class="title">
        <h1>My Orders</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus veniam tenetur</p>
    </div>
    <div class="box-container">
        <?php
        $select_orders = $conn->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY date DESC");
        $select_orders->execute([$user_id]);

        if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                $product_id = $fetch_orders['product_id'];
                $select_products = $conn->prepare("SELECT * FROM products WHERE id=?");
                        $select_products->execute([$fetch_orders['product_id']]);
                        if ($select_products->rowCount() > 0) {
                            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <div class="box" <?php if ($fetch_orders['status'] == 'canceled') {echo 'style="border: 2px solid red;"';} ?>>
                    <a href="view_order.php?get_id=<?= $fetch_orders['id']; ?>">
                                <p class="date"><i class='bx bxs-calendar-alt'></i><span><?= $fetch_orders['date']; ?></span></p>
                                <img src="uploaded_img/<?= $fetch_products['image']; ?>" class="image">
                    <div class="row">
                        <h3 class="name"><?= $fetch_products['name']; ?></h3>
                        <p class="price">Price $<?= $fetch_products['price']; ?>/-</p>
                    <p class="status" style="color: <?php if ($fetch_orders['status'] == 'delivered') {echo "green";} elseif ($fetch_orders['status'] == 'canceled') {echo "red";} else {echo "orange";} ?>"><?= $fetch_orders['status']; ?></p>
                            </div>
                            </a>
                        <a href="add_review.php?get_id=<?= $product_id; ?>" class="btn">Add Review</a>
                    </div>
            <?php
            }
        }
        } else {
            echo '<p class="empty">No orders placed yet!</p>';
        }
    }
        ?>
    </div>
</div>

    

    <?php include 'components/footer.php'; ?>

    <?php include 'components/dark.php'; ?>
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- custom js link -->
    <script type="text/javascript" src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>