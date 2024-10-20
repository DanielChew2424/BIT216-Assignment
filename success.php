<?php
<<<<<<< HEAD
=======
<<<<<<< Updated upstream
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }
?>

=======
>>>>>>> deba883b65849c9c8474a02205d85ed37aefcfcd
    include 'php/dbConnect.php';
    session_start();
    if(!isset($_SESSION['email'])){
        header ("Location: login.php");
    }
?>


<<<<<<< HEAD
=======
>>>>>>> Stashed changes
>>>>>>> deba883b65849c9c8474a02205d85ed37aefcfcd
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Success</title>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
    <link href="css/theme.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="row">
<<<<<<< HEAD
            <div class="col-12 text-center align-items-center">
=======
            <div class="col-12 text-center">
>>>>>>> deba883b65849c9c8474a02205d85ed37aefcfcd
                <h1 class="mt-5">Pickup Scheduled Successfully!</h1>
                <p class="lead">Your waste pickup has been scheduled for the selected date and time.</p>
                <a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
