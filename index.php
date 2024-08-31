<?php
include 'init.php';
$sms = '';
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    $query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' and role = '$role'");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $id = $row['id'];
        $hPassword = $row['password'];
        $name = $row['FirstName'];
        if (password_verify($password, $hPassword)) {
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $name;
            $_SESSION['role'] = $role;
            header("location: home.php");
        } else {
            $sms = 'Invalid Password';
        }
    } else {
        $sms = "Email is not exists, pleaser try again";
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h2 class="text-center mb-4">login Form</h2>
                    <form action="" method="post">

                        <div class="mb-3">
                            <p><?= $sms; ?></p>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" name="email" placeholder="Enter Your Email" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Enter your Password" required>
                        </div>

                        <div class="mb-3">
                            <select class="form-select" name="role" id="role" required>
                                <option value="">Choose your role</option>
                                <option value="student">Student</option>
                                <option value="trainer">Trainer</option>
                                <option value="director">Director</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
                        </div>

                        <div class="mb-3 text-right">
                            <p>I'm not a user <a href="signUp.php">SignUp</a></p>
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
