<?php
     require './config/db.php';
    //Available
    if($_GET["data"] == "get_available"){
        $sql = "SELECT * FROM vbooks";
        $result = $conn->prepare($sql);
        $result->execute();
        $book = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            if($row['status'] == 0){
                $book[] = array($row['id'], $row['bookTitle'], 
                $row['categoryName'],  $row['author'],$row['image'],
                $status = "<span style='color: white;' class='badge bg-purple'>Available</span>", $row['create_date']);
            }
           
        }
        echo json_encode($book);
    }
      //UnAvailable
      if($_GET["data"] == "get_unavailable"){
        $sql = "SELECT * FROM vbooks";
        $result = $conn->prepare($sql);
        $result->execute();
        $book = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            if($row['status'] == 1){
                $book[] = array($row['id'], $row['bookTitle'], 
                $row['categoryName'],  $row['author'],$row['image'],
                $status = "<span style='color: white;' class='badge bg-red'>Unavailable</span>", $row['create_date']);
            }
           
        }
        echo json_encode($book);
    }
?>