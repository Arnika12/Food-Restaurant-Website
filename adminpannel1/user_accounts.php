<?php
    include '../components/connect.php'; 
    
    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:admin_login.php');
    }

    // delete message
    if(isset($_POST['delete_msg'])){ // Corrected the condition here
        $delete_id = $_POST['delete_id']; // Removed unnecessary filtering

        // Delete message from the database
        $delete_message = $conn->prepare("DELETE FROM message WHERE id=?");
        $delete_message->execute([$delete_id]);

        if ($delete_message->rowCount() > 0) {
            $success_msg[] = 'Message deleted successfully';
        } else {
            $warning_msg[] = 'Message already deleted';
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
    <title>Admin - Registered Users Page</title>
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="accounts">
            <h1 class="heading">Registered Users</h1>
            <div class="box-container">
                <?php
                    $select_users = $conn->prepare("SELECT * FROM users");
                    $select_users->execute();
                    if($select_users->rowCount() > 0){
                        while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
                            $user_id = $fetch_users['id'];
                    
                ?>
                <div class="box">
                    <img src="../uploaded_img/<?= $fetch_users['profile']; ?>" >
                    <p>User id: <span><?= $user_id ?></span></p>
                    <p>User name : <span><?= $fetch_users['name']; ?></span></p>
                    <p>User email : <span><?= $fetch_users['email']; ?></span></p>

                </div>
                <?php
                     }
                    }else{
                        echo '
                        <div class="empty">
                            <p> No user registered yet! </p>
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
