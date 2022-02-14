<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Harvel Electric | </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    
  <?php
  require '../../../php_files/connection.php';
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
      <a href="../../../index.php" class="brand-link">
        <img src="../../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Harvel Electric</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
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
              <ul class="nav nav-treeview" style="display: block;">
                <li class="nav-item">
                  <a href="../../../pages/shops/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Shops</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../../../pages/categories/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Categories</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../../../pages/products/index.php" class="nav-link">
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
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- /.card -->
              <?php
              $shop_name = $_GET['shop_name'];
              ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Danh sách các sản phẩm hiện có trong cửa hàng <?php echo $shop_name ?></h3>
                  <div class="form-group">
                                        <select class="form-control select2" style="width: 100%;" id='parent_id' name='parent_id'>
                                            <option value="0">Không</option>
                                            <?php
                                            $conn = connectToDB();
                                            $query = "Select * from products where not exists (select product_id from product_shop )";
                                            $stmt = $conn->prepare($query);
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            $stmt->execute();

                                            while ($row = $stmt->fetch()) {
                                            ?>
                                                <option value="<?php echo $row['id'] ?>" title="<?php echo $row['price'] ?>"><?php echo $row['name'] ?></option>
                                            <?php
                                            }
                                            $conn = null; ?>
                                        </select>
                                    </div>
                  <button type="button" class="btn btn-success float-right">+ Thêm sản phẩm</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Ảnh</th>
                        <th>Tóm lược tính năng</th>
                        <th>Tài liệu</th>
                        <th>Danh mục</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $root = '../../../uploads';
                      $conn = connectToDB();
                      $query = "Select products.*, categories.name as category_name from products
                    inner join categories on categories.id = products.category_id inner join product_shop
                    on product_shop.product_id = products.id where shop_id = " . $_GET['shop_id'];
                      $stmt = $conn->prepare($query);
                      $stmt->setFetchMode(PDO::FETCH_ASSOC);
                      $stmt->execute();

                      $order = 0;
                      while ($row = $stmt->fetch()) {
                      ?>
                        <tr>
                          <td><?php echo ++$order ?></td>
                          <td><?php echo $row['name'] ?></td>
                          <td><?php echo $row['price'] ?> Đ</td>
                          <td><img src='<?php echo $root . '/images/' . $row['image'] ?>' width="50" height="50" /></td>
                          <td><?php echo $row['feature_sum'] ?></td>
                          <td><a href="<?php echo $root . '/doc_files/' . $row['srs_file'] ?>"><?php echo $row['srs_file'] ?></a></td>
                          <td><?php echo $row['category_name'] ?></td>
                          <td>
                            <a class="badge badge-danger" style="margin: 2px;">Xóa</a>
                          </td>
                        </tr>
                      <?php }
                      $conn = null; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Ảnh</th>
                        <th>Tóm lược tính năng</th>
                        <th>Tài liệu</th>
                        <th>Danh mục</th>
                        <th></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../../plugins/jszip/jszip.min.js"></script>
  <script src="../../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../../dist/js/demo.js"></script>
  <!-- Select2 -->
  <script src="../../plugins/select2/js/select2.full.min.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
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