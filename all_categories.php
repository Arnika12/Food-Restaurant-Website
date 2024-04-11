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
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <title>Crave Harbour - All Categories Page</title>

    <style>
        .category {
            padding: 0px;
            text-align: center;
        }

        .banner1 {
            background-image: var(--banner-img);
            width: 100%;
            min-height: 20vh;
            position: relative;
            text-transform: capitalize;
            font-size: 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .banner1 h1{
            color:#d32f2f;
            font-size:60px;
        }
        .banner1 p{
            color:#2b2c3f;
        }
        .box-container {
            margin-top:2%;
            margin-left: 5%;
            margin-right: 5%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3vw;
            justify-items: center;
        }

        .box {
            text-align: center;
            color: var(--lightgray);
            font-size: 25px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: none;
            margin: 20px 0;
        }

        .box .img-box {
            width: 200px; 
            height: 200px; 
            border-radius: 15px; 
            overflow: hidden;
            border: 3px solid #d32f2f; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow for better visual */
            background-color: whitesmoke;
        }

        .box .img-box img {
            width: 100%; 
            height: 100%; 
            object-fit: cover; /* Maintain aspect ratio while covering the box */
            transition: transform 0.5s ease; 
        }

        .box .img-box:hover img {
            transform: scale(1.1); 
        }
    </style>
</head>
<body>
<?php include 'components/user_header.php'; ?>
    
<div class="detail" style="text-align: left; margin-top: 8%;margin-left:2%;">
            <a href="home.php" style="
                text-decoration: none;
                color: #333333;
                font-size:20px;
            "><i class="bx bx-left-arrow-alt"></i> Back to Home </a>
</div>

<div class="category">
    <div class="banner1">
            <h1>All Categories</h1>
            <p>Explore our diverse menu featuring a wide range of mouthwatering dishes !!</p>
    </div>
<br>
    <hr style="border: none;
            height: 3px;
            background-color: #d32f2f;">
    
    <div class="box-container">
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Biryani"><img src="image/allcategory/biryani.jpg" alt="Biryani"></a>
            </div>
            <a href="category.php?category=Biryani">Biryani</a>
        </div>
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Burger"><img src="image/allcategory/burger.jpg" alt="Burger"></a>
            </div>
            <a href="category.php?category=Burger">Burger</a>
        </div>
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Pizza"><img src="image/allcategory/pizza.jpg" alt="Pizza"></a>
            </div>
            <a href="category.php?category=Pizza">Pizza</a>
        </div>
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Salad"><img src="image/allcategory/salad.jpg" alt="Salad"></a>
            </div>
            <a href="category.php?category=Salad">Salad</a>
        </div>
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Cakes"><img src="image/allcategory/cake.webp" alt="Cakes"></a>
            </div>
            <a href="category.php?category=Cakes">Cakes</a>
        </div>
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Pasta"><img src="image/allcategory/pasta.jpg" alt="Pasta"></a>
            </div>
            <a href="category.php?category=Pasta">Pasta</a>
        </div>
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Wrap"><img src="image/allcategory/wrap.jpg" alt="Wrap"></a>
            </div>
            <a href="category.php?category=Wrap">Wrap</a>
        </div>
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Soup"><img src="image/allcategory/soup.jpg" alt="Soup"></a>
            </div>
            <a href="category.php?category=Soup">Soup</a>
        </div>
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Icecream"><img src="image/allcategory/icecream.jpg" alt="Ice Cream"></a>
            </div>
            <a href="category.php?category=Icecream">Ice Cream</a>
        </div>
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Pancakes"><img src="image/allcategory/cupcake.jpg" alt="Pancakes"></a>
            </div>
            <a href="category.php?category=Pancakes">Pancakes</a>
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
