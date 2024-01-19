<?php
include_once 'connectdb.php';

session_start();

$_SESSION['pagetitle'] = 'Order List';
$_SESSION['tbl'] = 'tbl_product';
include_once 'adminheader.php';

?>

<link rel="stylesheet" href="order_details_popup.css">


<!-- Content Wrapper. Contains page content -->
<div class="mywrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Order Lists</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Order Lists</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
    
            <div class="card card-outline card-warning card-custom">
                    <div class="card-header">
                        <div class="row">
    
                            <div class="col-10">
                                <h3 class="card-title">Order List</h3>
                            </div>
                            <div class="col-md-2">
                                <h3 class="card-title">
                                    <!-- Back to Product list button -->
                                    <a href="createorder.php" class="btn btn-info" style="display:flex; align-items:center; gap:5px;">
                                        <i class="fas fa-angle-left right"></i>Create Order
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!-- Table Column -->
                    <div id="tablecategory1" class="col-12 custom-table">
                        <div id="table-row" class="row">
                            <!-- <div class="col-md-12"></div> -->
                        </div>
                        <table id="tablecategory" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Subtotal</th>
                                    <!-- <th>...</th> -->
                                    <th>Tax</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Pay_type</th>
                                    <th>Edit Order</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
    
                                $select = $pdo->prepare("select * from tbl_invoice order by invoice_id desc");
                                $select->execute();
                                
                                while ($row = $select->fetch(PDO::FETCH_OBJ)) {
    
                                    echo '
                                        <tr>
                                            <td class="invoiceId">' . $row->invoice_id . '</td>
                                            <td>' . $row->customer_name . '</td>
                                            <td>' . $row->order_date . '</td>
                                            <td>' . $row->order_time . '</td>
                                            <td>' . $row->subtotal . '</td> 
    
                                            <td>' . $row->tax . '</td> 
                                            <td><small><em>' . $row->discount . '</em></small></td> 
                                            <td id="nettotal">' . $row->total . '</td> 
                                            <td>' . $row->paid . '</td> 
                                            <td>' . $row->due . '</td> 
                                            <td>' . $row->payment_type . '</td> 

                                            <td>
                                            <form method="post">
                                            <a href="editorder.php?id=' . $row->invoice_id . '" type="submit" class="btn btn-block btn-success btn-xs" name="btnedit" style="width:fit-content; padding: 7px 15px;"><i class="nav-icon fas fa-edit"></i></a>
                                            </form>
                                            </td>
                                            
                                            <td>
                                            <div class="mybtn cus-btn active" id="btn">
                                            Details
                                            </div>
                                            </td>
                                        </tr>
                                        ';
                                }
    
    
                                ?>
                            </tbody>
                            
                        </table>
                            
                    </div>
                    <!-- /.card-body -->
                </div>
                
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
        <!-- Add a modal to display details -->
        
    </div>

    <div id="menuModal" class="menu_box">
        <div class="menu_nav">
            <div class="home"></div>
            <div class="myclose" id="close"><h2>x</h2></div>
        </div>
        <div class="menu_content" id="menuContent">
            <table border="2px">
                <thead>
                    <th>product_name</th>
                    <th>quantity</th>
                    <th>price</th>
                    <th>order_time</th>
                    <th>order_date</th>
                </thead>
                <tbody class="table_content" style="text-align:center;">
    
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<!-- Order Details -->



<!-- Your JavaScript/jQuery code -->
<script>
$(document).ready(function () {
    $(".mybtn").on("click", function () {
        var tr = $(this).closest('tr');
        var invoiceId = tr.find('.invoiceId').text();
        // console.log(invoiceId);
        // Use AJAX to fetch details from tbl_invoice_details
        $.ajax({
            url: 'get_invoice_details.php', // replace with your PHP script to fetch details
            method: 'get',
            data: { id: invoiceId }, // Use the correct parameter name here
            success: function (data) {
                // Update the menuContent div with the fetched details
                $(".table_content").html(data);

                // Show the modal
                $("#menuModal").addClass("active");
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $("#close").on("click", function () {
        // Close the modal
        $("#menuModal").removeClass("active");
    });
});

</script>
<!-- /.Order Details -->

<!-- Page specific script -->
<script>
    $(document).ready(function() {
        $('#tablecategory').DataTable({
            "order": [
                [0, "desc"]
            ],
            "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#table-row');
    });
</script>

<script>
    $(document).ready(function(){
        var nettotal = $("#nettotal");

        console.log(nettotal.val());
    })
</script>


<?php

include_once 'sidebar.php';

?>


<?php

include_once 'footer.php';

?>