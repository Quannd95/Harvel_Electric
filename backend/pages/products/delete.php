<?php
require '../../php_files/connection.php';
require '../../php_files/global.php';

if (isset($_GET['product_id'])) {
    $conn = connectToDB();
    $product_id = $_GET['product_id'];

    $query = "Select * from products where id = $product_id";
    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $product = $stmt->fetch();

    $temp_category_id = $product['category_id'];
    $temp_img = $product['image'];
    $temp_srs = $product['srs_file'];

    $query = "delete from products where id = $product_id";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    unlink($root_upload_folder_in_pages . "images/$temp_img");
    unlink($root_upload_folder_in_pages . "doc_files/$temp_srs");

    $conn = null;
    echo '<script>
        alert("Xóa sản phẩm thành công!");
        window.location.href = "index.php" ;
        </script>';
}
