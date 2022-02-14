<?php
echo $_POST['product'];
echo $_GET['shop_id'];

$conn = connectToDB();
$query = "Insert into products where not exists (select product_id from product_shop WHERE products.id = product_shop.product_id AND product_shop.shop_id='" . $_GET['shop_id'] . "' )";
$stmt = $conn->prepare($query);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

?>