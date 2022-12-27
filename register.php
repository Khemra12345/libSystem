<?php include'./frontend/includes/register_header.php'  ?>

<?php
session_start();
require './frontend/config/db.php';

if (isset($_POST["login"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $message = '<label>All fields are required</label>';
    } else {
        $sql = "SELECT * FROM User WHERE username = :username AND password = :password";
        $statement = $conn->prepare($sql);
        $statement->execute(
            array(
                'username' => $_POST["username"],
                'password' => $_POST["password"],
            )
        );
        $count = $statement->rowCount();
        if ($count > 0) {
            $_SESSION["username"] = $_POST["username"];
            header("location:./admin/home.php");
        } else {
            $message = '<label>Invalid username or password</label>';
        }
    }
}
?>

<!-- ABOUT -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a style="font-weight: bold;" class="nav-link active" data-toggle="tab"
                                href="#home">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Register</a>
                        </li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active"><br>
                            <div class="col-md-6 col-sm-12">
                                <div class="about-info">
                                    <h2>Start your journey to a better life with online practical courses</h2>


                                    <figure>
                                        <span><i class="fa fa-certificate"></i></span>
                                        <figcaption>
                                            <h3>International Certifications</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ipsa
                                                voluptatibus.</p>
                                        </figcaption>
                                    </figure>

                                    <figure>
                                        <span><i class="fa fa-bar-chart-o"></i></span>
                                        <figcaption>
                                            <h3>Free for 3 months</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ipsa
                                                voluptatibus.</p>
                                        </figcaption>
                                    </figure>
                                </div>

                            </div>

                            <div class="col-md-offset-1 col-md-4 col-sm-12">
                                <div class="entry-form">
                                    <form action="#" method="post">
                                        <h2>Login</h2>

                                        <input type="text" name="username" style="color:white;" class="form-control"
                                            placeholder="Your Username" required="">

                                        <input type="password" style="color:white;" name="password" class="form-control"
                                            placeholder="Your password" required="">

                                        <?php
                                            if (isset($message)) {
                                                echo '<label class="text-danger">' . $message . ' <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>';
                                            }
                                        ?>

                                        <button type="submit" name="login" class="submit-btn form-control"
                                            id="form-submit">Get
                                            started</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="container tab-pane fade"><br>
                        <h3 class="text-center">STUDETN INFORMATION</h3>
                            <div class="col-md-6 col-sm-12">
                                <div class="about-info">
                                <form action="#" method="post">
                                        <div class="form-group">
                                            <label for="studentid" class="form-label">Student ID</label>
                                            <input type="text" name="txtStudentId" id="txtStudentId"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fullname" class="form-label">Student Name</label>
                                            <input type="text" name="txtStudentName" id="txtStudentName"
                                                class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="fullname" class="form-label">Password</label>
                                            <input type="text" name="txtStudentName" id="txtStudentName"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="chooseFile">Image</label>
                                            <input type="file" name="fileUpload" class="form-control" id="chooseFile">


                                            <!-- <div class="user-image mb-3 text-center">
                                                <div
                                                    style="width: 100%; height: 200px; overflow: hidden; background: #cccccc;">
                                                    <img src="..." class="figure-img img-fluid rounded"
                                                        id="imgPlaceholder" alt="">
                                                </div>
                                            </div> -->
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <label for="book" class="form-label">Class</label>
                                            <select class="form-control" name="ddlClass" id="ddlClass" required>
                                                <option>--Choose---</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" name="txtPhone" id="txtPhone" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="txtEmail" id="txtEmail" class="form-control">
                                        </div>

                                        <div class="col-mb-6">
                                            <button type="submit" name="login" class="btn btn-primary"
                                                id="form-submit">Get
                                                started</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                           
                        </div>
                    </div>

                </div>

            </div>
        </div>
</section>


<?php include'./frontend/includes/footer.php'  ?>