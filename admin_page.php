<?php
    include 'php/dbConnect.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header ("Location: login.php");
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .dashboard {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
    </style>
</head>

<body>
    <header class="header default">
        <nav class="navbar bg-white navbar-static-top navbar-expand-lg">
            <div class="container-fluid">
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                    data-bs-target=".navbar-collapse"><i class="fas fa-align-left"></i></button>
                <a class="navbar-brand" href="admin_page.php">
                    <img src="images/logo.svg" style="width:200px;height:75px;">
                </a>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="admin_page.php">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="feedback.php">View Feedback</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="manage_account.php">Manage Account</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="merchant_request.php">Merchant Request</a>
                        </li>
                    </ul>
                </div>
                <div class="d-none d-sm-flex ms-auto me-5 me-lg-0 pe-4 pe-lg-0">
                    <ul class="nav ms-1 ms-lg-2 align-self-center">
                        <li class="sign_out nav-item pe-4 ">
                        <a class="fw-bold" href="php/functions.php?op=signout"><i class="fas fa-sign-out-alt pe-2"></i>Sign out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section class="py-5">
        <div class="container">
            <?php
                echo "<h2>Welcome " . $_SESSION['username'] . "</h2>";
                
            ?>

            <div class="row">
                <div class="dashboard col-3 py-3 mx-3">
                    <h5>View Feedback</h5>
                    <?php
                        global $dbConnection;
                        $sql = "SELECT * FROM feedback";
                        $result = mysqli_query($dbConnection,$sql);
                        $rowCount = mysqli_num_rows($result);
                        echo "<p>{$rowCount}</p>";
                    ?>
                </div>
                <div class="dashboard col-3 py-3 mx-3">
                    <h5>Manage Account</h5>
                    <?php
                        global $dbConnection;
                        $sql = "SELECT * FROM user";
                        $result = mysqli_query($dbConnection,$sql);
                        $rowCount = mysqli_num_rows($result);
                        echo "<p>{$rowCount}</p>";
                    ?>
                </div>
                <div class="dashboard col-3 py-3 mx-3">
                    <h5>Mercahnt Request</h5>
                    <?php
                        $sql = "SELECT * FROM request WHERE Status='PENDING'";
                        $result = mysqli_query($dbConnection,$sql);
                        $rowCount = mysqli_num_rows($result);
                        echo "<p>{$rowCount}</p>";
                    ?>
                </div>

            </div>
    </section>
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>

</html>