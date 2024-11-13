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
    <title>Pickup History</title>
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
        <section class="py-5">
            <div class="container">
                <h1 class="my-3 text-center">Pickup History</h1>
            </div>
        </section>
        <div class="container">
        <main class="main-content">
            <form class="report-form">
                <div class="filters">
                    <input type="text" id="date-range" placeholder="Select Date Range" class="filter">
                    <select class="filter" id="type">
                        <option selected value="all">All</option>
                        <option value="general">General Waste</option>
                        <option value="household">Household Waste</option>
                        <option value="recyclable">Recyclable Waste</option>
                        <option value="hazardous">Hazardous Waste</option>
                    </select>
                </div>

                <div class="history-table">
                    <?php
                        global $dbConnection;
                        $email = $_SESSION['email'];
                        $sql = "SELECT userID FROM users WHERE email = '$email'";
                        $result = mysqli_query($dbConnection, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $userID = $row['userID'];

                        $sql2 = "SELECT * FROM pickupHistory WHERE userID = '$userID'";
                        $result2 = mysqli_query($dbConnection, $sql2);

                        if(mysqli_num_rows($result2) == 0){
                            echo '<table class="table table-bordered" id="pickup-history-table" style="display: none;">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '    <th>Waste Type</th>';
                            echo '    <th>Pickup Date</th>';
                            echo '    <th>Pickup Time</th>';
                            echo '    <th>Confirmation Status</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody></tbody>';
                            echo '</table>';
                            echo '<div class="no-his-container">';
                            echo '<p>No Pickup Record In Database</p>';
                            echo '</div>';
                        }
                        else{
                            echo '<table class="table table-bordered" id="pickup-history-table">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '    <th>Waste Type</th>';
                            echo '    <th>Pickup Date</th>';
                            echo '    <th>Pickup Time</th>';
                            echo '    <th>Confirmation Status</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            while($row2 = mysqli_fetch_assoc($result2)){
                                $pickupTime = date("h:i A", strtotime($row2['pickupTime']));

                                echo '<tr class="' . $row2['wasteType'] . ' ' . $row2['pickupDate'] . '">';
                                echo '    <td>' . ($row2['wasteType']) . '</td>';
                                echo '    <td>' . $row2['pickupDate'] . '</td>';
                                echo '    <td>' . $pickupTime . '</td>';
                                echo '    <td><span class="' . $row2['confirmationStatus'] . '">' . $row2['confirmationStatus'] . '</span></td>';
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

    <script>
        flatpickr("#date-range", {
            mode: "range",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates) {
                filterHistory();
            }
        });

        function filterHistory() {
            let dateRange = document.getElementById('date-range').value;
            let wasteType = document.getElementById('type').value;
            let rows = document.querySelectorAll('#pickup-history-table tbody tr');
            let noHistoryContainer = document.querySelector('.no-his-container');
            let visibleRowCount = 0;

            rows.forEach(row => {
                let rowDate = row.querySelector('td:nth-child(2)').textContent;
                let rowWasteType = row.querySelector('td:nth-child(1)').textContent.toLowerCase();

                let showRow = true;

                if (dateRange) {
                    let [startDate, endDate] = dateRange.split(' to ').map(date => new Date(date.trim()));
                    let pickupDate = new Date(rowDate);
                    if (pickupDate < startDate || pickupDate > endDate) {
                        showRow = false;
                    }
                }

                if (wasteType !== 'all' && !rowWasteType.includes(wasteType)) {
                    showRow = false;
                }

                row.style.display = showRow ? '' : 'none';

                if (showRow) {
                    visibleRowCount++;
                }
            });

            noHistoryContainer.style.display = visibleRowCount === 0 ? 'block' : 'none';
        }

        document.getElementById('type').addEventListener('change', filterHistory);
    </script>
</body>
</html>
