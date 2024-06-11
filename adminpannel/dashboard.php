<?php
    include '../components/connect.php';
    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:admin_login.php');
        exit;
    }

    $select_profile = $conn->prepare("SELECT * FROM admin WHERE id = ?");
    $select_profile->execute([$admin_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>

<style type="text/css">
    <?php  include 'admin_style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../uploaded_img/icon.png" type="image">
    <title>crave harbour Admin - Dashboard</title>
</head>
<body>
    <?php include '../components/dark.php'; ?>
    <div class="main-container">
        <?php  include '../components/admin_header.php'; ?>
        <section>
            <h1 class="heading">Dashboard</h1>
            <div class="box-container">
                <div class="box">
                    <h3>Welcome !</h3>
                    <p><?= $fetch_profile['name']; ?></p>
                    <a href="update_profile.php" class="btn">Update Profile</a>
                </div>
                
                <div class="box">
                    <?php
                        $select_message = $conn->prepare("SELECT * FROM message");
                        $select_message->execute();
                        $number_of_msg = $select_message->rowCount();
                    ?>
                    <h3><?= $number_of_msg; ?></h3>
                    <p>Unread messages</p>
                    <a href="admin_message.php" class="btn">See messages</a>
                </div>
                <div class="box">
                    <?php
                        $select_post = $conn->prepare("SELECT * FROM products");
                        $select_post->execute();
                        $number_of_post = $select_post->rowCount();
                    ?> 
                    <h3><?= $number_of_post; ?></h3>
                    <p>Products Added</p>
                    <a href="add_posts.php" class="btn">Add new products</a>
                </div>

                <div class="box">
                    <?php
                        $select_active_post = $conn->prepare("SELECT * FROM products WHERE status=?");
                        $select_active_post->execute(['active']);
                        $number_of_active_post = $select_active_post->rowCount();
                    ?> 
                    <h3><?= $number_of_active_post; ?></h3>
                    <p>Total Active Products</p>
                    <a href="view_posts.php" class="btn">See Active products</a>
                </div>

                <div class="box">
                    <?php
                        $select_deactive_post = $conn->prepare("SELECT * FROM products WHERE status=?");
                        $select_deactive_post->execute(['deactive']);
                        $number_of_deactive_post = $select_deactive_post->rowCount();
                    ?> 
                    <h3><?= $number_of_deactive_post; ?></h3>
                    <p>Total deactive Products</p>
                    <a href="view_posts.php" class="btn">See Deactive products</a>
                </div>

                <!-- <div class="box">
                    <h3>Generate Report</h3>
                    <p>See Product Analytics</p>
                    <a href="generate_report.php" class="btn">Check report</a>
                </div> -->
                
                <div class="box">
                    <?php
                        $select_users = $conn->prepare("SELECT * FROM users");
                        $select_users->execute();
                        $number_of_users = $select_users->rowCount();
                    ?>
                    <h3><?= $number_of_users; ?></h3>
                    <p>User Accounts</p>
                    <a href="user_accounts.php" class="btn">See users</a>
                </div>

                <div class="box">
                    <?php
                        $select_admin = $conn->prepare("SELECT * FROM admin");
                        $select_admin->execute();
                        $number_of_admin = $select_admin->rowCount();
                    ?> 
                    <h3><?= $number_of_admin; ?></h3>
                    <p>Admin Accounts</p>
                    <a href="admin_accounts.php" class="btn">See admin</a>
                </div>

                <div class="box">
                    <?php
                        $select_reservation = $conn->prepare("SELECT * FROM reservation");
                        $select_reservation->execute();
                        $num_of_reservation = $select_reservation->rowCount();
                    ?> 
                    <h3><?= $num_of_reservation; ?></h3>
                    <p>total reservation</p>
                    <a href="admin_reservation.php" class="btn">See reservations</a>
                </div>

                <div class="box">
                    <?php
                        $select_total_order = $conn->prepare("SELECT * FROM orders");
                        $select_total_order->execute();
                        $total_total_order = $select_total_order->rowCount();
                    ?> 
                    <h3><?= $total_total_order; ?></h3>
                    <p>total orders</p>
                    <a href="admin_order.php" class="btn">all orders</a>
                </div>
                
                <div class="box">
                    <?php
                        $select_canceled_order = $conn->prepare("SELECT * FROM orders WHERE order_status=?");
                        $select_canceled_order->execute(['canceled']);
                        $total_canceled_order = $select_canceled_order->rowCount();
                    ?> 
                    <h3><?= $total_canceled_order; ?></h3>
                    <p>total canceled orders</p>
                    <a href="admin_order.php" class="btn">canceled order</a>
                </div>

                <div class="box">
                    <?php
                        $select_confirm_order = $conn->prepare("SELECT * FROM orders WHERE order_status=?");
                        $select_confirm_order->execute(['in progress']);
                        $total_confirm_order = $select_confirm_order->rowCount();
                    ?> 
                    <h3><?= $total_confirm_order; ?></h3>
                    <p>total confirm orders</p>
                    <a href="admin_order.php" class="btn">confirm order</a>
                </div>
                
            </div>
        </section>
    </div>
    
</body>
</html>