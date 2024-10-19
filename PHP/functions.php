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

// if($_GET['op'] == 'login'){
//     $email = $_POST['name'];
//     $pass = $_POST['password'];
//     $role;
//     $sql = "SELECT * FROM bit216";
//     $userQ = mysqli_query($dbConnection, $sql);
//     $emailFound = false;
//     $passFound = false;
//     while($user = mysqli_fetch_assoc($userQ)){
//         if($email == $user['Username']){
//             $emailFound = true;
//             if($pass == "12345"){
//                 session_start();
//                 $_SESSION['username'] = $user['Username'];
//                 header("Location: ../first_login.php");
//             }
//             elseif($pass == $user['Password']){
//                 $passFound = true;
//                 $role = $user['Role'];
//                 session_start();
//                 $_SESSION['username'] = $user['Username'];
//                 if(isset($_POST['remember'])){ 
//                     setcookie('email',$email,time()+60 * 60 * 24 * 7, '/');
//                     setcookie('pass',$pass,time()+60 * 60 * 24 * 7, '/');
//                 }
//                 else{
//                     setcookie('email', '', time() - 3600, '/');
//                     setcookie('pass', '', time() - 3600, '/');
//                 }
//                 if($role == "user"){
//                     header("Location: ../dashboard.php");
//                 }
//                 elseif($role == "admin"){
//                     header("Location: ../admin_page.php");
//                 }
//             }
//         }
//     }


//     if(!$emailFound){
//         echo "<script> alert('Invalid email.');
//         location = '../login.php';
//         </script>";
//     }
//     else{
//         if(!$passFound){
//         echo "<script> alert('Invalid password.');
//         location = '../login.php';
//         </script>";
//         }
//     }

// }

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




if ($_GET['op'] == 'merchantUpload') {

    $fileCount = count($_FILES['file']['name']);
    
    for ($i = 0; $i < $fileCount; $i++) {
        $img_name = $_FILES['file']['name'][$i];
        $img_size = $_FILES['file']['size'][$i];
        $tmp_name = $_FILES['file']['tmp_name'][$i];
        
        $error = $_FILES['file']['error'][$i];
        
        // Your file processing logic here
        if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");
            if ($img_size > 1000000) {
                echo "<script> alert('Sorry, your file is too large.');
                location = '../merchant_add.php';
                </script>";
            
                if (!(in_array($img_ex_lc, $allowed_exs))) {
                    echo "<script> alert('Invalid file type.');
                    location = '../merchant_add.php';
                    </script>";
                }
            }
        } else {
            echo "<script> alert('Unknown error occurred. Please try again.');
                location = '../merchant_add.php';
                </script>";
        }
    }
    $name = $_POST['name'];
    $description = $_POST['description'];
    $highlight = $_POST['highlight'];
    $package = $_POST['package'];
    $price = $_POST['price'];
    $ID;
    session_start();
    $sql = "SELECT MerchantID FROM merchant WHERE Email='{$_SESSION['username']}'";
    $result = mysqli_query($dbConnection,$sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $ID = $row['MerchantID'];
    }else{
        $ID = null;
    }
    
    // Create a prepared statement
    $stmt = $dbConnection->prepare("INSERT INTO product (Name, Description, Highlight, Package, Price, MerchantID) VALUES (?, ?, ?, ?, ?,?)");

    // Bind the parameters and execute the statement
    $stmt->bind_param("ssssdi", $name, $description, $highlight, $package, $price, $ID);
    $stmt->execute();
    $id = mysqli_insert_id($dbConnection);
    
    for ($i = 0; $i < $fileCount; $i++) {
        $img_name = $_FILES['file']['name'][$i];
        $img_size = $_FILES['file']['size'][$i];
        $tmp_name = $_FILES['file']['tmp_name'][$i];
        
        $error = $_FILES['file']['error'][$i];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = '../uploads/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);

        // Insert into Database
        $sql = "INSERT INTO image(Image,ProductID) 
                VALUES('$new_img_name','$id')";
        mysqli_query($dbConnection, $sql);
    }

    echo "<script> alert('You have added a new product.');
    location = '../merchant_product_list.php';
    </script>";
}





