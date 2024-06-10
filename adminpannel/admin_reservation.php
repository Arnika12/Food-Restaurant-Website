<?php
    include '../components/connect.php'; 
    
    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:admin_login.php');
        exit(); 
    }

    // Update booking
    if(isset($_POST['update_booking'])){
        $booking_id = $_POST['booking_id'];
        $confirm_booking = $_POST['confirm_booking']; // Removed unnecessary filtering

        $update_booking = $conn->prepare("UPDATE reservation SET confirmation=? WHERE id=?");
        $update_booking->execute([$confirm_booking, $booking_id]);
        $success_msg[] = 'Booking updated!';
    }
    
    // Delete reservation
    if(isset($_POST['delete_booking'])){
        $delete_id = $_POST['booking_id']; 

        $verify_delete = $conn->prepare("SELECT * FROM reservation WHERE id=?");
        $verify_delete->execute([$delete_id]);

        if ($verify_delete->rowCount() > 0) {
            $delete_booking = $conn->prepare("DELETE FROM reservation WHERE id=?");
            $delete_booking->execute([$delete_id]);
            $success_msg[] = 'Reservation deleted successfully';
        } else {
            $warning_msg[] = 'Reservation already deleted';
        }
    }
?>

<style type="text/css">
    <?php  
        include 'admin_style.css'; 
        include 'css/admin_reservation.css';
    ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <title>Admin - Unread Message Page</title>
</head>
<body>
    <div class="main-container">
        <?php  include '../components/admin_header.php'; ?>
        <section class="message-container">
            <h1 class="heading"> User's Reservations </h1>
            <div class="box-container">
                <?php
                    $select_reservation = $conn->prepare("SELECT * FROM reservation");
                    $select_reservation->execute();
                    if ($select_reservation->rowCount() > 0) {
                        while($fetch_reservation = $select_reservation->fetch(PDO::FETCH_ASSOC)){ // Removed semicolon

                ?>
                <div class="box">
                    <p class="name"><?= $fetch_reservation['name']; ?></p>
                    <p><span>User Email: <?= $fetch_reservation['email']; ?></span></p>
                    <p><span>User Number: <?= $fetch_reservation['number']; ?></span></p>
                    <p><span>Total Persons: <?= $fetch_reservation['person']; ?></span></p>
                    <p><span>Date: <?= $fetch_reservation['date']; ?></span></p>
                    <p><span>Time: <?= $fetch_reservation['time']; ?></span></p>
                    <p><span>Comment: <?= $fetch_reservation['comment']; ?></span></p>
            
                    <form action="" method="post">
                        <input type="hidden" name="booking_id" value="<?= $fetch_reservation['id']; ?>">
                        <select name="confirm_booking">
                            <option selected disabled><?= $fetch_reservation['confirmation']; ?></option>
                            <option value="pending">Pending</option>
                            <option value="complete">Complete</option>
                        </select>
                        <div class="flex-btn">
                            <input type="submit" name="update_booking" value="Update Booking" class="btn">
                            <input type="submit" name="delete_booking" value="Delete Booking" class="btn" onclick="return confirm('Delete this booking?');">
                        </div>
                    </form>
                </div>
                <?php
                    }
                    } else {
                        echo '
                        <div class="empty">
                            <p>No reservation yet!</p>
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
