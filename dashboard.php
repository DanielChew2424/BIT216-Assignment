<?php
    include 'php/dbConnect.php';
    session_start();
<<<<<<< HEAD
    if(!isset($_SESSION['email'])){
        header ("Location: login.php");
    }
=======
    // if(!isset($_SESSION['username'])){
    //     header ("Location: login.php");
    // }
>>>>>>> c9148a75ad5725725d4f23cd812dbdb9ddc9e60a
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
<<<<<<< HEAD
=======
    <!-- <link rel="stylesheet" href="css/style.css" /> -->
>>>>>>> c9148a75ad5725725d4f23cd812dbdb9ddc9e60a
    <style>
        .dashboard {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
<<<<<<< HEAD
        
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

=======
>>>>>>> c9148a75ad5725725d4f23cd812dbdb9ddc9e60a
    </style>
</head>

<body>
    <header class="header default bg-dark">
        <div class="container">
            <nav class="navbar navbar-static-top navbar-expand-lg">
                <div class="container-fluid  my-3">
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                        data-bs-target=".navbar-collapse"><i class="fas fa-align-left"></i></button>
                    <a class="navbar-brand" href="dashboard.php">
                        CWCL
                    </a>

                    <div class="d-none d-sm-flex ms-auto me-5 me-lg-0 pe-4 pe-lg-0">
                        <ul class="nav ms-1 ms-lg-2 align-self-center">
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
            <div class="row">
                <div class="dashboard col-3 p-3 mx-3">
                    <a class="text-decoration-none" href="schedule_pickup.php">
                        <h5>Schedule Pickup</h5>
                    </a>
                </div>
                <div href="" class="dashboard col-3 p-3 mx-3">
                    <a class="text-decoration-none" href="schedule_pickup.php">
                        <h5>Pickup History</h5>
                    </a>
                </div>
                <div href="" class="dashboard col-3 p-3 mx-3">
                    <a class="text-decoration-none" href="schedule_pickup.php">
                        <h5>Report Issue</h5>
                    </a>
                </div>
            </div>
    </section>
<<<<<<< HEAD
    <footer>
        <p>&copy; 2024 CWCL. All rights reserved.</p>
    </footer>
=======
>>>>>>> c9148a75ad5725725d4f23cd812dbdb9ddc9e60a
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>

</html>