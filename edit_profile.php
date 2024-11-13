<?php
include 'php/dbConnect.php';
session_start();
if(!isset($_SESSION['email'])){
    header ("Location: login.php");
}

global $dbConnection;
$email = $_SESSION['email'];
$sql = "SELECT communityID FROM users WHERE email = '$email'";
$result = mysqli_query($dbConnection, $sql);
$row = mysqli_fetch_assoc($result);
$comID = $row['communityID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    $fullname = $_POST['fullname'];
    $newEmail = $_POST['email'];
    $address = $_POST['address'];
    $contactNumber = $_POST['contactNumber'];
    
    $sql = "UPDATE users SET fullname = ?, email = ?, address = ?, contactNumber = ? WHERE email = ?";
    $stmt = $dbConnection->prepare($sql);
    $stmt->bind_param("sssss", $fullname, $newEmail, $address, $contactNumber, $email);
    
    if ($stmt->execute()) {
        $_SESSION['email'] = $newEmail;
        echo "<script>alert('Edit Successfully!');</script>";
    } else {
        echo "Error updating profile.";
    }
}   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Account</title>
    <link rel="stylesheet" href="css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
    <link href="css/theme.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/custom.css">
    <style>
        .modal {
            z-index: 1060 !important;
        }
        .modal-backdrop {
            z-index: 1055 !important;
        }
    </style>
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

    <div class="page-wrapper">
        <section class="py-5">
            <div class="container">
                <h1 class="my-3 text-center">Personal Details</h1>
            </div>
        </section>
<section class="py-5">
        <div class="container">
            <div class="card mx-auto" style="max-width: 600px;">
                <div class="card-body">
                    <p><strong>Fullname:</strong> 
                    <?php 
                        $sql = "SELECT fullname FROM users WHERE email = '$email'";
                        $result = mysqli_query($dbConnection, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $fullname = $row['fullname'];
                        echo "$fullname";
                    ?>
                    </p>
                    <p><strong>Email:</strong> 
                    <?php 
                        echo "$email";
                    ?>
                    </p>
                    <p><strong>Community Name:</strong>
                    <?php 
                        $sql2 = "SELECT communityName FROM communities WHERE communityID = $comID";
                        $result2 = mysqli_query($dbConnection,$sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                        $communityName = $row2['communityName'];
                        echo "$communityName";
                    ?>
                    </p>
                    <p><strong>Address:</strong>
                    <?php 
                        $sql = "SELECT address FROM users WHERE email = '$email'";
                        $result = mysqli_query($dbConnection, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $address = $row['address'];
                        echo "$address";
                    ?>
                    </p>
                    <p><strong>Contact Number:</strong>
                    <?php 
                        $sql = "SELECT contactNumber FROM users WHERE email = '$email'";
                        $result = mysqli_query($dbConnection, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $contactNumber = $row['contactNumber'];
                        echo "$contactNumber";
                    ?>
                    </p>
                </div>
            </div>
            <div class="text-center my-5">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
            </div>
            
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Fullname</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $fullname; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contactNumber" name="contactNumber" value="<?php echo $contactNumber; ?>" required>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    

    <footer>
        <p>&copy; 2024 CWCL. All rights reserved.</p>
    </footer>

    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>
</html>
