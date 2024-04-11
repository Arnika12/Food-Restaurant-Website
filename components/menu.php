<div class="box-container">
<?php
    $select_products = $conn->prepare("SELECT * FROM products LIMIT 6");
    $select_products->execute();
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
<div class="more">
    <a href="menu.php" class="btn">load more</a>
</div>
