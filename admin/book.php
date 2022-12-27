<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-top: 50px;">
            <!-- Content Header (Page header) -->

            <section class="content-header">
                <h1>
                    Book List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

                    <li class="active">Book</li>
                </ol>
            </section>

            <div class="col-md-12">
                <div class="content-panel" style="padding-top: 10px;">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal"
                                class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                Add New</button>
                                <button type="button" id="btnAvailable"
                                class="btn btn-success">Available</button>
                                <button type="button" id="btnUnAvailable" 
                                class="btn btn-success">Unavailable</button>
                        </div>
                        <div id="image_data">
                            <div class="card-body">
                                <table id="user_data" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="15%">BOOK TITLE</th>
                                            <th width="15%">AUTHOR</th>
                                            <th width="15%">CATEGORY</th>
                                            <th width="15%">IMAGE</th>
                                            <th width="10%">STATUS</th>
                                            <th width="15%">CREATE DATE</th>
                                            <th width="10%">Actions</th>
                                        </tr>
                                    </thead>
                                </table>

                                <div id="userModal" class="modal fade">
                                    <div class="modal-dialog">
                                        <form method="post" id="book_form" enctype="multipart/form-data">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add Book</h4>
                                                    <!-- <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-label="Close"></button> -->
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Book Title</label>
                                                        <input type="text" name="txtBookTitle" id="txtBookTitle"
                                                            class="form-control" placeholder="book_title">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label">Author</label>
                                                        <input type="text" name="txtAuthor" id="txtAuthor"
                                                            class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="category">Category</label>
                                                        <select class="form-control" id="txtCategoryId" name="txtCategoryId">
                                                            <option>--Choose--</option>
                                                            <?php
                                                            require("./config/db.php");
                                                            $sql=" SELECT * FROM Category";
                                                            $result =$conn->prepare($sql);
                                                            $result  ->execute();
                                                            while($row=$result->fetch(PDO::FETCH_NUM)){
                                                                echo("<option value=" .$row[0].">" .$row[1]."</option>");
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>



                                                    <div class="form-group">
                                                        <label class="form-label">Image</label>
                                                        <input type="file" name="user_image" id="user_image"
                                                            class="form-control">
                                                        <span id="user_uploaded_image"></span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="user_id" id="user_id" />
                                                    <input type="hidden" name="operation" id="operation" />
                                                    <input type="submit" name="action" id="action"
                                                        class="btn btn-success" value="Add" />
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>


    </div>
</body>
<?php include 'includes/scripts.php'; ?>


<script type="text/javascript" src="js\jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js\dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="js\book1.js"></script>
<script type="text/javascript" src="js\book.js"></script>