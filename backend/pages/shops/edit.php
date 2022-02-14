<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Harvel Electric |</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css" />
    <?php
    require '../../php_files/connection.php';
    ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index.php" class="brand-link">
                <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
                <span class="brand-text font-weight-light">Harvel Electric</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <ul class="nav nav-treeview" style="display: block">
                                <li class="nav-item">
                                    <a href="../../pages/shops/index.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Shops</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../pages/categories/index.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../pages/products/index.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Products</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../logout.php" class="nav-link">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        <p>Đăng xuất</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Sửa thông tin shop</h1>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?php
                    if (isset($_GET['shop_id'])) {
                        $conn = connectToDB();
                        $shop_id = $_GET['shop_id'];

                        $query = "select * from shops where id = $shop_id";
                        $stmt = $conn->prepare($query);
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $stmt->execute();

                        $shop = $stmt->fetch();
                        $conn = null;
                    }
                    ?>
                    <div class="row">
                        <!-- left column -->
                        <div class="card card-primary w-100">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo $shop['name'] ?></h3>
                            </div>
                            <!-- form start -->
                            <form action="edit.php?shop_id=<?php echo $shop['id'] ?>" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="shop_name">Tên shop:</label>
                                        <input type="text" class="form-control" id="shop_name" name="shop_name" value="<?php echo $shop['name'] ?>" placeholder="Tên shop" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Địa chỉ:</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $shop['address'] ?>" placeholder="Địa chỉ" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="owner">Chủ shop:</label>
                                        <input type="text" class="form-control" id="owner" name="owner" value="<?php echo $shop['owner'] ?>" placeholder="Chủ shop" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $shop['email'] ?>" placeholder="Email" required />
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name='submit' class="btn btn-primary">
                                        Chấp nhận
                                    </button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['submit'])) {
                                $conn = connectToDB();

                                $name = $_POST['shop_name'];
                                $address = $_POST['address'];
                                $owner = $_POST['owner'];
                                $email = $_POST['email'];
                                $query = "update shops set name = '$name', 
                                    address = '$address', 
                                    owner = '$owner', 
                                    email = '$email' where id = $shop_id";

                                $stmt = $conn->prepare($query);
                                $stmt->execute();

                                $conn = null;
                                echo '<script>
                                alert("Sửa thông tin shop thành công!");
                                window.location.href = "index.php" ;
                                </script>';
                            }
                            ?>
                        </div>
                        <!-- /.card -->
                        <!--/.col (left) -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>