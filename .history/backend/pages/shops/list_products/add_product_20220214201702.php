<?php
$product_id = $_POST['product'];
$shop_id = $_GET['shop_id'];

$conn = connectToDB();
$query = "Insert into product_shop(product_id, shop_id) values('')";
$stmt = $conn->prepare($query);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

?>