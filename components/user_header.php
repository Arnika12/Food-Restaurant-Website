<div class="head">
    <header>
        <div class="logo">
            <img src="image/logo.png">
        </div>
        <div class="logo1">
            <div class="bx bxs-user" id="user-btn"></div>
            <div class="bx bx-menu" id="menu-btn"></div>
            <?php
                $count_wishlist_item = $conn->prepare("SELECT * FROM wishlist WHERE user_id=?");
                $count_wishlist_item->execute([$user_id]);
                $total_wishlist_item = $count_wishlist_item->rowCount();
            ?>
            <a href="wishlist.php" class="cart-btn"><i class="bx bx-heart"></i><sup>
                <?= $total_wishlist_item; ?> </sup></a>

            <?php
                $count_cart_item = $conn->prepare("SELECT * FROM cart WHERE user_id=?");
                $count_cart_item->execute([$user_id]);
                $total_cart_item = $count_cart_item->rowCount();
            ?>
            <a href="cart.php" class="cart-btn"><i class="bx bx-cart"></i><sup>
            <?= $total_cart_item; ?> </sup></a>
        </div>
        <!-- ------------ profile detail ------------ -->
        <div class="profile-detail">
            <?php
                include 'connect.php'; // Include the file containing database connection code
                // session_start();

                // Check if the "user_id" session variable is set
                if(isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $select_profile = $conn->prepare("SELECT * FROM users WHERE id=? ");
                    $select_profile->execute([$user_id]);

                    if($select_profile->rowCount() > 0){
                        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="profile">
                <img src="uploaded_img/<?= $fetch_profile['profile']; ?>" class="logo-image">
                <p><?= $fetch_profile['name']; ?></p>
            </div>
            <div class="flex-btn">
                <a href="update_profile.php" class="btn" style="width:200px;">Update profile</a>
                <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="btn">logout</a>
            </div>
            <?php } else { ?>
                <p class="name">Please login or register</p>
                <div class="flex-btn">
                    <a href="login.php" class="btn">Login</a>
                    <a href="register.php" class="btn">Register</a>
                </div>
            <?php } ?>
            <?php } else { ?>
                <p class="name">Please login or register</p>
                <div class="flex-btn">
                    <a href="login.php" class="btn">Login</a>
                    <a href="register.php" class="btn">Register</a>
                </div>
            <?php } ?>
        </div>

        <!-------------- side bar -------------->
        <div class="sidebar">
            <?php
                // You don't need to repeat the same code block again for the sidebar, 
                // You can use the $fetch_profile variable if it's available
                if(isset($fetch_profile)){
            ?>
            <div class="profile">
                <img src="uploaded_img/<?= $fetch_profile['profile']; ?>" class="logo-image">
                <p><?= $fetch_profile['name']; ?></p>
            </div>
            <?php }else{ ?>
                <div class="profile">
                    <img src="image/user.png" class="logo-image">      <!-- image folder  -->
                    <p>user </p>
                </div>
            <?php } ?>
            <h5>menu</h5>
            <ul>
                <li><a href="home.php"><i class="bx bxs-home-smile"></i>home</a></li>
                <li><a href="about.php"><i class="bx bxs-shopping-bags"></i>about</a></li>
                <li><a href="menu.php"><i class="bx bxs-food-menu"></i>menu</a></li>
                <li><a href="contact.php"><i class="bx bxs-user-detail"></i>contact</a></li>
                <li><a href="order.php"><i class="bx bxs-user-detail"></i>order</a></li>
                <li><a href="register.php"><i class="bx bxs-user-detail"></i>register</a></li>
                <li><a href="logout.php" onclick="return confirm('logout from this website');"><i class="bx bx-log-out"></i>logout</a></li>
            </ul>
            <h5>Find us</h5>
            <div class="social-links">
                <i class="bx bxl-facebook"></i>
                <i class="bx bxl-instagram-alt"></i>
                <i class="bx bxl-linkedin"></i>
                <i class="bx bxl-twitter"></i>
                <i class="bx bxl-pinterest-alt"></i>
            </div>
        </div>
    </header>
</div>
