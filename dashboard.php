<?php
    include 'php/dbConnect.php';
    session_start();
    if(!isset($_SESSION['email'])){
        header ("Location: login.php");
    }
    global $dbConnection;
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
    <link href="css/theme.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <header class="header default bg-dark">
        <div class="container">
            <nav class="navbar navbar-static-top navbar-expand-lg">
                <div class="container-fluid my-3">
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                        data-bs-target=".navbar-collapse"><i class="fas fa-align-left"></i></button>
                    <a class="navbar-brand" href="dashboard.php">CWCL</a>
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
                                <a class="fw-bold" href="php/functions.php?op=signout"><i
                                        class="fas fa-sign-out-alt pe-2"></i>Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    
    <section class="py-5">
        <div class="container">
            <h1 class="my-3 text-center">Dashboard</h1>
            <div class="row justify-content-center text-center my-5">
                <div class="dashboard col-lg-3 col-md-4 col-sm-6 p-4 mx-3">
                    <a class="text-decoration-none" href="schedule_pickup.php">
                        <i class="fas fa-calendar-alt my-2" style="font-size:50px;"></i>
                        <h5 class="my-4">Schedule Pickup</h5>
                    </a>
                </div>
                <div class="dashboard col-lg-3 col-md-4 col-sm-6 p-4 mx-3">
                    <a class="text-decoration-none" href="pickup_history.php">
                        <i class="fas fa-history my-2" style="font-size:50px;"></i>
                        <h5 class="my-4">Pickup History</h5>
                    </a>
                </div>
                <div class="dashboard col-lg-3 col-md-4 col-sm-6 p-4 mx-3">
                    <a class="text-decoration-none" href="report_issue.html">
                        <i class="fas fa-exclamation-circle my-2" style="font-size:50px;"></i>
                        <h5 class="my-4">Report Issue</h5>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center text-center my-5">
                <div class="dashboard col-lg-3 col-md-4 col-sm-6 p-4 mx-3">
                        <a class="text-decoration-none" href="generate_report.html">
                            <i class="fas fa-exclamation-circle my-2" style="font-size:50px;"></i>
                            <h5 class="my-4">Generate Report</h5>
                        </a>
                    </div>
            </div>
        </div>
    </section>
    
    <footer>
        <p>&copy; 2024 CWCL. All rights reserved.</p>
    </footer>
    
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>

</html>
                    