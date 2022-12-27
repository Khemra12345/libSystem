<?php
      require '../config/db.php';
    include('function.php');
    if(isset($_POST["operation"]))
    {
        if($_POST["operation"] == "Add")
        {
            $image = '';
            if($_FILES["user_image"]["name"] != '')
            {
                $image = upload_image();
            }
            $statement = $conn->prepare("
                INSERT INTO User (username, password, image, email) 
                VALUES (:username, :password, :image, :email)
            ");
            $result = $statement->execute(
                array(
                    ':username'   =>  $_POST["username"],
                    ':password'    =>  $_POST["password"],
                    ':image'        =>  $image,
                    ':email'    =>  $_POST["email"],
                )
            );
            if(!empty($result))
            {
                echo 'Data Inserted';
            }
        }
        if($_POST["operation"] == "Edit")
        {
            $image = '';
            if($_FILES["user_image"]["name"] != '')
            {
                $image = upload_image();
            }
            else
            {
                $image = $_POST["hidden_user_image"];
            }
            $statement = $conn->prepare(
                "UPDATE User SET usermane = :usermane, password = :password, image = :image, email = :email WHERE id = :id
                "
            );
            $result = $statement->execute(
                array(
                    ':username'   =>  $_POST["username"],
                    ':password'    =>  $_POST["password"],
                    ':image'        =>  $image,
                    ':email'    =>  $_POST["email"],
                    ':id'       =>  $_POST["user_id"]
                )
            );
            if(!empty($result))
            {
                echo 'Data Updated';
            }
        }
    }
?>