<?php 
    session_destroy();

    echo '<script>
        alert("Đăng xuất thành công!");
        window.location.href = "login.php";
        </script>';
