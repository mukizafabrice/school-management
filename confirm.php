<?php
include 'init.php';
if (!isset($_SESSION['user_id'])){
    session_destroy();
    header("location: index.php");
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
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   
    <div class="container">
    <div class="container-fluid header h-200  py-3 fixed-top z-0 position-fixed bg-light">
    <div class="row justify-content-between align-items-center">
        <div class="col">
            <?php echo "<h3>Welcome ".$_SESSION['username']."</h3>"; ?>
        </div>
        <div class="col-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item"><a href="director.php" class="text-decoration-none">View Attendance</a></li>
                <li class="list-inline-item"><a href="confirm.php" class="">Confirm Attendance</a></li>
                <li class="list-inline-item"><a href="password.php" class="text-decoration-none">Change Password</a></li>
                <li class="list-inline-item"><a href="logout.php" class="text-decoration-none" style="color: tomato;">Logout</a></li>
            </ul>
        </div>
    </div>
</div>


        <div class="container mt-5">
        <div class="text-center">
        <h2 class="mb-4 text-center py-5">Attendance list that needs confirmation</h2>
        <div>
        <?php
        $buttons = mysqli_query($con, "SELECT * FROM attendance  WHERE type = 'false'");
        if (mysqli_num_rows($buttons) > 0) {
          ?>
          <button type="button" class="btn btn-primary btn-sm"><a href="module.php" class="nav-link">Click to Confirm PHP</a></button>
          <button type="button" class="btn btn-primary btn-sm"><a href="module1.php" class="nav-link">Click to Confirm JAVA</a></button>
          <button type="button" class="btn btn-primary btn-sm"><a href="module2.php" class="nav-link">Click to Confirm BUSINESS</a></button>

         <?php 
        }else{
          echo "<p>There is no unconfirmed Attendance found</p>";
        }

        ?>
        
        </div>
    </div>
 
  <div class="wrap">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Firstname</th>
          <th scope="col">Lastname</th>
          <th scope="col">Module</th>
          <th scope="col">Marks</th>
        </tr>
      </thead>
      <tbody>
        <?php
      
        $results_per_page = 12; 
        $query = "SELECT * FROM attendance";
        $result = mysqli_query($con, $query);
        $number_of_results = mysqli_num_rows($result);

  
        $number_of_pages = ceil($number_of_results / $results_per_page);

        
        if (!isset($_GET['page'])) {
          $page = 1;
        } else {
          $page = $_GET['page'];
        }

        
        $this_page_first_result = ($page - 1) * $results_per_page;

        
        $query = "SELECT * FROM attendance  WHERE type = 'false' LIMIT $this_page_first_result, $results_per_page";
        $result = mysqli_query($con, $query);

       
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['FirstName'] . "</td>";
          echo "<td>" . $row['LastName'] . "</td>";
          echo "<td>" . $row['module'] . "</td>";
          echo "<td>" . $row['TotalHours'] . "%</td>"; 
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>


  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <?php
      // Display pagination links
      for ($page = 1; $page <= $number_of_pages; $page++) {
        echo "<li class='page-item'><a class='page-link ' href='?page=" . $page . "'>" . $page . "</a></li>";
      }
      ?>
    </ul>
  </nav>
</div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>