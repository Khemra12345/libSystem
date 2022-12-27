<?php include 'includes/header.php';?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php';?>
        <?php include 'includes/menubar.php';?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-top: 50px;">
            <!-- Content Header (Page header) -->

            <section class="content-header">
                <h1>
                    Borrow & Return List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Student</li>
                    <li class="active">Borrow & Return List</li>
                </ol>
            </section>

            <div class="col-md-12">
                <div class="content-panel" style="padding-top: 10px;">
                    <div class="card">
                        <div class="card-header" style=" display: flex; justify-content: space-between;">
                            <div>
                                <button type="button" id="btnAdd" class="btn btn-primary" data-toggle="modal"
                                    data-target="#myModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                    New</button>
                                    <button type="button" id="btnPending" class="btn btn-info">
                                    Pending
                                </button> 
                                <button type="button" id="btnRetuurn" class="btn btn-info">
                                    Returned
                                </button> 
                            </div>
                            
                           



                        </div>
                        <div class="card-body">
                            <table data-ordering="false" id="table_id"
                                class="table table-hover d-flex justify-content-between">

                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Borrow Info</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i
                                                        class="fas fa-closes"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="post" id="form" enctype='multipart/form-data'>

                                                    <div class="form-group">
                                                        <label for="book" class="form-label">Book</label>
                                                        <select class="form-control" name="ddlBook" id="ddlBook"
                                                            required>
                                                            <option>--Choose---</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="student" class="form-label">Student</label>
                                                        <select class="form-control" name="ddlStudent" id="ddlStudent"
                                                            required>
                                                            <option>--Choose---</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="borrowdate" class="form-label">Borrow Date</label>
                                                        <input type="date" name="txtBorrowDate" id="txtBorrowDate"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="returndate" class="form-label">Return Date</label>
                                                        <input type="date" name="txtReturnDate" id="txtReturnDate"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="remark" class="form-label">Remark</label>
                                                        <textarea class="form-control" id="txtRemark"
                                                            name="txtRemark"></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success"
                                                            id="btnSave">Save</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </table>

                        </div>

                    </div>
                </div>

            </div>
        </div>

        <?php include 'includes/footer.php';?>
        <?php include 'includes/scripts.php';?>

        <script type="text/javascript" src="js\jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js\dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" src="js\borrow.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css"
            rel="stylesheet" type="text/css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js">
        </script>
</body>