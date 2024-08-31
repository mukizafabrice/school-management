<?php
include 'init.php';
$sms = '';
if (!isset($_SESSION['user_id'])){
    session_destroy();
    header("location: index.php");
}
if (isset($_POST['upload'])){
    $fileName=$_FILES["file"]["tmp_name"]; 
    
    if($_FILES["file"]["size"] > 0){

        $file = fopen($fileName, 'r');

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE){
            $sql = mysqli_query($con, "INSERT INTO attendance  VALUES (null,'". $column[0]. "','". $column[1]. "','". $column[2]. "', '". $column[3]. "','".$column[4]."', 'false')");
             if($sql){
                $sms= "records inserted!";
             }else{
                $sms= "records not inserted";
             }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   
    <div class="container">
        <div class="header py-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-0">Welcome <?php echo $_SESSION['username']; ?></h2>
                </div>
                <div class="col-md-6 text-end">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="password.php" class="text-decoration-none">Change Password</a></li>
                        <li class="list-inline-item"><a href="logout.php" class="text-decoration-none text-danger">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="wrap">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <h2 class="mb-4">Upload your excel file</h2>
                                <p><?= $sms; ?></p>
                                <div class="mb-3">
                                    <input type="file" name="file" id="" class="form-control" accept=".csv" required>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
