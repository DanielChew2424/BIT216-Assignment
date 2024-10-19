<<<<<<< HEAD
<?php
    include 'php/dbConnect.php';
    session_start();
    if(!isset($_SESSION['email'])){
        header ("Location: login.php");
    }
?>

=======
>>>>>>> c9148a75ad5725725d4f23cd812dbdb9ddc9e60a
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Waste Pickup Schedule</title>
    <link rel="stylesheet" href="css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
    <link href="css/theme.min.css" rel="stylesheet" />
    <style>
        form {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
<<<<<<< HEAD
=======

        
>>>>>>> c9148a75ad5725725d4f23cd812dbdb9ddc9e60a
    </style>
</head>

<body>
    <div class="page-wrapper">
        <section class="hero-banner bg-dark">
            <div class="container">
                <a class="navbar-brand" href="dashboard.php">
                    <i class="fas fa-arrow-left" style="color:white;"></i>
                </a>
                <div class="row text-white text-center z-index-1">
                    <div class="col-12">
                        <h1 class="text-white">Schedule Your Waste Pickup</h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="schedule-form">
            <section class="schedule">
                <div class="container">
                    <div class="row">
                        <div class="col-12 ms-auto me-auto">
<<<<<<< HEAD
                            <form id="pickupForm" method="POST" action="php/functions.php?op=confirmBtn">
                                <div class="row">
                                    <div class="col-md-12 my-3">
                                        <div class="form-group">
                                            <label for="date">Pickup Date:</label>
                                            <input id="form_date" type="date" name="date" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <div class="form-group">
                                            <label for="time">Pickup Time:</label>
                                            <input id="form_time" type="time" name="time" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <div class="form-group">
                                            <label for="wasteType">Type of Waste:</label>
                                            <select class="form-select form-control" id="wasteType" name="wasteType" required>
                                                <option value="">Select waste type</option>
                                                <option value="General Waste">General Waste</option>
                                                <option value="Household Waste">Household Waste</option>
                                                <option value="Recyclable Waste">Recyclable Waste</option>
                                                <option value="Hazardous Waste">Hazardous Waste</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select at least one option.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary">Next</button>
                                    </div>
                                </div>
                            </form>
=======
                            <div class="register-form">
                                <form id="pickupForm" method="POST" action="php/functions.php?op=schedulePickup">
                                    <div class="row">
                                        <div class="col-md-12 my-3">
                                            <div class="form-group">
                                                <label for="date">Pickup Date:</label>
                                                <input id="form_date" type="date" name="date" class="form-control"
                                                    placeholder="Date" required="required"
                                                    data-error="Date is required" />
                                            </div>
                                        </div>
                                        <div class="col-md-12 my-3">
                                            <div class="form-group">
                                                <label for="Time">Pickup Time:</label>
                                                <input id="form_time" type="time" name="time" class="form-control"
                                                    placeholder="Time" required="required"
                                                    data-error="Time is required." />
                                            </div>
                                        </div>
                                        <div class="col-md-12 my-3">
                                            <div class="form-group">
                                                <label for="wasteType">Type of Waste:</label>
                                                <select class="form-select form-control" aria-label="Default select" required>
                                                    <option value="general">General Waste</option>
                                                    <option value="recycling">Household Waste</option>
                                                    <option value="recycling">Recyclable Waste</option>
                                                    <option value="hazardous">Hazardous Waste</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
>>>>>>> c9148a75ad5725725d4f23cd812dbdb9ddc9e60a
                        </div>
                    </div>
                </div>
            </section>
        </div>
<<<<<<< HEAD

        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Your Selection</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Residential Address:</strong> 
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
                        </p>
                        <p><strong>Date:</strong> <span id="confirmDate"></span></p>
                        <p><strong>Time:</strong> <span id="confirmTime"></span></p>
                        <p><strong>Waste Type:</strong> <span id="confirmWasteType"></span></p>
                        
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmBtn" action="php/functions.php?op=confirmBtn">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

=======
>>>>>>> c9148a75ad5725725d4f23cd812dbdb9ddc9e60a
    </div>

    <footer>
        <p>&copy; 2024 CWCL. All rights reserved.</p>
    </footer>
<<<<<<< HEAD

    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script>
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
            document.getElementById("pickupForm").submit();
        });

        document.getElementById("confirmBtn").addEventListener("click", function () {
            // Submit the form when the Confirm button is clicked
            document.getElementById("pickupForm").submit();
        });
    </script>
</body>

</html>
=======
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>

</html>
>>>>>>> c9148a75ad5725725d4f23cd812dbdb9ddc9e60a
