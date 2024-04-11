<?php
    include 'components/connect.php'; 
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }

    if (isset($_GET['get_id'])) {
        $get_id = $_GET['get_id'];
    } else {
        $get_id='';
        header('location:order.php');
    }
        if (isset($_POST['add_review'])) {
            if ($user_id != "") {
                $id = unique_id();
                $title = $_POST['title'];
                $title = filter_var($title, FILTER_SANITIZE_STRING);

                $description = $_POST['description'];
                $description = filter_var($description, FILTER_SANITIZE_STRING);

                $ratings = $_POST['ratings'];
                $ratings = filter_var($ratings, FILTER_SANITIZE_STRING);
    
                $verify_rating = $conn->prepare("SELECT * FROM reviews WHERE post_id = ? AND user_id = ?");
                $verify_rating->execute([$get_id, $user_id]);
    
                if($verify_rating->rowCount()>0){
                    $warning_msg[]='your review is already added';
                }else{
                    $add_review = $conn->prepare("INSERT INTO reviews (id, post_id, user_id, rating, title, description) VALUES (?, ?, ?, ?, ?, ?)");
                    $add_review->execute([$id, $get_id, $user_id, $ratings, $title, $description]);
                    $success_msg[] = 'Review added';

                }
            }else{
                $warning_msg[]='please login first';
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
    <title>Crave Harbour - add review Page</title>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
   
    <div class="banner">
        <div class="detail">
            <h1>add review </h1>
            <a href="home.php">Home</a> <span> <i class="bx bx-right-arrow-alt"></i> add review </span>
        </div>
    </div>

    <div class="review">
    <div class="title">
        <h1>post your review</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus veniam tenetur</p>
    </div>
   <div class="form-container">
   <form action="" method="post">
    <div class="input-field">
        <label>Review Title <sup>*</sup></label>
        <input type="text" name="title" required maxlength="50" placeholder="Enter Review Title">
    </div>
    <div class="input-field">
        <label>Review Description <sup>*</sup></label>
        <textarea name="description" placeholder="Enter Review Description" maxlength="100" cols="30" rows="10"></textarea>
    </div>
    <div class="input-field">
        <label>Give Ratings <sup>*</sup></label>
        <select name="ratings" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <div class="flx-btn">
    <input type="submit" name="add_review" value="Post your Review" class="btn">
    <a href="order.php?get_id<?= $get_id; ?>" class="btn" style="padding:1rem 20%;">Go back</a>
    </div>
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