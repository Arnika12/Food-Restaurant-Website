<?php
    include '../components/connect.php'; 
    
    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:admin_login.php');
        exit(); // Add exit after header redirect
    }

    // delete reviews
    if(isset($_POST['delete_review'])){ // Changed condition to isset
        $delete_id = $_POST['delete_id']; // Removed unnecessary filtering
        
        $verify_delete = $conn->prepare("SELECT * FROM reviews WHERE id=?");
        $verify_delete->execute([$delete_id]);

        if ($verify_delete->rowCount() > 0) {
            $delete_message = $conn->prepare("DELETE FROM reviews WHERE id=?");
            $delete_message->execute([$delete_id]);
            $success_msg[] = 'Review deleted successfully';
        } else {
            $warning_msg[] = 'Review already deleted';
        }
    }
?>

<style type="text/css">
    <?php  include 'admin_style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <title>Admin - user's reviews Page</title>
</head>
<body>
    <div class="main-container">
        <?php  include '../components/admin_header.php'; ?>
        <section class="reviews-container">
            <h1 class="heading"> user's reviews </h1>
            <div class="box-container">
            <?php 
                    $select_reviews = $conn->prepare("SELECT * FROM reviews");
                    $select_reviews->execute();
                    if ($select_reviews->rowCount() > 0) {
                        while($fetch_reviews = $select_reviews->fetch(PDO::FETCH_ASSOC)){ // Removed semicolon

                ?>
                <div class="box">
                <?php 
                    $select_user = $conn->prepare("SELECT * FROM users WHERE id=?");
                    $select_user->execute([$fetch_reviews['user_id']]);
                        while($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)){ // Removed semicolon
                ?>
                <div class="user">
                    <?php if($fetch_user['profile'] != ''){ ?>
                        <img src="../uploaded_img/<?= $fetch_user['profile']; ?>">
                    <?php }else{ ?>
                        <h3><?= substr($fetch_user['name'], 0,1) ?></h3>
                    <?php } ?>
                    <div>
                        <p><?= $fetch_user['name']; ?></p>
                        <span><?= $fetch_reviews['date']; ?></span>
                    </div>
                </div>
                <?php } ?>
                <div class="ratings">
                    <?php if($fetch_reviews['rating'] == 1){ ?>
                        <p style="background: red;"><i class="bx bxs-star"></i><span><?= $fetch_reviews['rating']; ?></span></p>
                    <?php } ?>
                    <!-- Rest of the ratings checks -->
                </div>
                <h3 class="title"><?= $fetch_reviews['title']; ?></h3>
                <?php 
                    if($fetch_reviews['description'] != ''){ 
                    
                ?>
                <p class="description"><?= $fetch_reviews['description']; ?></p>
                <?php } ?>
                <form action="" method="post">
                    <input type="hidden" name="delete_id" value="<?= $fetch_reviews['id']; ?> ">
                    <input type="submit" name="delete_review" value="Delete Review" class="btn" onclick="return confirm('Delete this review?');">
                </form>
                </div>
                <?php
                     }
                    }else{
                        echo '
                        <div class="empty">
                            <p> No reviews yet! </p>
                        </div>
                        ';
                    }
                ?>
            </div>
        </section>
    </div>

    <?php include '../components/dark.php'; ?>
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- custom js link -->
    <script type="text/javascript" src="script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
