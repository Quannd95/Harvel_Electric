<?php
require '../../../php_files/connection.php';

$product_id = $_GET['product_id'];
$shop_id = $_GET['shop_id'];
$shop_name = $_GET['shop_name'];

$conn = connectToDB();
$query = "delete from product_shop where product_id = '$product_id' and shop_id = '$shop_id'";
$stmt = $conn->prepare($query);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
if ($stmt->execute()) {
    $conn = null;
    echo "<script>
    alert('Xóa sản phẩm thành công!');
    window.location.href = 'index.php?shop_id=$shop_id&shop_name=$shop_name' ;
    </script>";
}

?>