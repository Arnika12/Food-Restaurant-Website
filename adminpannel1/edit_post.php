<?php
    include '../components/connect.php'; 
    
    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:admin_login.php');
        exit(); // Add exit after header redirect
    }

    if(isset($_POST['save'])) {
        $post_id = $_POST['post_id'];
        $title = $_POST['title'];
        $price = $_POST['price'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $status = $_POST['status'];

        // Update product details
        $update_post = $conn->prepare("UPDATE products SET name=?, price=?, product_detail=?, category=?, status=? WHERE id=?");
        $update_post->execute([$title, $price, $content, $category, $status, $post_id]);

        // Check if image is being uploaded
        if(isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $old_image = $_POST['old_image'];
            $image = $_FILES['image']['name'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_folder = '../uploaded_img/'.$image;
            
            // Move uploaded image to folder
            move_uploaded_file($image_tmp_name, $image_folder);

            // Update image name in database
            $update_image = $conn->prepare("UPDATE products SET image=? WHERE id=?");
            $update_image->execute([$image, $post_id]);

            // Delete old image if exists
            if ($old_image != '' && file_exists('../uploaded_img/'.$old_image)) {
                unlink('../uploaded_img/'.$old_image);
            }
        }

        $success_msg[] = 'Product updated successfully';
    }

    // Delete product
    if(isset($_POST['delete_post'])){
        $post_id = $_POST['post_id'];
        
        // Select image to delete
        $delete_image = $conn->prepare("SELECT * FROM products WHERE id=?");
        $delete_image->execute([$post_id]);
        $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
        
        // Delete product from database
        $delete_post = $conn->prepare("DELETE FROM products WHERE id=?");
        $delete_post->execute([$post_id]);

        $success_msg[] = 'Product deleted successfully';

        // Delete image from folder
        if ($fetch_delete_image['image'] != '') {
            unlink('../uploaded_img/'.$fetch_delete_image['image']);
        }
    }

    // Delete image only
    if(isset($_POST['delete_image'])){
        $post_id = $_POST['post_id'];
        
        // Select image to delete
        $delete_image = $conn->prepare("SELECT * FROM products WHERE id=?");
        $delete_image->execute([$post_id]);
        $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
        
        // Remove image from database
        $unset_image = $conn->prepare("UPDATE products SET image='' WHERE id=?");
        $unset_image->execute([$post_id]);

        $success_msg[] = 'Image deleted successfully';

        // Delete image from folder
        if ($fetch_delete_image['image'] != '') {
            unlink('../uploaded_img/'.$fetch_delete_image['image']);
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
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <title>Admin - Edit Product Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="main-container">
        <?php  include '../components/admin_header.php'; ?>
        <section class="post-editor">
            <h1 class="heading">Edit Product</h1>
            <div class="box-container">
               <?php
                    $post_id = $_GET['id'];
                    $select_post = $conn->prepare("SELECT * FROM products WHERE id=?");
                    $select_post->execute([$post_id]);
                    if($select_post->rowCount() > 0){
                        while($fetch_post = $select_post->fetch(PDO::FETCH_ASSOC)){

               ?>
               <div class="form-container">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="old_image" value="<?= $fetch_post['image']; ?>">
                        <input type="hidden" name="post_id" value="<?= $fetch_post['id']; ?>">
                        <div class="input-field">
                            <label>Post Status <sup>*</sup></label>
                            <select name="status">
                                <option value="<?= $fetch_post['status']; ?>" selected><?= $fetch_post['status']; ?></option>
                                <option value="active">Active</option>
                                <option value="deactive">Deactive</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label>Product Name <sup>*</sup></label>
                            <input type="text" name="title" value="<?= $fetch_post['name']; ?>">
                        </div>
                        <div class="input-field">
                            <label>Product Price <sup>*</sup></label>
                            <input type="price" name="price" value="<?= $fetch_post['price']; ?>">
                        </div>
                        <div class="input-field">
                            <label>Product Detail <sup>*</sup></label>
                            <textarea name="content"><?= $fetch_post['product_detail']; ?></textarea>
                        </div>
                        <div class="input-field">
                            <label>Product Category <sup>*</sup></label>
                            <select name="category" required>
                                <option selected><?= $fetch_post['category']; ?></option>
                                <option value="what's hot">What's Hot</option>
                                <option value="burgers">Burgers</option>
                                <option value="chicken and salads">Chicken and Salads</option>
                                <option value="tacos, fries and sides">Tacos, Fries and Sides</option>
                                <option value="breakfast">Breakfast</option>
                                <option value="family dinner">Family Dinner</option>
                                <option value="shakes and desserts">Shakes and Desserts</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label>Post Image <sup>*</sup></label>
                            <input type="file" name="image" accept="image/*">
                            <?php if($fetch_post['image'] != ''){ ?>
                                <img src="../uploaded_img/<?= $fetch_post['image']; ?>" class="image">
                                <div class="flex-btn">
                                    <input type="submit" name="delete_image" class="btn" value="Delete Image">
                                    <a href="view_posts.php" class="btn">Go Back</a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="flex-btn">
                            <input type="submit" name="save" value="Save Product" class="btn">
                            <input type="submit" name="delete_post" value="Delete Product" class="btn">
                        </div>
                    </form>
               </div>
               <?php
                     }
                    } else {
                        echo '<div class="empty"><p>No product found!</p></div>';
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
