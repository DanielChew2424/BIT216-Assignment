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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

        <div class="container">
            <section class="py-5">
                <div class="container">
                    <h1 class="my-5 text-center">Notifications</h1>
                </div>
            </section>
        </div>

        <div class="container">
        
        <main class="main-content">
            <form class="report-form">


            <div class="history-table">
                    <?php
                        global $dbConnection;

                        $email = $_SESSION['email'];

                        $sql = "SELECT communityID FROM users WHERE email = '$email'";

                        $result = mysqli_query($dbConnection, $sql);
                        
                        $row = mysqli_fetch_assoc($result);
                        
                        $communityID = $row['communityID'];

                        $sql2 = "SELECT * FROM schedule WHERE communityID != '$communityID'";

                        $result2 = mysqli_query($dbConnection, $sql2);

                        if(mysqli_num_rows($result2) == 0){
                            echo '<table class="table table-bordered" id="pickup-history-table" style="display: none;">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '    <th>Schedule Day</th>';
                            echo '    <th>Schedule Time</th>';
                            echo '    <th>Notifcation Day</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody></tbody>';
                            echo '</table>';
                            echo '<div class="no-his-container">';
                            echo '<p>No Notification In Database</p>';
                            echo '</div>';
                        }
                        else{
                            echo '<table class="table table-bordered" id="pickup-history-table">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '    <th>Schedule Day</th>';
                            echo '    <th>Schedule Time</th>';
                            echo '    <th>Notifcation Day</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            while($row2 = mysqli_fetch_assoc($result2)){
                                
                                $createdAt = date("Y-m-d H:i:s", strtotime($row2['createdAt']));
                                $scheduleTime = date("h:i:s A", strtotime($row2['scheduleTime']));

                                echo '<tr class="' . $row2['scheduleDay'] . ' ' . '">';
                                echo '    <td>' . ($row2['scheduleDay']) . '</td>';
                                echo '    <td>' . $scheduleTime . '</td>';
                                echo '    <td>' . $createdAt . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                            echo '<div class="no-his-container" style="display: none;">';
                            echo '<p>No Pickup Record In Database</p>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </form>
        </main>
    </div>
    
    
    </div>

    <footer>
        <p>&copy; 2024 CWCL. All rights reserved.</p>
    </footer>


</body>
</html>

