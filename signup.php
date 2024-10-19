<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
    <link href="css/theme.min.css" rel="stylesheet" />
</head>

<body>
    <div class="page-wrapper">
        <section class="hero-banner position-relative custom-pt-1 custom-pb-2 bg-dark">
            <div class="container">
                <div class="row text-white text-center z-index-1">
                    <div class="col">
                        <h1 class="text-white">Sign Up</h1>
                    </div>
                </div>
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
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
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