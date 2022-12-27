<?php
require '../config/db.php';
if(isset($_POST["user_id"]))
{
    $statement = $conn->prepare(
        "UPDATE Book SET status=:status WHERE id = :id"
    );
    $status = 1;
    $result = $statement->execute(
        array(
            ':status' => $status,
            ':id'   =>  $_POST["user_id"]
        )
    );
}
?>
