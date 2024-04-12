<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="IE-edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Product Search</title>
    <!--fav-icon---------------->
    <link rel="shortcut icon" href="Images/icon.png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="search-bar">
        <form method="post">
            <input class="search-btn" type="submit" name="searchbtn" value="Search" />
            <!--search-input------->
            <div class="search-input">
                <input type="text" placeholder="Search For Product" name="search" />
                <!--cancel-btn--->
                <a href="javascript:void(0);" class="search-cancel">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['searchbtn'])) {
        //Kết nối theo Mysqli procedural
        $connect = mysqli_connect('localhost', 'root', '', 'mydb');
        $searchname = $_POST['search'];

        // Truy vấn từ bảng product cột pname = giá trị tên sản phẩm nhập từ form
        $sql = "SELECT * FROM product WHERE pname ='$searchname'";
        $result = mysqli_query($connect, $sql);

        // Kiểm tra nếu có kết quả trả về
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                // Hiển thị thông tin sản phẩm
                echo "<div class='product-box'>";
                echo "<div class='product-img'>";
                echo "<a class='add-cart'><i class='fas fa-shopping-cart'></i></a>";
                echo "<a href='detail.php?id=" . $row['pid'] . "' class='p-name'>" . $row['pname'] . "<img src='" . $row['pimg'] . "'></a>";
                echo "</div>";
                echo "<div class='product-details'>";
                echo "<a href='detail.php?id=" . $row['pid'] . "' class='p-name'>" . $row['pname'] . "</a>";
                echo "<span class='p-price'>" . $row['pprice'] . "</span>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No products found.";
        }
    }
    ?>

</body>

</html>
