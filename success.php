<?php
<<<<<<< Updated upstream
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }
?>

=======
    include 'php/dbConnect.php';
    session_start();
    if(!isset($_SESSION['email'])){
        header ("Location: login.php");
    }
?>


>>>>>>> Stashed changes
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
            <div class="col-12 text-center">
                <h1 class="mt-5">Pickup Scheduled Successfully!</h1>
                <p class="lead">Your waste pickup has been scheduled for the selected date and time.</p>
                <a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
