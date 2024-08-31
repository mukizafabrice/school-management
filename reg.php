<?php
include 'init.php';
if (!isset($_SESSION['email'])){
    header("location: index.php");
}else{
    $email = $_SESSION['email'];
}
if(isset($_POST['update'])){
    $reg = $_POST['reg'];
    $upper = strtoupper($reg);
    $_SESSION['email'] = $email;
    $sel = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
    if(mysqli_num_rows($sel) > 0){
        $row = mysqli_fetch_assoc($sel);
        $id = $row['id'];
    $query = mysqli_query($con, "UPDATE `users` SET `regNumber` = '$upper' WHERE `users`.`id` = $id");
    if($query){
        session_destroy();
        header("location: index.php");
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
       <div class="container-sm">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow rounded-lg p-4">
                    <h2 class="text-center mb-4"> The student Registration Code </h2>
        <form action="" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" name="reg" id="reg" placeholder="Enter your Reg number" required>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Continue</button>
        </form>
    </div>
</div>
</div>
</div>
</body>
</html>

</html>
