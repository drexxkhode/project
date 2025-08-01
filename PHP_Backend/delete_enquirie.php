<?php
session_start();
include 'handler/alert-handler.php';
if(isset($_POST['delete'])){
    $id=$_POST['delete_id'];
require_once 'db.php';
$query = "DELETE FROM enquiries WHERE id=?";
$stmt= mysqli_prepare($con,$query);
mysqli_stmt_bind_param($stmt, 'i', $id);
if(mysqli_stmt_execute($stmt)){
    setAlert('success','Deletion', 'Record delected permanently', 3000, false);
    header("Location: user_enquiries.php");
    exit;
}else{
setAlert('error','Deletion', 'Error delecting record', 3000, false);
    header("Location: user_enquiries.php");
    exit;
}
}
?>