<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
    <link href="css/theme.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <header class="header default bg-dark">
        <div class="container">
            <nav class="navbar navbar-static-top navbar-expand-lg">
                <div class="container-fluid my-3">
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                        data-bs-target=".navbar-collapse"><i class="fas fa-align-left"></i></button>
                    <a class="navbar-brand" href="dashboard.php">CWCL</a>
                </div>
            </nav>
        </div>
    </header>

    <div class="page-wrapper">
      <section class="py-5">
            <div class="container">
                <h1 class="my-5 text-center">Sign Up</h1>
            </div>
        </section>
        <div class="register-form">
            <section class="register">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-10 ms-auto me-auto">
                            <div class="register-form text-center">
                                <form id="userForm" method="POST" action="php/functions.php?op=userSignUp"
                                    onsubmit="return validatePassword()">
                                    <div class="messages"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input id="form_name" type="text" name="name" class="form-control"
                                                    placeholder="Fullname" required="required"
                                                    data-error="Fullname is required." />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input id="form_no" type="tel" name="contactNumber" class="form-control"
                                                    placeholder="Contact Number" required="required"
                                                    data-error="Contact number is required" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input id="form_email" type="email" name="email" class="form-control"
                                                    placeholder="Email" required="required"
                                                    data-error="Valid email is required." />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-select form-control" aria-label="Default select">
                                                    <option selected>Community Name</option>
                                                    <option value="1">Subang Bestari Community</option>
                                                    <option value="2">Bandar Utama Community</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input id="form_email" type="text" name="residentialAddress"
                                                    class="form-control" placeholder="Residential Address"
                                                    required="required" data-error="Residential Address is required." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary">
                                                Create Account
                                            </button>
                                            <span class="mt-4 d-block">Have An Account ?
                                                <a href="login.php"><i>Sign In!</i></a></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>
</html>