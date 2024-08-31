<?php
include 'init.php';
if (!isset($_SESSION['email'])){
    header("location: index.php");
}else{
    $email = $_SESSION['email'];
}
if(isset($_POST['update'])){
    $_SESSION['email'] = $email;
    $sel = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
    if(mysqli_num_rows($sel) > 0){
        $row = mysqli_fetch_assoc($sel);
        $id = $row['id'];
    $query = mysqli_query($con, "UPDATE `users` SET `regNumber` = 'DIRECTOR' WHERE `users`.`id` = $id");
    if($query){
        session_destroy();
        header("location: index.php");
    }
}
}
?>

