<?php
include 'dbConnect.php';
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
}

if($_GET['op'] == 'login'){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $role;
    $sql = "SELECT * FROM users";
    $userQ = mysqli_query($dbConnection, $sql);
    $emailFound = false;
    $passFound = false;
    while($user = mysqli_fetch_assoc($userQ)){
        if($email == $user['email']){
            $emailFound = true;
            if($pass == "12345"){
                session_start();
                $_SESSION['email'] = $user['email'];
                header("Location: ../first_login.php");
            }
            elseif($pass == $user['password']){
                $passFound = true;
                $role = $user['userRole'];
                session_start();
                $_SESSION['email'] = $user['email'];
                if(isset($_POST['remember'])){ 
                    setcookie('email',$email,time()+60 * 60 * 24 * 7, '/');
                    setcookie('pass',$pass,time()+60 * 60 * 24 * 7, '/');
                }
                else{
                    setcookie('email', '', time() - 3600, '/');
                    setcookie('pass', '', time() - 3600, '/');
                }
                if($role == "user"){
                    header("Location: ../dashboard.php");
                }
                elseif($role == "admin"){
                    header("Location: ../admin_dashboard.php");
                }
            }
        }
    }


    if(!$emailFound){
        echo "<script> alert('Invalid email.');
        location = '../login.php';
        </script>";
    }
    else{
        if(!$passFound){
        echo "<script> alert('Invalid password.');
        location = '../login.php';
        </script>";
        }
    }

}

    if ($_GET['op'] == 'addTimeSlot') {
        session_start();
        include 'dbConnect.php';
    
        $day = $_POST['day'];
        $time = $_POST['time'];
        $email = $_SESSION['email'];
    
        if (!$email) {
            echo "<script>alert('Session email not set. Please log in again.');
            location = '../login.php';</script>";
            exit;
        }
    
        $sql = "SELECT communityID FROM users WHERE email = '$email'";
        $result = mysqli_query($dbConnection, $sql);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $comID = $row['communityID'];
    
            if (!$comID) {
                echo "<script>alert('Error retrieving community ID. Please try again.');
                location = '../admin_schedule.php';</script>";
                exit;
            }
    
            $sql2 = "INSERT INTO schedule (scheduleDay, scheduleTime, communityID)
                     VALUES ('$day', '$time', '$comID')";
            
            if (mysqli_query($dbConnection, $sql2)) {
                echo "<script>alert('New time slot added.');
                location = '../admin_schedule.php';</script>";
            } else {
                echo "<script>alert('Error adding time slot. Please try again.');
                location = '../admin_schedule.php';</script>";
            }
        } else {
            echo "<script>alert('User not found or error in query. Please log in again.');
            location = '../login.php';</script>";
        }
    }
    
    if (isset($_GET['op'])) {
        include 'dbConnect.php';
        $operation = $_GET['op'];

        if ($operation == 'deleteTimeSlot' && isset($_POST['scheduleID'])) {
            $scheduleID = $_POST['scheduleID'];

            $sql = "DELETE FROM schedule WHERE scheduleID = '$scheduleID'";
            if (mysqli_query($dbConnection, $sql)) {
                echo "<script>alert('Time slot deleted successfully.');
                location = '../admin_schedule.php';</script>";
            } else {
                echo "Error deleting time slot: " . mysqli_error($dbConnection);
            }
        }
    }

    function getCommunityID($email) {
        global $dbConnection;
        $sql = "SELECT communityID FROM users WHERE email = '$email'";
        $result = mysqli_query($dbConnection, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['communityID'];
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['op']) && $_GET['op'] == 'confirmBtn') {

        $pickupDate = $_POST['date'];
        $pickupTime = $_POST['time'];
        $wasteType = $_POST['wasteType'];
        $email = $_SESSION['email'];
        $userID = $_POST['userID'];
        
        $query = "SELECT address FROM users WHERE email='$email'";
        $result = mysqli_query($dbConnection, $query);
        $user = mysqli_fetch_assoc($result);
        $pickupAddress = $user['address'];
        $pickupDate = date("Y-m-d", strtotime($_POST['date']));

        
        $insertQuery = "INSERT INTO pickuphistory (pickupDate, pickupTime, wasteType, confirmationStatus, userID) 
                        VALUES ('$pickupDate', '$pickupTime', '$wasteType', 'Pending', '$userID')";
        
        if (mysqli_query($dbConnection, $insertQuery)) {
            exit();
        } else {
            echo "Error: " . mysqli_error($dbConnection);
        }
    }
    
if($_GET['op'] == "signout"){
    session_start();
    session_destroy();
    header("Location: ../login.php");
}
?>