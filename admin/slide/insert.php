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
                INSERT INTO Slide (title, subTitle, image) 
                VALUES (:title, :subTitle, :image)
            ");
            $result = $statement->execute(
                array(
                    ':title'   =>  $_POST["title"],
                    ':subTitle'    =>  $_POST["subTitle"],
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
                "UPDATE Slide 
                SET title = :title, subTitle = :subTitle, image = :image  
                WHERE id = :id
                "
            );
            $result = $statement->execute(
                array(
                    ':title'   =>  $_POST["title"],
                    ':subTitle'    =>  $_POST["subTitle"],
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