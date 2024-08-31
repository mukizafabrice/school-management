<?php
include 'init.php';
if (!isset($_SESSION['user_id'])){
    header("location: index.php");
}else{
    $user_id = $_SESSION['user_id'];
}

$select = mysqli_query($con, "SELECT * FROM users WHERE id = $user_id");
$userRow = mysqli_fetch_assoc($select);
$reg = $userRow['regNumber'];

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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
   
    <div class="container">
        <div class="header">
            <div class="welcome">
                <?= "<h3>Welcome ".$_SESSION['username']."</h3>";?>
            </div>
            <div class="items">
                <ul>
               
                    <li><a href="password.php">Change Password</a></li>
                    <li><a href="logout.php" style="color: tomato;">Logout</a></li>
                
                
                </ul>
            </div>
        </div>
        <div class="container mt-5">
            <h2 class="mb-4 text-center py-5">Attendance Table</h2>
            <div class="wrap">

        
           

                <?php 
                $id = 1;
                $query = mysqli_query($con, "SELECT * FROM attendance WHERE regNumber = '$reg'");
                if (mysqli_num_rows($query)){
                    while($row = mysqli_fetch_array($query)){
                        ?>
                         <table class="table">
                <tr>
                    <th>Id</th>
                    <th>Firstname</th>
                    <th>LastName</th>
                    <th>Module</th>
                    <th>Total Marks</th>
                </tr>
                        <tr>
                            <td><?= $id++;?></td>
                            <td><?= $row['FirstName'];?></td>
                            <td><?= $row['LastName'];?></td>
                            <td><?= $row['module'];?></td>
                            <td><?= $row['TotalHours']."%";?></td>
                        </tr>
                        </tr>
                        </table>
                        <?php
                    }
                }else{
                    echo "There is no Attendance uploaded";
                }
                ?>
            
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>