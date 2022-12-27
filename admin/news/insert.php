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
                INSERT INTO News (subTitle, detail, image) 
                VALUES (:subTitle, :detail, :image)
            ");
            $result = $statement->execute(
                array(
                    ':subTitle'   =>  $_POST["subTitle"],
                    ':detail'    =>  $_POST["detail"],
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
                "UPDATE News 
                SET subTitle = :subTitle, detail = :detail, image = :image  
                WHERE id = :id
                "
            );
            $result = $statement->execute(
                array(
                    ':subTitle'   =>  $_POST["subTitle"],
                    ':detail'    =>  $_POST["detail"],
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