<?php
    error_reporting(0);

    require './config/db.php';
    if($_GET["data"] == "get_borrow"){
        $sql = "SELECT * FROM vborrow";
        $result = $conn->prepare($sql);
        $result->execute();
        $borrow = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){

            if($row['status'] == 0){
                $borrow[] = array($row['id'], $row['bookTitle'], 
                $row['studentName'], $row['borrowDate'], $row['returnDate'],
                $status = "<span style='color: white;' class='badge bg-red'>Pending</span>", $row['remark'], $row['create_date']);
            }
        }
        echo json_encode($borrow);
    }
    //pending
    if($_GET["data"] == "get_pending"){
        $sql = "SELECT * FROM vborrow";
        $result = $conn->prepare($sql);
        $result->execute();
        $borrow = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){

            if($row['status'] == 0){
                $borrow[] = array($row['id'], $row['bookTitle'], 
                $row['studentName'], $row['borrowDate'], $row['returnDate'],
                $status = "<span style='color: white;' class='badge bg-red'>Pending</span>", $row['remark'], $row['create_date']);
            }
        }
        echo json_encode($borrow);
    }

      //returned
      if($_GET["data"] == "get_returned"){
        $sql = "SELECT * FROM vborrow";
        $result = $conn->prepare($sql);
        $result->execute();
        $borrow = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){

            if($row['status'] == 1){
                $borrow[] = array($row['id'], $row['bookTitle'], 
                $row['studentName'], $row['borrowDate'], $row['returnDate'],
                $status = "<span style='color: white;' class='badge bg-purple'>Returned</span>", $row['remark'], $row['create_date']);
            }
        }
        echo json_encode($borrow);
    }

    //get book
    if($_GET['data'] == "get_book"){
        $sql = "SELECT * FROM Book";
        $result = $conn->prepare($sql);
        $result->execute();
        $book = [];

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            if($row['status'] == 0){
                $status = $row['status'];
                $book[] = array($row['id'],
                    $row['bookTitle'],$row['author'],$row['categoryId'], 
                    $row['image'],$status, $row['create_date']);
            }
            
        }
        echo json_encode($book);
    }

    //get student
    if($_GET['data'] == "get_student"){
        $sql = "SELECT * FROM Student";
        $result = $conn->prepare($sql);
        $result->execute();
        $student = [];

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            $student[] = array($row['id'], $row['studentId'], 
            $row['studentName'], $row['password'],$row['image'],
            $row['classId'],$row['phone'],$row['email'], $row['create_date']);
        }
        echo json_encode($student);
    }
 
//--------------------------------------------------------------------------//

    //add student
    if($_GET['data'] == 'add_borrow'){
        
        $bookId = $_POST['ddlBook'];
        $studentId = $_POST['ddlStudent'];
        $borrowDate = $_POST['txtBorrowDate'];
        $returnDate = $_POST['txtReturnDate'];
        $remark = $_POST['txtRemark'];

        $sql = "INSERT INTO Borrow (bookId, studentId, borrowDate, returnDate, remark)
         values (:bookId, :studentId, :borrowDate, :returnDate, :remark);";
        $insert = $conn->prepare($sql);
        $insert->bindParam(':bookId', $bookId);
        $insert->bindParam(':studentId', $studentId);
        $insert->bindParam(':borrowDate', $borrowDate);
        $insert->bindParam(':returnDate', $returnDate);
        $insert->bindParam(':remark', $remark);

        if($insert->execute()){
            echo json_encode("Insert Success");
        }else{
            echo json_encode("Insert Faild");
        }
    }
            

    //get_byid
    if($_GET['data'] == 'get_byid'){
        $result = $conn->prepare("SELECT * FROM Borrow WHERE id=:id");
        $result->bindParam(':id', $_GET['id']);
        $result->execute();

        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            $borrow[] = array($row['id'], $row['bookId'], 
            $row['studentId'],  $row['borrowDate'],$row['returnDate'],
            $row['status'],$row['remark'],$row['create_date']);
        }
        echo json_encode($borrow);
    }

    //update
    if($_GET['data'] == 'update_borrow'){
        
            $id = $_GET['id'];
            $bookId = $_POST['ddlBook'];
            $studentId = $_POST['ddlStudent'];
            $borrowDate = $_POST['txtBorrowDate'];
            $returnDate = $_POST['txtReturnDate'];
            $remark = $_POST['txtRemark'];

            $sql = "UPDATE Borrow set bookId=:bookId, studentId=:studentId,
                    borrowDate=:borrowDate, returnDate=:returnDate, remark=:remark where id=:id;";
            $update = $conn->prepare($sql);

            $update->bindParam(':bookId', $bookId);
            $update->bindParam(':studentId', $studentId);
            $update->bindParam(':borrowDate', $borrowDate);
            $update->bindParam(':returnDate', $returnDate);
            $update->bindParam(':remark', $remark);
            $update->bindParam(':id', $id);

            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
            }
        }

    //delete
    if($_GET['data'] == 'delete_borrow'){
        $borrow_id = $_GET['id'];
        $delete = $conn->prepare("DELETE FROM Borrow where id=:id;");
        $delete->bindParam(':id', $borrow_id);
        if($delete->execute()){
            echo json_encode("Delete Success");
        }else{
            echo json_encode("Delete Faild");
        }
    }

      //return 
    if($_GET['data'] == 'return_borrow'){
        
        $id = $_GET['id'];
        $status = 1;
        $sql = "UPDATE Borrow set status=:status where id=:id;";
        $update = $conn->prepare($sql);

        $update->bindParam(':status', $status);
        $update->bindParam(':id', $id);

        if($update->execute()){
            echo json_encode("Return Success");
        }else{
            echo json_encode("Return Faild");
        }
    }
?>