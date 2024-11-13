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
    <title>Waste Schedule</title>
    <link rel="stylesheet" href="css/font-awesome/all.min.css" />
  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
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
                    <a class="navbar-brand" href="admin_dashboard.php">CWCL</a>

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
                    <h1 class="my-5 text-center">Waste Pickup Timetable</h1>
                </div>
            </section>

            <div class="form-group">
                <label for="dayOfWeek">Select Day of the Week</label>
                <select class="form-select" id="daySelector" name="dayOfWeek" required onchange="displaySchedule()">
                    <option value="">Day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>

            <section class="scheduleDetails">
                <div id="monday" class="dayOfWeek">
                    <?php
                global $dbConnection;
                $email = $_SESSION['email'];
                $sql = "SELECT communityID FROM users WHERE email = '$email'";
                $result = mysqli_query($dbConnection,$sql);
                $row = mysqli_fetch_assoc($result);
                $comID = $row['communityID'];

                $sql2 = "SELECT * FROM schedule WHERE communityID = '$comID' AND scheduleDay = 'Monday'";
                $result2 = mysqli_query($dbConnection,$sql2);
                if(mysqli_num_rows($result2)>0){
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $formattedTime = date("g:i A", strtotime($row['scheduleTime']));
                        echo '<div class="time-slot" data-value="'. $row['scheduleID'] .'" onclick="selectTimeSlot(this)">' . $formattedTime . '</div>';

                    }
                }
                else{
                    echo '<div class="no-time">No time slot on Monday</div>';
                }

            ?>
                </div>

                <div id="tuesday" class="dayOfWeek">
                    <?php
                $sql2 = "SELECT * FROM schedule WHERE communityID = '$comID' AND scheduleDay = 'Tuesday'";
                $result2 = mysqli_query($dbConnection,$sql2);
                if(mysqli_num_rows($result2)>0){
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $formattedTime = date("g:i A", strtotime($row['scheduleTime']));
                        echo '<div class="time-slot" data-value="'. $row['scheduleID'] .'" onclick="selectTimeSlot(this)">' . $formattedTime . '</div>';
                    }
                }
                else{
                    echo '<div class="no-time">No time slot on Tuesday</div>';
                }
            ?>

                </div>

                <div id="wednesday" class="dayOfWeek">
                    <?php
                $sql2 = "SELECT * FROM schedule WHERE communityID = '$comID' AND scheduleDay = 'Wednesday'";
                $result2 = mysqli_query($dbConnection,$sql2);
                if(mysqli_num_rows($result2)>0){
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $formattedTime = date("g:i A", strtotime($row['scheduleTime']));
                        echo '<div class="time-slot" data-value="'. $row['scheduleID'] .'" onclick="selectTimeSlot(this)">' . $formattedTime . '</div>';
                    }
                }
                else{
                    echo '<div class="no-time">No time slot on Wednesday</div>';
                }
            ?>
                </div>

                <div id="thursday" class="dayOfWeek">
                    <?php
                $sql2 = "SELECT * FROM schedule WHERE communityID = '$comID' AND scheduleDay = 'Thursday'";
                $result2 = mysqli_query($dbConnection,$sql2);
                if(mysqli_num_rows($result2)>0){
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $formattedTime = date("g:i A", strtotime($row['scheduleTime']));
                        echo '<div class="time-slot" data-value="'. $row['scheduleID'] .'" onclick="selectTimeSlot(this)">' . $formattedTime . '</div>';
                    }
                }
                else{
                    echo '<div class="no-time">No time slot on Thursday</div>';
                }
            ?>
                </div>

                <div id="friday" class="dayOfWeek">
                    <?php
                $sql2 = "SELECT * FROM schedule WHERE communityID = '$comID' AND scheduleDay = 'Friday'";
                $result2 = mysqli_query($dbConnection,$sql2);
                if(mysqli_num_rows($result2)>0){
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $formattedTime = date("g:i A", strtotime($row['scheduleTime']));
                        echo '<div class="time-slot" data-value="'. $row['scheduleID'] .'" onclick="selectTimeSlot(this)">' . $formattedTime . '</div>';
                    }
                }
                else{
                    echo '<div class="no-time">No time slot on Friday</div>';
                }
            ?>
                </div>

                <div id="saturday" class="dayOfWeek">
                    <?php
                $sql2 = "SELECT * FROM schedule WHERE communityID = '$comID' AND scheduleDay = 'Saturday'";
                $result2 = mysqli_query($dbConnection,$sql2);
                if(mysqli_num_rows($result2)>0){
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $formattedTime = date("g:i A", strtotime($row['scheduleTime']));
                        echo '<div class="time-slot" data-value="'. $row['scheduleID'] .'" onclick="selectTimeSlot(this)">' . $formattedTime . '</div>';
                    }
                }
                else{
                    echo '<div class="no-time">No time slot on Saturday</div>';
                }
            ?>
                </div>

                <div id="sunday" class="dayOfWeek">
                    <?php
                $sql2 = "SELECT * FROM schedule WHERE communityID = '$comID' AND scheduleDay = 'Sunday'";
                $result2 = mysqli_query($dbConnection,$sql2);
                if(mysqli_num_rows($result2)>0){
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $formattedTime = date("g:i A", strtotime($row['scheduleTime']));
                        echo '<div class="time-slot" data-value="'. $row['scheduleID'] .'" onclick="selectTimeSlot(this)">' . $formattedTime . '</div>';
                    }
                }
                else{
                    echo '<div class="no-time">No time slot on Sunday</div>';
                }
            ?>
                </div>
            </section>

            <div class="actions py-5">
                <button id="addButton" class="btn btn-primary mx-3">Add</button>
                <form method="post" action="php/functions.php?op=deleteTimeSlot" onsubmit="return deleteTimeSlot();">
                    <input type="hidden" id="hiddenID" name="scheduleID" value="">
                    <button class="btn btn-danger mx-3" type="submit">Delete Selected Slot</button>
                </form>
            </div>
        </div>
    </div>

    <div id="addTimeSlotModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Add New Time Slot</h5>
            </div>
            <form method="post" action="php/functions.php?op=addTimeSlot" onsubmit="return valiDayAddTimeSlot();">
                <div class="modal-datetime my-3 p-5">
                    <label for="daySelect">Day:</label>
                    <select id="daySelect" name="day" required>
                        <option value="">Select Day</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>

                
                    <label for="timeInput">Time:</label>
                    <input type="time" name="time" id="timeInput" required>
                </div>
                

                <div class="modal-buttons">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Back</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 CWCL. All rights reserved.</p>
    </footer>

    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script>
        function displaySchedule() {
            const daySelector = document.getElementById("daySelector");
            const selectedDay = daySelector.value.toLowerCase();
            const scheduleDays = document.querySelectorAll('.dayOfWeek');
            scheduleDays.forEach(day => day.style.display = 'none');

            if (selectedDay) {
                const dayToShow = document.getElementById(selectedDay);
                if (dayToShow) {
                    dayToShow.style.display = 'block';
                } else {
                    console.log("No matching day found for:", selectedDay);
                }
            }
        }


        function valiDayAddTimeSlot() {
            const selectedDay = document.getElementById("daySelect").value;
            const selectedTime = document.getElementById("timeInput").value;

            if (!selectedDay || !selectedTime) {
                alert('Please select both day and time.');
                return false;
            }

            const dayContainer = document.getElementById(selectedDay.toLowerCase());
            const existingTimeSlots = dayContainer ? dayContainer.querySelectorAll('.time-slot') : [];


            if (existingTimeSlots.length >= 2) {
                alert('You cannot add more than 2 time slots for ' + selectedDay);
                return false;
            }

            return true;
        }

        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("addButton").addEventListener("click", openModal);
        });


        function openModal() {
            const modal = document.getElementById("addTimeSlotModal");
            modal.style.display = "flex";
        }

        function closeModal() {
            const modal = document.getElementById("addTimeSlotModal");
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            const modal = document.getElementById("addTimeSlotModal");
            if (event.target === modal) {
                closeModal();
            }
        };

        function selectTimeSlot(element) {
            const selected = document.querySelector('.selected');
            if (selected) {
                selected.classList.remove('selected');
            }
            element.classList.add('selected');
            
            const scheduleID = element.getAttribute('data-value');
            document.getElementById('hiddenID').value = scheduleID;
        }

        function deleteTimeSlot() {
            const input = document.getElementById("hiddenID");
            if (input.value == "") {
                alert('Please select a time.');
                return false;
            }
            const userConfirmed = confirm("Are you sure you want to delete this time slot?");
            if (userConfirmed) {
                const form = document.querySelector('form');
                form.submit();

                const selectedSlot = document.querySelector('.selected');
                if (selectedSlot) {
                    selectedSlot.remove();
                }
                return true;
            } else {
                return false;
            }
        }

    </script>
</body>

</html>