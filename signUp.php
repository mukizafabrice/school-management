<?php
include 'init.php';
$sms = '';
if (isset($_POST['register'])) {
    $fName = mysqli_real_escape_string($con, $_POST['fName']);
    $lName = mysqli_real_escape_string($con, $_POST['lName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cPassword = mysqli_real_escape_string($con, $_POST['cPassword']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    $select = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' ");
    if (mysqli_num_rows($select) > 0) {
        $sms = 'Email is already exists, please try other one';
    } else {

        if (strlen($password) > 8) {
            
        
        if ($password == $cPassword) {
            $hPassword = password_hash($password, PASSWORD_BCRYPT);

            $query = mysqli_query($con, "INSERT INTO `users` (`id`, `FirstName`, `LastName`, `email`, `password`, `role`)
            VALUES (NULL, '$fName', '$lName', '$email', '$hPassword', '$role')");
            if($query){
                $_SESSION['email'] = $email;
                if($role == 'student'){
                    header("location: reg.php");
                }
                elseif ($role == 'trainer') {
                    header("location: pro.php");
                }
                else{
               header("location:dire.php");
            }
            }
        } else {
            $sms = "Passwords do not match";
        }
    }else{
        $sms = "Passwords must contain atleast 8 characters";
    }
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
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>School</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow rounded-lg p-4">
                    <h2 class="text-center mb-4">Registration Form</h2>
                    <form action="" method="post">
                        <div class="mb-3">
                            <p class="text-danger"><?= $sms; ?></p>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="fName" placeholder="Enter Your First Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="lName" placeholder="Enter Your Last Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Enter Your Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder=" Enter Your Password" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="cPassword" placeholder="Confirm Your Password" required>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="role" required>
                                <option value="">Choose your role</option>
                                <option value="student">Student</option>
                                <option value="trainer">Trainer</option>
                                <option value="director">Director</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100" name="register">Register</button>
                        </div>
                        <div class="mb-3 text-right">
                            <p>Already a user? <a href="index.php">Sign In</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
