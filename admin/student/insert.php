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
                INSERT INTO Student (studentId, studentName, password, 
                image, classId, phone, email) 
                VALUES (:studentId, :studentName, :password, :image, 
                :classId, :phone, :email)
            ");
            $result = $statement->execute(
                array(
                    ':studentId'   =>  $_POST["studentId"],
                    ':studentName'    =>  $_POST["studentName"],
                    ':password'    =>  $_POST["password"],
                    ':classId'    =>  $_POST["classId"],
                    ':phone'    =>  $_POST["phone"],
                    ':email'    =>  $_POST["email"],
                    ':image'        =>  $image
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
                "UPDATE Student 
                SET studentId = :studentId, studentName = :studentName, 
                password = :password, image = :image, classId = :classId, 
                phone = :phone, email = :email WHERE id = :id"
            );
            $result = $statement->execute(
                array(
                    ':studentId'   =>  $_POST["studentId"],
                    ':studentName'    =>  $_POST["studentName"],
                    ':password'    =>  $_POST["password"],
                    ':classId'    =>  $_POST["classId"],
                    ':phone'    =>  $_POST["phone"],
                    ':email'    =>  $_POST["email"],
                    ':image'        =>  $image,
                    ':id'           =>  $_POST["user_id"]
                )
            );
            if(!empty($result))
            {
                echo 'Data Updated';
            }
        }
    }
?>