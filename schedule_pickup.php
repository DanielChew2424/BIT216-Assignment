<?php
include 'php/dbConnect.php';
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

global $dbConnection;
$email = $_SESSION['email'];
$sql = "SELECT userID FROM users WHERE email = '$email'";
$result = mysqli_query($dbConnection, $sql);
$row = mysqli_fetch_assoc($result);
$userID = $row['userID'];

$pickupDateQuery = "SELECT DISTINCT scheduleDay FROM schedule ORDER BY scheduleDay DESC";
$pickupDateResult = mysqli_query($dbConnection, $pickupDateQuery);

$pickupTimeQuery = "SELECT DISTINCT scheduleTime FROM schedule ORDER BY scheduleTime ASC";
$pickupTimeResult = mysqli_query($dbConnection, $pickupTimeQuery);

if (isset($_POST['action']) && $_POST['action'] == 'fetch_times') {
    $selectedDate = $_POST['date'];
    
    $timeQuery = "SELECT DISTINCT scheduleTime FROM schedule WHERE scheduleDay='$selectedDate' ORDER BY scheduleTime ASC";
    $timeResult = mysqli_query($dbConnection, $timeQuery);

    $timeOptions = [];
    while ($row = mysqli_fetch_assoc($timeResult)) {
        $formattedTime = date("g:i A", strtotime($row['scheduleTime']));
        $timeOptions[] = $formattedTime;
    }

    echo json_encode($timeOptions);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Waste Pickup Schedule</title>
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
                <h1 class="my-3 text-center">Schedule Your Waste Pickup</h1>
            </div>
        </section>

        <div class="schedule-form">
            <section class="schedule">
                <div class="container">
                    <div class="row">
                        <div class="col-12 ms-auto me-auto">
                            <form id="pickupForm" method="POST" action="php/functions.php?op=confirmBtn">
                                <div class="form-group mb-4">
                                    <label for="date">Pickup Day:</label>
                                    <select id="form_date" name="date" class="form-control" required>
                                        <option value="">Select Pickup Day</option>
                                        <?php while ($row = mysqli_fetch_assoc($pickupDateResult)): ?>
                                        <?php 
                                            $formattedDate = date("l, F j, Y", strtotime($row['scheduleDay']));
                                        ?>
                                        <option value="<?= $row['scheduleDay'] ?>"><?= $formattedDate ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="time">Pickup Time:</label>
                                    <select id="form_time" name="time" class="form-control" required>
                                        <option value="">Select Pickup Time</option>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="wasteType">Type of Waste:</label>
                                    <select class="form-select form-control" id="wasteType" name="wasteType" required>
                                        <option value="">Select waste type</option>
                                        <option value="General Waste">General Waste</option>
                                        <option value="Household Waste">Household Waste</option>
                                        <option value="Recyclable Waste">Recyclable Waste</option>
                                        <option value="Hazardous Waste">Hazardous Waste</option>
                                    </select>
                                </div>

                                <div class="text-center my-5">
                                    <button type="submit" class="btn btn-primary btn-lg">Next</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="modal" id="confirmationModal" aria-labelledby="confirmationModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Your Selection</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="userID" value="<?= $userID ?>">
                        <p><strong>Residential Address:</strong> <span id="confirmAddress">
                            <?php
                                global $dbConnection;
                                $email = $_SESSION['email'];
                                $sql = "SELECT address FROM users WHERE email='$email'";
                                $addressQ = mysqli_query($dbConnection, $sql);
                                if($addressQ){
                                    $address = mysqli_fetch_assoc($addressQ);
                                    echo $address['address'];
                                }
                            ?>
                        </span></p>
                        <p><strong>Day:</strong> <span id="confirmDate"></span></p>
                        <p><strong>Time:</strong> <span id="confirmTime"></span></p>
                        <p><strong>Waste Type:</strong> <span id="confirmWasteType"></span></p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmBtn">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 CWCL. All rights reserved.</p>
    </footer>

    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script>
        document.getElementById('form_date').addEventListener('change', function () {
            const selectedDate = this.value;
            const timeSelect = document.getElementById('form_time');

            timeSelect.innerHTML = '<option value="">Select Pickup Time</option>';

            if (selectedDate) {
                fetch('schedule_pickup.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'action=fetch_times&date=' + selectedDate
                })
                .then(response => response.json())
                .then(data => {
                    data.forEach(function (time) {
                        const option = document.createElement('option');
                        option.value = time;
                        option.textContent = time;
                        timeSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching times:', error));
            }
        });

        document.getElementById("pickupForm").addEventListener("submit", function (event) {
            event.preventDefault();

            const date = document.getElementById("form_date").value;
            const time = document.getElementById("form_time").value;
            const wasteType = document.getElementById("wasteType").value;

            if (!date || !time || !wasteType) {
                alert("Please fill in all fields.");
                return;
            }

            document.getElementById("confirmDate").textContent = date;
            document.getElementById("confirmTime").textContent = time;
            document.getElementById("confirmWasteType").textContent = wasteType;

            var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();
        });

        document.getElementById("confirmBtn").addEventListener("click", function () {
            const date = document.getElementById("form_date").value;
            const time = document.getElementById("form_time").value;
            const wasteType = document.getElementById("wasteType").value;
            const userID = document.querySelector('input[name="userID"]').value;

            if (!date || !time || !wasteType) {
                alert("Please fill in all fields.");
                return;
            }

            const formData = new URLSearchParams();
            formData.append("date", date);
            formData.append("time", time);
            formData.append("wasteType", wasteType);
            formData.append("userID", userID);

            fetch("php/functions.php?op=confirmBtn", {
                method: "POST",
                body: formData,
            })
            .then(response => {
                if (response.ok) {
                    alert("Schedule successful!");
                    window.location.href = "dashboard.php";
                } else {
                    throw new Error("Failed to schedule. Please try again.");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    </script>
</body>
</html>