<?php include 'includes/header.php'; ?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <section class="content-header">
                <h1>
                    User
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Transaction</li>
                    <li class="active">User</li>
                </ol>
            </section>

            <div class="col-md-12">
                <div class="content-panel">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category List</h3> 
                            <button type="button" id="btnAdd" class="btn btn-primary" data-toggle="modal"
                                data-target="#myModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</button> 
                        </div>
                        <div class="card-body">
                            <table id="table_id" class="table table-hover d-flex justify-content-between">
                                <hr>                                       
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Category Info</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i
                                                        class="fas fa-closes"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="post" id="form">
                                                    <div class="form-group">
                                                        <label for="name">Category Name</label>
                                                        <input type="text" name="txtName" id="txtName" 
                                                            class="form-control" placeholder="category name" required>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
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
        
        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/scripts.php'; ?>

        
        <script type="text/javascript" src="js\jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js\dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" src="js\category.js"></script>
</body>