<?php
    include 'components/connect.php'; 
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }

    //booking table
   if (isset($_POST['book_table'])) {
      if (isset($user_id) && $user_id != '') {
        $id = uniqid();
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
        $person = filter_var($_POST['person'], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
        $time = filter_var($_POST['time'], FILTER_SANITIZE_STRING);
        $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

        $reserve_table = $conn->prepare("INSERT INTO reservation (id, user_id, name, email, number, person, date, time, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $reserve_table->execute([$id, $user_id, $name, $email, $number, $person, $date, $time, $comment]);

        if ($reserve_table) {
            $success_msg[] = 'Table booked';
        } else {
            $warning_msg[] = 'Something went wrong';
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
    <title>Crave Harbour - Reservation Page</title>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
   
    <section style="
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(image/reservetable/1.jpg);
            background-position: center bottom;
            background-repeat: no-repeat;
            background-size: cover;
    ">
        <div class="banner">
    <div class="detail">
        <a href="home.php" style="color: white; text-decoration: none;"><i class="bx bx-left-arrow-alt"></i> Back to Home</a>
    </div>
    <h1 style="text-align: center; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">Reserve your table</h1>
</div>

        
    </section>

    <div class="reservation-container">
        <div class="form-container">
            <form action="" method="post">
		<div class="title">
                	<h1>Book A Table</h1>
                	<p style="text-align:center;color:grey;">Just A Few Clicks To Make The Reservation Online And Save Your Time And Money</p>
		</div>
                <div class="input-field">
                    <label>Name <sup>*</sup></label>
                    <input type="text" name="name" required placeholder="Enter Your Name">
                </div>
                
                <div class="input-field">
                    <label>email <sup>*</sup></label>
                    <input type="text" name="email" required placeholder="Enter Your email">
                </div>

                <div class="input-field">
                    <label>Phone Number <sup>*</sup></label>
                    <input type="text" name="number" required placeholder="Enter Your Phone Number">
                </div>

                <div class="input-field">
                    <label>number of person <sup>*</sup></label>
                    <input type="number" name="person" required placeholder="Enter number of person">
                </div>

                <div class="input-field">
                    <label>Date <sup>*</sup></label>
                    <input type="date" name="date" required placeholder="select a date">
                </div>
                <div class="input-field">
                    <label>time <sup>*</sup></label>
                    <select name="time">
                        <option selected disabled>-----select your time -----</option>
                        <option value="7 AM">7 AM </option>
                        <option value="8 AM">8 AM </option>
                        <option value="9 AM">9 AM </option>
                        <option value="10 AM">10 AM </option>
                    </select>
                </div>

                <div class="input-field">
                    <label>comment <sup>*</sup></label>
                    <textarea name="comment" cols=30 rows=10 required placeholder="Add any comment you think necessary"></textarea>
                </div>
                <input type="submit" name="book_table" value="book table" class="btn">
            </form>
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