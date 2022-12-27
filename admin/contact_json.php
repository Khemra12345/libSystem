<?php

    require './config/db.php';
    if($_GET["data"] == "get_contact"){
        $sql = "select * from Contact";
        $result = $conn->prepare($sql);
		$result->execute();
        $contact = [];
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $contact[] = array($row['id'], $row['fullName'],$row['email'],$row['description'],$row['create_date']);
        }
        echo json_encode($contact);
    }
    //add
    if($_GET['data'] == 'add_contact'){
            $fullName = $_POST['txtFullname'];
            $email = $_POST['txtEmail'];
            $description = $_POST['txtDescription'];

            $sql = "Insert into Contact(fullName,email,description) values (:fullName,:email,:description);";
            $insert = $conn->prepare($sql);
            $insert->bindParam(':fullName', $fullName);
            $insert->bindParam(':email', $email);
            $insert->bindParam(':description', $description);

            if($insert->execute()){
                echo json_encode("Insert Success");
            }else{
                echo json_encode("Insert Faild");
            }
    }

    //get_byID
    if($_GET['data'] == 'get_byid'){
        $result = $conn->prepare("select * from Contact where id=:id");
        $result->bindParam(':id', $_GET['id']);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            $contact[] = array($row['id'], $row['fullName'],$row['email'],$row['description'],$row['create_date']);
        }
        echo json_encode($contact);
    }

    //update
    if($_GET['data'] == 'update_contact'){

            $id = $_GET['id'];
            $fullName = $_POST['txtFullname'];
            $email = $_POST['txtEmail'];
            $description = $_POST['txtDescription'];

            $sql = "Update Contact set fullName=:fullName,email=:email,description=:description where id=:id;";
            $update = $conn->prepare($sql);

            $update->bindParam(':fullName', $fullName);
            $update->bindParam(':email', $email);
            $update->bindParam(':description', $description);
            $update->bindParam(':id', $id);

            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
            }
        }    

    //delete
    if($_GET['data'] == 'delete_contact'){
        $id = $_GET['id'];
        $delete = $conn->prepare("DELETE FROM Contact WHERE id=:id;");
        $delete->bindParam(':id', $id);
        if($delete->execute()){
            echo json_encode("Delete Success");
        }else{
            echo json_encode("Delete Faild");
        }
    }
?>