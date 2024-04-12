<?php
session_start();

// Kiểm tra nếu giỏ hàng không tồn tại, hoặc rỗng, hiển thị thông báo và dừng quá trình thực thi
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty.</p>";
    exit();
}

// Kiểm tra nếu người dùng bấm nút Thêm vào giỏ hàng
if (isset($_POST['add_to_cart'])) {
    // Lấy thông tin sản phẩm được thêm vào giỏ hàng
    $product_id = $_POST['product_id'];

    // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
    if (isset($_SESSION['cart'][$product_id])) {
        // Tăng số lượng sản phẩm nếu đã có trong giỏ hàng
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        // Nếu sản phẩm không tồn tại trong giỏ hàng, thêm sản phẩm vào giỏ hàng
        $_SESSION['cart'][$product_id] = array(
            'name' => $_POST['product_name'],
            'price' => $_POST['product_price'],
            'quantity' => 1
        );
    }

    // Chuyển hướng người dùng trở lại trang cart.php sau khi thêm sản phẩm vào giỏ hàng
    header("Location: cart.php");
    exit();
}

// Hiển thị danh sách sản phẩm trong giỏ hàng trong một bảng
echo "<table>";
echo "<tr><th>Product Name</th><th>Price</th><th>Quantity</th></tr>";
foreach ($_SESSION['cart'] as $product_id => $product_info) {
    echo "<tr>";
    echo "<td>" . $product_info['name'] . "</td>";
    echo "<td>$" . $product_info['price'] . "</td>";
    echo "<td>" . $product_info['quantity'] . "</td>";
    // Thêm các tính năng khác như cập nhật số lượng, xóa sản phẩm, tính tổng giá trị giỏ hàng, ...
    echo "</tr>";
}
echo "</table>";
?>

<!-- Form để thêm sản phẩm vào giỏ hàng -->
<form method="POST">
    <input type="hidden" name="product_id" value="product_id_here">
    <input type="hidden" name="product_name" value="product_name_here">
    <input type="hidden" name="product_price" value="product_price_here">
    <input type="submit" name="add_to_cart" value="Add to Cart">
</form>

<!-- Script JS -->
<script>
    // Function để xác nhận khi người dùng bấm nút "Thêm vào giỏ hàng"
    function addToCart(productId, productName, productPrice) {
        // Tạo một biến form để gửi dữ liệu sản phẩm
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "cart.php"; // Trang xử lý khi gửi dữ liệu

        // Tạo các input ẩn chứa thông tin sản phẩm
        var inputProductId = document.createElement("input");
        inputProductId.type = "hidden";
        inputProductId.name = "product_id";
        inputProductId.value = productId;
        form.appendChild(inputProductId);

        var inputProductName = document.createElement("input");
        inputProductName.type = "hidden";
        inputProductName.name = "product_name";
        inputProductName.value = productName;
        form.appendChild(inputProductName);

        var inputProductPrice = document.createElement("input");
        inputProductPrice.type = "hidden";
        inputProductPrice.name = "product_price";
        inputProductPrice.value = productPrice;
        form.appendChild(inputProductPrice);

        // Thêm form vào body của trang
        document.body.appendChild(form);

        // Gửi form đi để thêm sản phẩm vào giỏ hàng
        form.submit();
    }
</script>
