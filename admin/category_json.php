<?php

    require './config/db.php';
    if($_GET["data"] == "get_category"){
        $sql = "select * from Category";
        $result = $conn->prepare($sql);
		$result->execute();
        $category = [];
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['id'], $row['categoryName'],$row['create_date']);
        }
        echo json_encode($category);
    }
    //add
    if($_GET['data'] == 'add_category'){
            $name = $_POST['txtName'];

            $sql = "Insert into Category (categoryName) values (:categoryName);";
            $insert = $conn->prepare($sql);
            $insert->bindParam(':categoryName', $name);

            if($insert->execute()){
                echo json_encode("Insert Success");
            }else{
                echo json_encode("Insert Faild");
            }
    }

    //get_byID
    if($_GET['data'] == 'get_byid'){
        $result = $conn->prepare("select * from Category where id=:id");
        $result->bindParam(':id', $_GET['id']);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['id'], $row['categoryName'],$row['create_date']);
        }
        echo json_encode($category);
    }

    //update
    if($_GET['data'] == 'update_category'){

        if(empty($_POST['txtName'])){
            echo json_encode("Please cheack the empty field!");
        }else{

            $id = $_GET['id'];
            $name = $_POST['txtName'];

            $sql = "Update Category set categoryName=:categoryName where id=:id;";
            $update = $conn->prepare($sql);

            $update->bindParam(':categoryName', $name);
            $update->bindParam(':id', $id);
            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
            }
        }    
    }

    //delete
    if($_GET['data'] == 'delete_category'){
        $id = $_GET['id'];
        $delete = $conn->prepare("DELETE FROM Category WHERE id=:id;");
        $delete->bindParam(':id', $id);
        if($delete->execute()){
            echo json_encode("Delete Success");
        }else{
            echo json_encode("Delete Faild");
        }
    }
?>