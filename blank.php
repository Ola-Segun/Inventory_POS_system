<?php

include_once 'header.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Admin Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
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
            </script>
            <div class="card card-outline card-success card-custom">
                <div class="card-header">
                    <div class="row">

                        <div class="col-md-10">
                            <h3 class="card-title">Product list</h3>
                        </div>


                        <div class="col-md-2">
                            <h3 class="card-title">
                                <a href="productlist.php" class="btn btn-info" style="display:flex; align-items:center; gap:5px;">
                                    <i class="fas fa-angle-left right"></i>Productlist
                                </a>
                            </h3>
                        </div>


                    </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body row">

                    <div class="col-12">
                        <div id="table-row" class="row">
                            <div class="col-md-6"></div>
                        </div>
                        <table id="producttable" class="table table-striped my-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Product Categoty</th>
                                    <th>Puchase Price</th>
                                    <th>Sales Price</th>
                                    <th>Product Stock</th>
                                    <th>Product Des</th>
                                    <th>Product image</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                $select = $pdo->prepare("select * from tbl_product order by id desc");

                                $select->execute();

                                while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                    echo '
                                    <tr>
                                        <td>' . $row->id . '</td>
                                        <td>' . $row->productname . '</td>
                                        <td>' . $row->productcategory . '</td>
                                        <td>' . $row->purchaseprice . '</td>
                                        <td>' . $row->salesprice . '</td> 
                                        <td>' . $row->productstock . '</td> 
                                        <td>' . $row->productdescription . '</td> 
                                        <td><img src="productimages/' . $row->productimage . '" alt="" class="img-rounded" width="40px" height="40px" style="box-shadow:#969baf 2px 2px 4px;"></td> 
                                        <td>
                                        <form method="post">
                                            <button value="' . $row->id . '"  type="submit" class="btn btn-block btn-primary btn-xs" name="btnview"><i class="nav-icon fas fa-eye"></i></button>
                                        </form>
                                        </td>
                                        <td>
                                        <form method="post">
                                            <button value="' . $row->id . '"  type="submit" class="btn btn-block btn-success btn-xs" name="btnedit"><i class="nav-icon fas fa-edit"></i></button>
                                        </form>
                                        </td>
                                        <td>
                                        <form method="post">
                                            <button value="' . $row->id . '"  type="submit" class="btn btn-block btn-danger btn-xs" name="btndelete"><i class="nav-icon fas fa-trash"></i></button>
                                        </form>
                                        </td>

                                    </tr>
                                    ';
                                }


                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>


            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php

include_once 'sidebar.php';

?>


<?php

include_once 'footer.php';

?>