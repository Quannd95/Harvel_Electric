<?php 
    require '../../../php_files/connection.php';

    if(isset($_GET['shop_id'])){
        $conn = connectToDB();
        $shop_id = $_GET['shop_id'];
        $query = "delete from shops where id = $shop_id";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        echo '<script>
        alert("Xóa shop thành công!");
        window.location.href = "../index.php" ;
        </script>';
    }
?>