if($_GET['op'] == 'addNewItemClicked'){
    header("Location: ../merchant_add.php");
}





if($_GET['op'] == 'edit'){
    header("Location: ../merchant_edit.php?id=" . $_GET['id']);
}



if($_GET['op'] == "deleteImage"){
    $id = $_POST['image_id'];
    $productID = $_POST['product_id'];
    $sql = "DELETE FROM image WHERE ImageID = $id";
    mysqli_query($dbConnection,$sql);
    header("Location: ../merchant_edit.php?id=" . $productID);
}




if($_GET['op'] == "merchantUpdate"){
    $fileCount = count($_FILES['file']['name']);
    $id = $_POST['productID'];
    if(!empty($_FILES['file']['name'][0])){
        for ($i = 0; $i < $fileCount; $i++) {
            $img_name = $_FILES['file']['name'][$i];
            $img_size = $_FILES['file']['size'][$i];
            $tmp_name = $_FILES['file']['tmp_name'][$i];
            
            $error = $_FILES['file']['error'][$i];
            
            // Your file processing logic here
            if ($error === 0) {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                
                $allowed_exs = array("jpg", "jpeg", "png");
                if ($img_size > 1000000) {
                    echo "<script> alert('Sorry, your file is too large.');
                    
                    </script>";
                    header("Location: ../merchant_edit.php?id=" . $id);
                
                    if (!(in_array($img_ex_lc, $allowed_exs))) {
                        echo "<script> alert('Invalid file type.');
                        
                        </script>";
                        header("Location: ../merchant_edit.php?id=" . $id);
                    }
                }
            } else {
                echo "<script> alert('Unknown error occurred. Please try again.');
                    
                    </script>";

                     header("Location: ../merchant_edit.php?id=" . $id);
            }
        }
    }
    if (!empty($_FILES['file']['name'][0])) {
        for ($i = 0; $i < $fileCount; $i++) {
            $img_name = $_FILES['file']['name'][$i];
            $img_size = $_FILES['file']['size'][$i];
            $tmp_name = $_FILES['file']['tmp_name'][$i];
            
            $error = $_FILES['file']['error'][$i];
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
            $img_upload_path = '../uploads/'.$new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
    
            // Insert into Database
            $sql = "INSERT INTO image(Image,ProductID) 
                    VALUES('$new_img_name','$id')";
            mysqli_query($dbConnection, $sql);
        }
    
    } 
    $name = $_POST['name'];
    $description = $_POST['description'];
    $highlight = $_POST['highlight'];
    $package = $_POST['package'];
    $price = $_POST['price'];
    
    $stmt = $dbConnection->prepare("UPDATE product SET Name=?,Description=?,Highlight=?,Package=?,Price=?
    WHERE ProductID=?");

    // Bind the parameters and execute the statement
    $stmt->bind_param("ssssdi", $name, $description, $highlight, $package, $price, $id);
    $stmt->execute();

    echo "<script> 
    alert('Edit success.');
    window.location = '../merchant_product_list.php';
    </script>";

}






if($_GET['op'] == "deleteProduct"){
    $id = $_GET['id'];
    $sql = "DELETE FROM product WHERE ProductID = $id";
    mysqli_query($dbConnection,$sql);
    header("Location: ../merchant_product_list.php");
}





if($_GET['op']=="adminApprove"){
    $id = $_GET['id'];
    $sql = "UPDATE request SET Status = 'APPROVE' WHERE RequestID = $id";
    mysqli_query($dbConnection,$sql);
    $sql2 = "SELECT Email FROM request WHERE RequestID = $id";
    $result = mysqli_query($dbConnection,$sql2);
    $username;
    $pass = 12345;
    $role = "merchant";
    if($result){
        $row = mysqli_fetch_assoc($result);
        $username = $row['Email'];
    }
    $sql3 = "INSERT INTO user(Username,Password,Role)
    VALUES ('$username','$pass','$role')";
    mysqli_query($dbConnection,$sql3);
    $userID = mysqli_insert_id($dbConnection);
    $sql4 = "INSERT INTO merchant(Email,RequestID,UserID)
    VALUES ('$username','$id','$userID')";
    mysqli_query($dbConnection,$sql4);

    $mail = new PHPMailer(true);
        
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'localxplorerphp@gmail.com';
    $mail->Password = 'oxrn owtv pkgy yzim';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('localxplorerphp@gmail.com');
    $mail->addAddress($username);

    $mail->isHTML(true);

    $mail->Subject = 'Registration success';
    $mail->Body = "Here is your default password:12345<br>
    http://localhost/DIP224%20ASSIGNMENT/login.php";

    $mail->send();




    echo "<script> 
    alert('Approve success.');
    window.location = '../merchant_request.php';
    </script>";

}




if($_GET['op']=="adminReject"){
    $id = $_GET['id'];
    $sql = "UPDATE request SET Status = 'REJECT' WHERE RequestID = $id";
    mysqli_query($dbConnection,$sql);

    $sql2 = "SELECT Email FROM request WHERE RequestID = $id";
    $result = mysqli_query($dbConnection,$sql2);
    $username;
    if($result){
        $row = mysqli_fetch_assoc($result);
        $username = $row['Email'];
    }

    $mail = new PHPMailer(true);
        
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'localxplorerphp@gmail.com';
    $mail->Password = 'oxrn owtv pkgy yzim';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('localxplorerphp@gmail.com');
    $mail->addAddress($username);

    $mail->isHTML(true);

    $mail->Subject = 'Registration Rejected';
    $mail->Body = "We regret to inform you that your registration has been rejected. If you have any questions, please contact our support team at [localxplorerphp@gmail.com].
    Thank you for considering us.";

    $mail->send();
    
    echo "<script> 
    alert('Reject success.');
    window.location = '../merchant_request.php';
    </script>";

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




if($_GET['op'] == "adminDelete"){
    $userID = $_POST['user_id'];
    $sql = "DELETE FROM user WHERE UserID=$userID";
    mysqli_query($dbConnection,$sql);
    echo "<script>alert('Delete success.');
    location = '../manage_account.php';</script>";
}





if($_GET['op'] == "bookNow"){
    $productID = $_POST['productID'];
    $pax = $_POST['people'];
    $total = $_POST['total'];
    $date = $_POST['start_date'];
    $currentDate = date("Y-m-d");
    session_start();
    $email = $_SESSION['username'];
    $sql = "SELECT CustID FROM customer WHERE Email='$email'";
    $custID;
    $result = mysqli_query($dbConnection,$sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $custID = $row['CustID'];
    }
    $sql2 = "SELECT MerchantID FROM product WHERE ProductID='$productID'";
    $merchantID;
    $merchantQ = mysqli_query($dbConnection,$sql2);
    if($merchantQ){
        $merchant = mysqli_fetch_assoc($merchantQ);
        $merchantID = $merchant['MerchantID'];
    }
    $sql3 = "INSERT INTO purchase(Date,Total,Pax,BillDate,ProductID,CustID,MerchantID)
            VALUES('$date','$total','$pax','$currentDate','$productID','$custID','$merchantID')";
    mysqli_query($dbConnection,$sql3);
    echo "<script>alert('Purchase success.');
    location = '../feedbackForm.php';</script>";
}




if($_GET['op'] == "feedback"){
    $rating = $_POST['rating'];
    $opinion = $_POST['opinion'];
    session_start();
    $username = $_SESSION['username'];
    $sql = "SELECT CustID FROM customer WHERE Email='$username'";
    $result = mysqli_query($dbConnection,$sql);
    $custID;
    $currentDate = date('j M Y');
    if($result){
        $row = mysqli_fetch_assoc($result);
        $custID = $row['CustID'];
    }
    $sql2 = "INSERT INTO feedback(Rating,Opinion,Username,CustID,Date)
            VALUES('$rating','$opinion','$username','$custID','$currentDate')";
    mysqli_query($dbConnection,$sql2);
    echo "<script>alert('Feedback success.');
    location = '../product.php';</script>";
    // $rating = $_POST['rating'];
    // echo $rating;
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