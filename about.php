
<?php
    include 'components/connect.php'; 
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }

    $get_id = isset($_GET['get_id']) ? $_GET['get_id'] : ''; 

    include 'components/add_wishlist.php'; 
    include 'components/add_cart.php'; 
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
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <title>Crave Harbour - About us Page</title>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
   
    <section style="
    padding-top: 2%;
    background-color: #f0f0f0;
">
    <div class="banner" style="
        background-color: lightgrey ;
        border-radius: 5px;
        padding: 1%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 0;
        min-height: 20vh;
    ">
        <div class="detail" style="text-align: center;">
            <a href="home.php" style="
                text-decoration: none;
                color: #333333;
                font-size:20px;
                top:10vw;
            "><i class="bx bx-left-arrow-alt"></i> Back to Home </a>
        </div><br>
        <h1 style="
            color: black;
            margin-top: 2%;
            text-align: center;
            font-size:50px;">About us</h1>
    </div>
</section>

    <div class="about-us">
        <div class="box-container">
            <div class="box">
                <span>Our Short Story</span>
                <h1>Why should You choose us ??</h1>
                <p>We Bring To You The Unforgettable Moment With Our Delicious Dishes. All Of Our Products Are Made From Scratch Using Family Recipes With Only The Highest Quality Ingredients. We Sell Fresh Food Daily To Ensure Only The Best Products Are Sold To Our Customers.</p>
                <br><br>
                <span>Our Services</span>
                <div class="services">
                    <div class="img-box">
                        <div class="img">
                            <img src="image/reservetable/2.jpg">
                        </div>
                        <p>Reservation</p>
                    </div>
                    <div class="img-box">
                        <div class="img">
                            <img src="image/reservetable/event.jpg">
                        </div>
                        <p>Private Event </p>
                    </div>
                    <div class="img-box">
                        <div class="img">
                            <img src="image/reservetable/orderonline.jpg">
                        </div>
                        <p> Online order </p>
                    </div>
                </div>
            </div>
            <div class="box">
                <img src="image/aboutus.jpg" alt="about image">
            </div>
        </div>
    </div>

    <div class="process" style="margin-top:7rem;">
        <div class="box-container">
            <div class="box">
                <img src="image/process.webp">
            </div>
            <div class="box">
                <span>Experience The Best Food</span>
                <h1>How To Order?</h1><br>
                <p>Follow The Steps</p><br>
                <div class="steps">
                    <p>1. Browse menu and select items.</p>
                    <p>2. Review order and provide delivery details.</p>
                    <p>3. Choose payment method.</p>
                    <p>4. Place order.</p>
                    <p>5. Receive confirmation.</p>
                    <p>6. Enjoy your meal!</p>

                </div>
            </div>
        </div>
    </div>

    <div class="team">
        <div class="title">
            <span style="font-size:2rem;">We Make Special</span>
            <h1 style="font-size:3.5rem;">Meet Our Chef</h1>
        </div>

        <div class="box-container">
            <div class="box">
                <div class="img-box">
                    <img src="image/chef-aboutus/1.png">
                </div>
                <div class="detail">
                    <h1>Julia</h1>
                    <div class="social-links">
                        <a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/"><i class="bx bxl-instagram-alt"></i></a>
                        <a href="https://www.linkedin.com/feed/"><i class="bx bxl-linkedin"></i></a>
                        <a href="https://twitter.com/"><i class="bx bxl-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="img-box">
                    <img src="image/chef-aboutus/2.png">
                </div>
                <div class="detail">
                    <h1>Allen Solly</h1>
                    <div class="social-links">
                        <a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/"><i class="bx bxl-instagram-alt"></i></a>
                        <a href="https://www.linkedin.com/feed/"><i class="bx bxl-linkedin"></i></a>
                        <a href="https://twitter.com/"><i class="bx bxl-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="img-box">
                    <img src="image/chef-aboutus/3.png">
                </div>
                <div class="detail">
                    <h1>Stewart</h1>
                    <div class="social-links">
                        <a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/"><i class="bx bxl-instagram-alt"></i></a>
                        <a href="https://www.linkedin.com/feed/"><i class="bx bxl-linkedin"></i></a>
                        <a href="https://twitter.com/"><i class="bx bxl-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="img-box">
                    <img src="image/chef-aboutus/4.png">
                </div>
                <div class="detail">
                    <h1>Alain Ducasse</h1>
                    <div class="social-links">
                        <a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/"><i class="bx bxl-instagram-alt"></i></a>
                        <a href="https://www.linkedin.com/feed/"><i class="bx bxl-linkedin"></i></a>
                        <a href="https://twitter.com/"><i class="bx bxl-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="img-box">
                    <img src="image/chef-aboutus/5.png">
                </div>
                <div class="detail">
                    <h1>Gordon Ramsay</h1>
                    <div class="social-links">
                        <a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/"><i class="bx bxl-instagram-alt"></i></a>
                        <a href="https://www.linkedin.com/feed/"><i class="bx bxl-linkedin"></i></a>
                        <a href="https://twitter.com/"><i class="bx bxl-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="img-box">
                    <img src="image/chef-aboutus/6.png">
                </div>
                <div class="detail">
                    <h1>Martin</h1>
                    <div class="social-links">
                        <a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/"><i class="bx bxl-instagram-alt"></i></a>
                        <a href="https://www.linkedin.com/feed/"><i class="bx bxl-linkedin"></i></a>
                        <a href="https://twitter.com/"><i class="bx bxl-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="img-box">
                    <img src="image/chef-aboutus/7.png">
                </div>
                <div class="detail">
                    <h1>Alleno</h1>
                    <div class="social-links">
                        <a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/"><i class="bx bxl-instagram-alt"></i></a>
                        <a href="https://www.linkedin.com/feed/"><i class="bx bxl-linkedin"></i></a>
                        <a href="https://twitter.com/"><i class="bx bxl-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="img-box">
                    <img src="image/chef-aboutus/8.png">
                </div>
                <div class="detail">
                    <h1>Paula Deen</h1>
                    <div class="social-links">
                        <a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/"><i class="bx bxl-instagram-alt"></i></a>
                        <a href="https://www.linkedin.com/feed/"><i class="bx bxl-linkedin"></i></a>
                        <a href="https://twitter.com/"><i class="bx bxl-twitter"></i></a>
                    </div>
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