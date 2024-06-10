<?php
    include 'components/connect.php'; 
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }


// Send message
if (isset($_POST['send_message'])) {
    if ($user_id != '') {
        $id = uniqid();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $subject = $_POST['subject'];
        $subject = filter_var($subject, FILTER_SANITIZE_STRING);

        $message = $_POST['message'];
        $message = filter_var($message, FILTER_SANITIZE_STRING);

	$verify_message = $conn->prepare("SELECT * FROM message WHERE user_id = ? AND name = ? AND email = ? AND subject = ? AND message = ?");
$verify_message->execute([$user_id, $name, $email, $subject, $message]);

if ($verify_message->rowCount() > 0) {
    $warning_msg[] = 'Message already exists';
} else {
    $insert_message = $conn->prepare("INSERT INTO message (id, user_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?, ?)");
    $insert_message->execute([$id, $user_id, $name, $email, $subject, $message]);
    $success_msg[] = 'Comment inserted successfully';
}

    } else {
        $warning_msg[] = 'Please login first';
    }
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
    <title>Crave Harbour - contact us Page</title>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
   
    <section style="padding: 1%; background-color: #f0f0f0;">
        <div class="banner" style="background-color: #ffffff; border-radius: 5px; padding: 2%; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin-top: 0; min-height: 30vh;">
            <div class="detail" style="text-align: center;">
                <a href="home.php" style="text-decoration: none; color: #333333; font-size:20px;"><i class="bx bx-left-arrow-alt"></i> Back to Home </a>
            </div><br>
            <h1 style="color: #ff004f; margin-top: 2%; text-align: center; font-size:50px;">Contact Us </h1>
        </div>
    </section>

	<div class="contact">
    <div class="form-container">
        <form action="" method="post">
            <div class="title">
                <h1>!!  SEND US YOUR QUERY !!</h1>
            </div>
            <div class="input-field">
                <label>name <sup>*</sup></label>
                <input type="text" name="name" required placeholder="Enter Your Name">
            </div>
            <div class="input-field">
                <label>email <sup>*</sup></label>
                <input type="email" name="email" required placeholder="Enter Your Email">
            </div>
            <div class="input-field">
                <label>subject <sup>*</sup></label>
                <input type="text" name="subject" required placeholder="Enter Subject">
            </div>
            <div class="input-field">
                <label>comment <sup>*</sup></label>
                <textarea name="message" cols="30" rows="8" required placeholder="Add any comment you think is necessary"></textarea>
            </div>
            <input type="submit" name="send_message" value="Send message" class="btn">
        </form>
    </div>
</div>


<div class="address">
    <div class="title">
        <h1>Our Contact</h1>
    </div>
    <div class="box-container">
        <div class="box">
            <i class="bx bxs-map-alt"></i>
            <div>
                <h4>Address</h4>
                <p>2436, General Thimayya Road,<br> East St, Camp,<br>Pune, Maharashtra 411001</p>
            </div>
        </div>
        <div class="box">
            <i class="bx bxs-phone-incoming"></i>
            <div>
                <h4>Phone Number</h4>
                <p><a href="tel:+91 9088333169">+91 9088333169</a></p>
            </div>
        </div>
<div class="box">
            <i class="bx bxs-envelope"></i>
            <div>
                <h4>email</h4>
                <p><a href="mailto:craveharbour@gmail.com">craveharbour@gmail.com</a></p>
            </div>
        </div>
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