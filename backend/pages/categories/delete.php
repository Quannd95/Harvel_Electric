<?php 
    require '../../php_files/connection.php';
    require '../../php_files/global.php';

    if(isset($_GET['category_id'])){
        $conn = connectToDB();
        $category_id = $_GET['category_id'];
        $query = "delete from categories where id = $category_id";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $conn = null;
        echo '<script>
        alert("Xóa danh mục thành công!");
        window.location.href = "index.php" ;
        </script>';
    }
?>