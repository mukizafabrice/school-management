<?php
include 'init.php';

// Redirect to index.php if user is not logged in
if (!isset($_SESSION['user_id'])) {
    session_destroy();
    header("location: index.php");
    exit(); // Add exit after header redirect to stop script execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>School</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="container-fluid header py-3 fixed-top z-0 position-fixed bg-light">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <?php echo "<h3>Welcome ".$_SESSION['username']."</h3>"; ?>
                </div>
                <div class="col-auto">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="director.php" class="text-decoration-none">View Attendance</a></li>
                        <li class="list-inline-item"><a href="confirm.php" class="text-decoration-none">Confirm Attendance</a></li>
                        <li class="list-inline-item"><a href="password.php" class="text-decoration-none">Change Password</a></li>
                        <li class="list-inline-item"><a href="logout.php" class="text-decoration-none" style="color: tomato;">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="container mt-5">
            <h2 class="mb-4 text-center py-5">Attendance Table</h2>
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
                        // Pagination logic
                        $results_per_page = 12; // Number of results per page
                        $query = "SELECT * FROM attendance";
                        $result = mysqli_query($con, $query);
                        $number_of_results = mysqli_num_rows($result);

                        // Determine number of pages
                        $number_of_pages = ceil($number_of_results / $results_per_page);

                        // Determine which page number visitor is currently on
                        if (!isset($_GET['page'])) {
                            $page = 1;
                        } else {
                            $page = $_GET['page'];
                        }

                        $this_page_first_result = ($page - 1) * $results_per_page;

                        $query = "SELECT * FROM attendance WHERE type = 'true' LIMIT $this_page_first_result, $results_per_page";
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
           
    

    <!-- Pagination -->
    <!-- <nav aria-label="Page navigation example"> -->
        <ul class="pagination justify-content-center  mb-5">
            <?php
            // Display pagination links
            for ($page = 1; $page <= $number_of_pages; $page++) {
                echo "<li class='page-item'><a class='page-link' href='?page=" . $page . "'>" . $page . "</a></li>";
            }
            ?>
        </ul>
    <!-- </nav> -->
     </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

