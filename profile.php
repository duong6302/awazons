<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="IE-edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BTEC</title>
    <!--fav-icon---------------->
    <link rel="shortcut icon" href="Images/icon.png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!--style----->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: poppins;
        }
    </style>
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
</head>

<body>

    <?php

    session_start();

    if (isset($_SESSION['email'])) {
        
        $u = $_SESSION['email'];

        echo "Welcome $u";
    }


    ?>
    <nav>

        <!--social-links-and-phone-number----------------->
        <div class="social-call">
            <!--social-links--->
            <div class="social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <!--phone-number------>
            <div class="phone">
                <span>Call: +000000000</span>
            </div>
        </div>
        <!--menu-bar----------------------------------------->
        <div class="navigation">
            <!--logo------------>
            <a href="index.php" class="logo"><img src="Images/icon.png">
                <span class="shop-name">BTEC</span></a>



            <!--menu----------------->
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li class="shop"><a href="#">Shop</a></li>
                <li><a href="#">Sale</a>
                    <!--label---->
                    <span class="sale-label">99% Off</span>
                </li>
                <li><a href="about.php">About Us</a></li>
            </ul>
            <!--right-menu----------->
            <div class="right-menu">
                <a href="javascript:void(0);" class="search">
                    <i class="fas fa-search"></i>
                </a>
                <a href="javascript:void(0);" class="user">
                    <i class="far fa-user"></i>
                </a>
                <a href="#">
                    <i class="fas fa-shopping-cart">
                        <span class="num-cart-product">0</span>
                    </i>
                </a>
            </div>
        </div>
    </nav>
    <!--search-bar----------------------------------->
    <form method="post">
        <div class="search-bar">

            <input class="search-btn" type="submit" name="searchbtn" value="Search" />
            <!--search-input------->
            <div class="search-input">

                <input type="text" placeholder="Search For Product" name="search" />


                <!--cancel-btn--->
                <a href="javascript:void(0);" class="search-cancel">
                    <i class="fas fa-times"></i>
                </a>


            </div>

            <?php

            //Kết nối theo Mysqli procedural
            $connect = mysqli_connect('localhost', 'root', '', 'mydb');

            if (isset($_POST['searchbtn'])) {

                $searchname = $_POST['search'];

                // Truy vấn từ bảng user cột username = giá trị username nhập từ form và cột password = giá trị password nhập từ form
                $sql = "SELECT * FROM product where pname ='$searchname' ";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($result)) {


                    //lấy ra từng dòng dữ liệu truy vấn được và hiển thị
                    //$row['product_id'];
                    //$row['product_name'];
                    //$row['product_img'];
                    //$row['product_price'];

            ?>
                    <!--product-box-1---------->
                    <div class="product-box">
                        <!--product-img------------>
                        <div class="product-img">
                            <!--add-cart---->
                            <a class="add-cart">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                            <!--img------>
                            <a href="detail.php?id=<?php echo $row['pid'] ?>" class="p-name"><?php echo $row['pname'] ?> <img src="<?php echo $row['pimg'] ?>"></a>

                        </div>
                        <!--product-details-------->
                        <div class="product-details">
                            <a href="detail.php?id=<?php echo $row['pid'] ?>" class="p-name"><?php echo $row['pname'] ?> </a>
                            <span class="p-price"><?php echo $row['pprice'] ?> </span>

                        </div>

                    </div><?php
                        }
                    }
                            ?>



    </form>
    </div>
    <!-- Modal -->
<div id="cartModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Your Cart</h2>
        <ul id="cartItems"></ul>
    </div>
