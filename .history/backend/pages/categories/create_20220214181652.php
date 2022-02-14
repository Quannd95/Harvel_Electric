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
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    
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
                            <h1>Tạo danh mục</h1>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="card card-primary w-100">
                            <div class="card-header">
                                <h3 class="card-title"></h3>
                            </div>
                            <!-- form start -->
                            <form action="create.php" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category_name">Tên danh mục:</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Tên danh mục" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô tả:</label>
                                        <input type="text" class="form-control" id="description" name="description" placeholder="Mô tả" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục cha:</label>
                                        <select class="form-control select2" style="width: 100%;" id='parent_id' name='parent_id'>
                                            <option value="0">Không</option>
                                            <?php
                                            $conn = connectToDB();
                                            $query = "Select * from categories";
                                            $stmt = $conn->prepare($query);
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            $stmt->execute();

                                            while ($row = $stmt->fetch()) {
                                            ?>
                                                <option value="<?php echo $row['id'] ?>" title="<?php echo $row['description'] ?>"><?php echo $row['name'] ?></option>
                                            <?php
                                            }
                                            $conn = null; ?>
                                        </select>
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

                                $name = $_POST['category_name'];
                                $description = $_POST['description'];
                                $parent_id = $_POST['parent_id'];

                                $query = "insert into categories(name, description, parent_id) values('$name','$description', $parent_id)";

                                $stmt = $conn->prepare($query);
                                $stmt->execute();

                                $conn = null;
                                echo '<script>
                                alert("Tạo danh mục thành công!");
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
    <!-- Select2 -->
    <script src="../../plugins/select2/js/select2.full.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });

        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            document.getElementsByClassName('select2-selection select2-selection--single')[0].style.height = "40px";
        });
    </script>
</body>
</html>