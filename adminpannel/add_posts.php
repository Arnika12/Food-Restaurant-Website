<?php
include '../components/connect.php';

session_start();

// Redirect if admin is not logged in
if (!isset($_SESSION['admin_id'])) {
    header('location:admin_login.php');
    exit(); // Exit after redirection
}

$admin_id = $_SESSION['admin_id'];

// Function to generate unique ID
function unique_id()
{
    return uniqid();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['publish']) || isset($_POST['draft'])) {
        $id = unique_id();
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

        // Check if image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image'];
            $image_name = $image['name'];
            $image_tmp_name = $image['tmp_name'];
            $image_size = $image['size'];
            $image_folder = '../uploaded_img/' . $image_name;

            // Check if image name is repeated
            $select_image = $conn->prepare("SELECT * FROM products WHERE image = ?");
            $select_image->execute([$image_name]);
            if ($select_image->rowCount() > 0) {
                $warning_msg[] = 'Image name repeated!';
            } elseif ($image_size > 3000000) { // Check image size
                $warning_msg[] = 'Image size is too large!';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
            }
        } else {
            $image_name = '';
        }

        $status = isset($_POST['publish']) ? 'active' : 'deactive';

        // Insert product into database
        $insert_post = $conn->prepare("INSERT INTO products (id, name, price, image, category, product_detail, status, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_post->execute([$id, $title, $price, $image_name, $category, $content, $status, $admin_id]);

        if ($status === 'active') {
            $success_msg[] = 'Product inserted successfully!';
        } else {
            $success_msg[] = 'Product saved as draft!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Product Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
          integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="admin_style.css">
    <link rel="icon" href="uploaded_img/icon.png" type="image">
</head>
<body>
<div class="main-container">
    <?php include '../components/admin_header.php'; ?>
    <section class="post-editor">
        <h1 class="heading">Add product</h1>
        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-field">
                    <label>Product Name <sup>*</sup></label>
                    <input type="text" name="title" maxlength="100" placeholder="Add product title" required>
                </div>
                <div class="input-field">
                    <label>Product Price <sup>*</sup></label>
                    <input type="number" name="price" placeholder="Add product price" required>
                </div>
                <div class="input-field">
                    <label>Product Detail <sup>*</sup></label>
                    <textarea name="content" required maxlength="10000" placeholder="Product detail"></textarea>
                </div>
                <div class="input-field">
                    <label>Product Category <sup>*</sup></label>
                    <select name="category" required>
                        <option selected disabled>----- Select category -----</option>
                        <option value="Biryani">Biryani</option>
                        <option value="Burger">Burger</option>
                        <option value="Pizza">Pizza</option>
                        <option value="Salad">Salad</option>
                        <option value="Soup">Soup</option>
                        <option value="Wrap">Wrap</option>
                        <option value="Pasta">Pasta</option>
                        <option value="Cakes">Cakes</option>
                        <option value="Pancakes">Pancakes</option>
                        <option value="Icecream">Icecream</option>
                    </select>
                </div>
                <div class="input-field">
                    <label>Product Image <sup>*</sup></label>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                <div class="flex-btn">
                    <input type="submit" name="publish" value="Publish Now" class="btn">
                    <input type="submit" name="draft" value="Save Draft" class="btn">
                </div>
            </form>
        </div>
    </section>
</div>
<?php include '../components/dark.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="script.js"></script>
<?php include '../components/alert.php'; ?>
</body>
</html>
