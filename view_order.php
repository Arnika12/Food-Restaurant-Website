<?php
    include 'components/connect.php'; 
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }

    if(isset($_GET['get_id'])){
        $get_id = $_GET['get_id'];
    }else{
        $get_id = '';
        header("location:order.php");
    }

    if(isset($_POST['cancel'])){
        $update_order = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
        $update_order->execute(['canceled',$get_id]);
        header("location:order.php");
    }
?>

<style type="text/css">
    <?php include 'style.css';
    ?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
        integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="style.css" type="text/css"> -->
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <title>Crave Harbour - view order Page</title>
</head>

<body>
    <?php include 'components/user_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>view order </h1>
            <a href="home.php">Home</a> <span> <i class="bx bx-right-arrow-alt"></i> view order </span>
        </div>
    </div>

    <div class="order-detail">
        <div class="title">
            <h1>My Order detail</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus veniam tenetur
            </p>
        </div>

        <div class="box-container">
            <?php
    $grand_total = 0;
    $select_order = $conn->prepare("SELECT * FROM orders WHERE id=? LIMIT 1");
    $select_order->execute([$get_id]);
    if ($select_order->rowCount() > 0) {
        while ($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)) {
            $select_product = $conn->prepare("SELECT * FROM products WHERE id=? LIMIT 1");
            $select_product->execute([$fetch_order['product_id']]);
            if ($select_product->rowCount() > 0) {
                while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                    $sub_total = $fetch_order['price'] * $fetch_order['qty'];
                    $grand_total += $sub_total;
    ?>

            <div class="box">
                <div class="col">
                    <p class="title"><i class="bx bxs-calendar-alt"></i>
                        <?= $fetch_order['date']; ?>
                    </p>
                    <img src="uploaded_img/<?= $fetch_product['image']; ?>" class="image">
                    <p class="price">
                        <?= $fetch_product['price']; ?> x
                        <?= $fetch_order['qty']; ?>
                    </p>
                    <h3 class="name">
                        <?= $fetch_product['name']; ?>
                    </h3>
                    <p class="grand-total">Total Amount Payable: <span>$
                            <?= $grand_total; ?>/-
                        </span></p>
                </div>
                <div class="col">
                    <p class="title">Billing Address</p>
                    <p class="user"><i class="bi bi-person-bounding-box"></i>
                        <?= $fetch_order['name']; ?>
                    </p>
                    <p class="user"><i class="bi bi-phone"></i>
                        <?= $fetch_order['number']; ?>
                    </p>
                    <p class="user"><i class="bi bi-envelope"></i>
                        <?= $fetch_order['email']; ?>
                    </p>
                    <p class="user"><i class="bi bi-pin-map-fill"></i>
                        <?= $fetch_order['address']; ?>
                    </p>
                    <p class="title">Status</p>
                    <p class="status"
                        style="color: <?php if($fetch_order['status'] == 'delivered') {echo 'green';} elseif($fetch_order['status'] == 'canceled') {echo 'red';} else {echo 'orange';} ?>">
                        <?= $fetch_order['status']; ?>
                    </p>

                    <?php if ($fetch_order['status'] == 'canceled') { ?>

                    <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">Order Again</a>

                    <?php } else { ?>
                    <form action="" method="post">
                        <button type="submit" name="cancel" class="btn"
                            onclick="return confirm('Do you want to cancel this order?')">Cancel</button>
                    </form>
                    <?php } ?>
                </div>
            </div>

            <?php
                }
            }
        }
    }else{
        echo '<p class="empty">no order takes placed yet ! </p>';
    }
    ?>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/dark.php'; ?>
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- custom js link -->
    <script type="text/javascript" src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>

</html>