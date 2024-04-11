
<?php
    include 'components/connect.php'; 
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }

    $get_id = $_GET['get_id'];

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
    <!-- <link rel="stylesheet" href="style.css" type="text/css"> -->
    <link rel="icon" href="../uploaded_img/icon.png" type="image">
    <title>Crave Harbour - Menu Page</title>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
   
    <section style="
    /* padding: 1%; */
    background-color: #f0f0f0;
">
    <div class="banner" style="
        background-color: #ffffff;
        border-radius: 5px;
        padding: 1%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 0;
        min-height: 20vh;
    ">

    <div class="detail" style="text-align: left; margin-top: 1%;margin-left:2%;">
                <a href="home.php" style="
                    text-decoration: none;
                    color: #333333;
                    font-size:20px;
                "><i class="bx bx-left-arrow-alt"></i> Back to home </a>
    </div><br><br>

    <h1 style="
                color: #ff004f;
                margin-top: 2%;
                text-align: center;
                font-size:50px;
            "> Our Menu</h1>
        </div>
</section>

<div>
    <p >
        <button onclick="window.location.href='all_categories.php'" style="
        background-color: #0e90e4;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 30px;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 20px;
        display: block;
        margin-left: 20px;
        margin-right: auto;
         ">See products by category</button>
    </p>
</div>


   <section class="products">
        <div class="box-container">
            <?php
                $select_products = $conn->prepare("SELECT * FROM products WHERE status = ?");
                $select_products->execute(['active']);
                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>

            <form action="" method="post" class="box">
                <img src="uploaded_img/<?= $fetch_products['image']; ?>" class="image">
                <div class="button">
                    <div><h3 class="name"><?= $fetch_products['name']; ?></h3></div>
                    <div>
                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                        <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                        <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="bx bxs-show"></a>
                    </div>
                </div>
                <p class="price">price $<?= $fetch_products['price']; ?></p>
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <div class="flex-btn">
                    <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">buy now</a>
                    <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                </div>
            </form>

            <?php
                    }
                } else {
                    echo '
                        <div class="empty">
                            <p>no products added yet!</p>
                        </div>
                    ';
                }
            ?>
    </div>
   </section>


    <?php include 'components/footer.php'; ?>

    <?php include 'components/dark.php'; ?>
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- custom js link -->
    <script type="text/javascript" src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>