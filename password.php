<?php

include"init.php";
if (!isset($_SESSION['role'])){
    header("location: index.php");

}
$error = '';	
if (isset($_POST['update'])) {
  $OldPassword = mysqli_real_escape_string($con, $_POST['OPassword']);
  $NewPassword = mysqli_real_escape_string($con, $_POST['NPassword']);
  $ConPassword = mysqli_real_escape_string($con, $_POST['CPassword']);
  $id = $_SESSION['user_id'];
  if (!empty($OldPassword) || !empty($NewPassword) || !empty($ConPassword)) {
  	$select = mysqli_query($con, "SELECT * FROM users WHERE id = $id");
  	$row = mysqli_fetch_assoc($select);
  	$dbPass = $row['password'];

  	if (password_verify($OldPassword, $dbPass)) {
  		if($NewPassword == $ConPassword){
  			$Npass = password_hash($NewPassword, PASSWORD_DEFAULT);
  			$update = mysqli_query($con, "UPDATE `users` SET `password` = '$Npass' WHERE `users`.`id` = $id");
  			if ($update) {
  				echo "<script>alert('Password changed')</script>";
  				session_destroy();
               header("location: index.php");
  			}

  		}else{
  			$error = "Two Password don't match";	
  		}
  		
  	}else{
  	$error = "Your Password not found! try again";	
  	}
  }else{
  	$error = "please fill the fields";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png" type="image/png">
    <title>School</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-6">
                <div class="bg-secondary p-3 text-center">
                    <h5>PAGE THAT ALLOWS USER TO MODIFY PASSWORD</h5>
                </div>
                <div class="text-center mt-3">
                    <h3><?php echo $error;?></h3>
                </div>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <fieldset>
                    <legend class="text-center">Update password</legend>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="OPassword" class="form-label">Old Password</label>
                            <input type="text" name="OPassword" id="OPassword" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="NPassword" class="form-label">New Password</label>
                            <input type="text" name="NPassword" id="NPassword" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="CPassword" class="form-label">Confirm Password</label>
                            <input type="text" name="CPassword" id="CPassword" class="form-control">
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" name="update" class="btn btn-success">Change</button>
                            <a href="back.php" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</body>
</html>
