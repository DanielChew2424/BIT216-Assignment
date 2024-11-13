<?php
    include 'php/dbConnect.php';
    session_start();
    if(!isset($_SESSION['email'])){
        header ("Location: login.php");
    }
    global $dbConnection;
    $email = $_SESSION['email'];
    $sql = "SELECT communityID FROM users WHERE email = '$email'";
    $result = mysqli_query($dbConnection,$sql);
    $row = mysqli_fetch_assoc($result);
    $comID = $row['communityID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/font-awesome/all.min.css" />
  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
  <link href="css/theme.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/custom.css" />
</head>
<body>
    <header class="header default bg-dark">
        <div class="container">
            <nav class="navbar navbar-static-top navbar-expand-lg">
                <div class="container-fluid my-3">
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                        data-bs-target=".navbar-collapse"><i class="fas fa-align-left"></i></button>
                    <a class="navbar-brand" href="admin_dashboard.php">CWCL</a>

                    <div class="d-none d-sm-flex ms-auto me-5 me-lg-0 pe-4 pe-lg-0">
                        <ul class="nav ms-1 ms-lg-2 align-self-center">
                            <li class="user_info nav-item pe-4 ">
                                <a class="fw-bold text-white" href="edit_profile.php">
                                    <?php
                                    echo "$email";
                                    ?>
                                </a>
                            </li>
                            <li class="sign_out nav-item pe-4 ">
                                <a class="fw-bold" href="php/functions.php?op=signout"><i class="fas fa-sign-out-alt pe-2"></i>Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <section class="py-5">
        <div class="container">
            <h1 class='my-3 text-center'>Welcome to CWCL Admin Dashboard</h1>

            <?php
                $sql2 = "SELECT * FROM communities WHERE communityID = $comID";
                $result2 = mysqli_query($dbConnection,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo "
                <h3 class='my-5 text-center'>Community Name: {$row2['communityName']}</h3>";
            ?>
            <div class="row justify-content-center text-center">
                <div class="dashboard col-3 p-3 mx-3">
                    <a class="text-decoration-none" href="admin_schedule.php">
                        <i class="fas fa-calendar-alt my-2" style="font-size:50px;"></i>
                        <h5 class="my-4">Schedule Pickup Time</h5>
                    </a>
                </div>
            </div>
    </section>
    <footer>
        <p>&copy; 2024 CWCL. All rights reserved.</p>
    </footer>
</body>
</html>