<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit;
}

// Get the product ID from the URL parameter
$product_id = $_GET['id'];

// Fetch the product details from the database
$select_post = $conn->prepare("SELECT * FROM products WHERE id = ?");
$select_post->execute([$product_id]);
$fetch_post = $select_post->fetch(PDO::FETCH_ASSOC);
?>

<style type="text/css">
    <?php include 'admin_style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
          integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <title>Admin - Product Details</title>
</head>
<body>
<div class="main-container">
    <?php include '../components/admin_header.php'; ?>
    <section class="show-post">
        <h1 class="heading">Product Details</h1>
        <div class="box-container">
            <?php if ($fetch_post) { ?>
                <div class="back-btn-container">
                    <a href="javascript:history.go(-1);" class="back-btn">
                        <i class='bx bx-arrow-back'></i> Back
                    </a> <!-- Back button -->
                </div>
                <div class="box">
                    <input type="hidden" name="product_id" value="<?= $fetch_post['id']; ?>">
                    <div class="status"
                         style="color: <?php echo $fetch_post['status'] == 'active' ? 'limegreen' : 'coral'; ?>;">
                        <?= $fetch_post['status']; ?>
                    </div>
                    <?php if ($fetch_post['image'] != '') { ?>
                        <img src="../uploaded_img/<?= $fetch_post['image']; ?>" class="image">
                    <?php } ?>
                    <div class="price">$<?= $fetch_post['price']; ?>/-</div>
                    <div class="title"><?= $fetch_post['name']; ?></div>
                    <div class="content"><?= $fetch_post['product_detail']; ?></div>
                    <div class="flex-btn">
                        <a href="edit_post.php?id=<?= $fetch_post['id']; ?>" class="btn">Edit</a>
                        <a href="view_posts.php" class="btn">Go Back</a>
                    </div>
                </div>
            <?php } else { ?>
                <div class="empty">
                    <p>No product found!</p>
                </div>
            <?php } ?>
        </div>
    </section>
</div>

<?php include '../components/dark.php'; ?>
<!-- sweetalert cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- custom js link -->
<script type="text/javascript" src="script.js"></script>
<?php include '../components/alert.php'; ?>
</body>
</html>