</div>

    <!---login-and-sign-up--------------------------------->
    <div class="form">

        <!--login---------->
        <div class="login-form">
            <!--cancel-btn---------------->
            <a href="javascript:void(0);" class="form-cancel">
                <i class="fas fa-times"></i>
            </a>
            <strong>Log In</strong>
            <!--inputs-->
            <form method="POST">
                <input type="email" name="email" placeholder="Example@gmail.com" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="submit" name="login" value="Log In" />

                <?php

                //Kết nối theo Mysqli procedural
                $connect = mysqli_connect('localhost', 'root', '', 'mydb');

                // Nếu click vào nút login thì mới thực hiện 
                if (isset($_POST['login'])) {

                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    if ($email == "admin@gmail.com" && $password == "admin") {
                        echo "<script> alert('Move to Admin Page')</script>";

                        echo "<script> window.location.assign('AddProduct.php'); </script>";
                        exit;
                    } else {
                        // Truy vấn từ bảng user cột username = giá trị username nhập từ form và cột password = giá trị password nhập từ form
                        $sql = "SELECT * FROM customer WHERE cemail ='$email' AND cpassword = '$password'";


                        // Thực thi truy vấn
                        $result = mysqli_query($connect, $sql);
                        // Trả về kết quả , chính là các dòng được truy vấn
                        $row = mysqli_num_rows($result);
                        // Nếu $row > 0 --> có trên 1 dòng trong CSDL trùng với dữ liệu nhập vào form -> đăng nhập thành công 
                        if ($row > 0) {
                            echo "<script> alert('Successful')</script>";
                            //session
                            $_SESSION['email'] = $email;
                        } else {
                            echo "<script> alert('Failed')</script>";
                        }
                    }
                }
                ?>
            </form>
            <!--forget-and-sign-up-btn-->
            <div class="form-btns">
                <a href="#" class="forget">Forget Your Password?</a>
                <a href="javascript:void(0);" class="sign-up-btn">Create Account</a>
            </div>
        </div>
        <!--Sign-up---------->
        <div class="sign-up-form">
            <!--cancel-btn---------------->
            <a href="javascript:void(0);" class="form-cancel">
                <i class="fas fa-times"></i>
            </a>
            <strong>Sign Up</strong>
            <!--inputs-->
            <form method="POST">
                <input type="text" name="fullname" placeholder="Full Name" required />
                <input type="email" name="email" placeholder="Example@gmail.com" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="submit" name="signup" value="Sign Up" />


                <?php

                //Kết nối theo Mysqli procedural
                $connect = mysqli_connect('localhost', 'root', '', 'mydb');

                // Nếu click vào nút login thì mới thực hiện 
                if (isset($_POST['signup'])) {
                    $xname = $_POST['fullname'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    // Truy vấn từ bảng user cột username = giá trị username nhập từ form và cột password = giá trị password nhập từ form
                    $sql = "SELECT * FROM customer WHERE cemail ='$email' AND cpassword = '$password'";


                    // Thực thi truy vấn
                    $result = mysqli_query($connect, $sql);
                    // Trả về kết quả , chính là các dòng được truy vấn
                    $row = mysqli_num_rows($result);
                    // Nếu $row > 0 --> có trên 1 dòng trong CSDL trùng với dữ liệu nhập vào form -> đăng nhập thành công 
                    if ($row > 0) {
                        echo "<script> alert('email exist try again')</script>";
                        //session

                        $_SESSION['email'] = $email;
                    } else {
                        $sql = "INSERT INTO customer VALUES('$email','$password')";
                        $result = mysqli_query($connect, $sql);
                        if ($result) {

                            echo "<script> alert('Welcome $xname')</script>";
                        }
                    }
                }
                ?>
            </form>
            <!--forget-and-sign-up-btn-->
            <div class="form-btns">
                <a href="javascript:void(0);" class="already-account">
                    Already Have Account?</a>

            </div>
        </div>
    </div>

    <div class="container">
        <!-- Profile information -->
        <div class="profile-info">
            <h2>Profile Information</h2>
            <?php
            // Sample fake user data
            $user = array(
                'fullname' => 'John Doe',
                'email' => 'aaa@gmail.com',
                'address' => 'Tòa D, 13 P. Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội ',
                'phone' => '+1234567890',
                'birthdate' => 'January 1, 1990'
            );
            ?>

            <p><strong>Full Name:</strong> <?php echo $user['fullname']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p><strong>Address:</strong> <?php echo $user['address']; ?></p>
            <p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>
            <p><strong>Birthdate:</strong> <?php echo $user['birthdate']; ?></p>
        </div>

        <!-- Additional profile sections can be added as needed -->

    </div>
    


    <script src="js/JQuery.js"></script>
    <script>
        /*-----For Search Bar-----------------------------*/
        $(document).on('click', '.search', function() {
            $('.search-bar').addClass('search-bar-active')
        });

        $(document).on('click', '.search-cancel', function() {
            $('.search-bar').removeClass('search-bar-active')
        });
        /*---For Login and Sign-up----------------------------*/
        $(document).on('click', '.user,.already-account', function() {
            $('.form').addClass('login-active').removeClass('sign-up-active')
        });

        $(document).on('click', '.sign-up-btn', function() {
            $('.form').addClass('sign-up-active').removeClass('login-active')
        });

        $(document).on('click', '.form-cancel', function() {
            $('.form').removeClass('login-active').removeClass('sign-up-active')
        });
        // Open the modal when clicking on the cart icon
$('#cart-icon').click(function() {
    $('#cartModal').css('display', 'block');

    // Load cart items
    loadCartItems();
});

// Close the modal when clicking on the close button
$('.close').click(function() {
    $('#cartModal').css('display', 'none');
});

// Close the modal when clicking outside the modal
$(window).click(function(event) {
    if (event.target == $('#cartModal')[0]) {
        $('#cartModal').css('display', 'none');
    }
});

// Load cart items
function loadCartItems() {
    var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    var cartList = $('#cartItems');
    cartList.empty();

    if (cartItems.length === 0) {
        cartList.append('<li>Your cart is empty.</li>');
    } else {
        $.each(cartItems, function(index, item) {
            cartList.append('<li>' + item + '</li>');
        });
    }
}
$('.add-cart').click(function() {
    // Lấy thông tin sản phẩm
    var productName = $(this).closest('.product-details').find('.p-name').text();
    
    // Lưu thông tin sản phẩm vào local storage
    var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    cartItems.push(productName);
    localStorage.setItem('cartItems', JSON.stringify(cartItems));

    // Cập nhật số lượng sản phẩm trong giỏ hàng trên biểu tượng giỏ hàng
    var currentItemCount = parseInt($('#cart-icon .num-cart-product').text());
    $('#cart-icon .num-cart-product').text(currentItemCount + 1);

    // Hiển thị thông báo thành công (tùy chọn)
    alert('Sản phẩm ' + productName + ' đã được thêm vào giỏ hàng!');
});



    </script>


</body>

</html>
