<?php
if(isset($_POST['delete'])){
    $id=$_POST['delete_id'];
require_once 'db.php';
$query = "DELETE FROM replies WHERE id=?";
$stmt= mysqli_prepare($con,$query);
mysqli_stmt_bind_param($stmt, 'i', $id);
if(mysqli_stmt_execute($stmt)){
    header("Location: replied_msgs.php");
}else{
    echo "Error deleting Record.";
}
}
?>