<?php
include 'dbConnect.php';
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


// if($_GET['op'] == 'customerSignUp'){
//     $fname = $_POST['name'];
//     $lname = $_POST['surname'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $password = $_POST['password'];
//     $password2 = $_POST['confirmPassword'];
//     $gender = $_POST['gender'];
//     $role = "customer";
//     $sql = "SELECT Username FROM user";
//     $user = mysqli_query($dbConnection, $sql);
//     $found=false;
//     while($row = mysqli_fetch_assoc($user)){
//         if($row['Username'] == $email){
//             $found = true;
//         }
//     }
//     if($found){
//         echo "<script> alert('This email address is already registered. Please choose another email.');
//         location = '../signup.php';
//         </script>";
//     }
//     $requestFound = false;
//     $sql1 = "SELECT Email FROM request WHERE Status='PENDING'";
//     $requestQ = mysqli_query($dbConnection, $sql1);

//     while($request = mysqli_fetch_assoc($requestQ)){
//         if($request['Email'] == $email){
//             $requestFound = true;
//         }
//     }

//     if($requestFound){
//         echo "<script> alert('Your request is still pending.');
//         location = '../signup.php';
//         </script>";
//     }

//     if (!$requestFound && !$found){
//         $sql = "INSERT INTO user(Username,Password,Role)
//         VALUES ('$email','$password','$role')";
//         mysqli_query($dbConnection,$sql);
//         $UserID = mysqli_insert_id($dbConnection);
//         $sql2 = "INSERT INTO customer(FirstName,LastName,Email,Phone,Gender,UserID) 
//         VALUES ('$fname','$lname','$email','$phone','$gender','$UserID')";
//         mysqli_query($dbConnection,$sql2);
        
//         echo "<script> alert('Registration successful. You can now login to your account.');
//         location = '../login.php';
//         </script>";
//     }
// }

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
                    header("Location: ../admin_page.php");
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

if($_GET['op'] == 'forgetPass'){
    $email = $_POST['email'];

    $sql = "SELECT Username FROM user";
    $userQ = mysqli_query($dbConnection, $sql);
    $emailFound = false;
    while($user = mysqli_fetch_assoc($userQ)){
        if($email == $user['Username']){
            $emailFound = true;
        }
    }

    if($emailFound){
    
        $mail = new PHPMailer(true);
    
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'localxplorerphp@gmail.com';
        $mail->Password = 'oxrn owtv pkgy yzim';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
    
        $mail->setFrom('localxplorerphp@gmail.com');
        $mail->addAddress($email);
    
        $mail->isHTML(true);
        
        $mail->Subject = 'Reset Password';
        $mail->Body = "Click the link below to reset your password<br>
        http://localhost/DIP224%20ASSIGNMENT/reset_password.php?token=$email";
    
        $mail->send();
    
        echo "<script>alert('Please check your email to reset your password.');</script>";
        
    }
    else{
        echo "<script>alert('Invalid email please try again.');
        location = '../forget_password.php';</script>";
    }


}

if($_GET['op'] == 'resetPass'){
    $email = $_POST['token'];
    $pass = $_POST['password'];
    $sql = "UPDATE user SET Password = '$pass' WHERE Username = '$email'";
    mysqli_query($dbConnection,$sql);
    echo "<script>alert('Your password has been reset.');
        location = '../login.php';</script>";
}

if($_GET['op']=="firstLogin"){
    session_start();
    $email = $_SESSION['username'];
    $pass = $_POST['password'];
    $sql = "UPDATE user SET Password = '$pass' WHERE Username = '$email'";
    mysqli_query($dbConnection,$sql);
    echo "<script>alert('Your password has been reset.');
        location = '../login.php';</script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['op']) && $_GET['op'] == 'confirmBtn') {
    $pickupDate = $_POST['date'];
    $pickupTime = $_POST['time'];
    $wasteType = $_POST['wasteType'];
    $address = $_POST['address'];
    $email = $_SESSION['email'];

    // Fetch the user's address based on their email
    $query = "SELECT address FROM users WHERE email='$email'";
    $result = mysqli_query($dbConnection, $query);
    $user = mysqli_fetch_assoc($result);

    // Insert the data into pickuphistory, including the user's address and confirmationStatus
    $insertQuery = "INSERT INTO pickuphistory (address, pickupDate, pickupTime, wasteType, confirmationStatus) 
                    VALUES ('$pickupAddress', '$pickupDate', '$pickupTime', '$wasteType', 'Pending')";
                    
    if (mysqli_query($dbConnection, $insertQuery)) {
        header("Location:../success.php");
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

if($_GET['op'] == "deleteAllImages"){
    $id = $_GET['productID'];
    $sql = "DELETE FROM image WHERE ProductID = $id";
    mysqli_query($dbConnection,$sql);
    header("Location: ../merchant_edit.php?id=" . $id);
}
?>