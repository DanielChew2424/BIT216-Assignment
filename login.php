<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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


                        <h1 class="text-white">Log In</h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="page-content">
            <section class="register">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-10 ms-auto me-auto">
                            <div class="register-form text-center">
<<<<<<< HEAD
=======
<<<<<<< Updated upstream
<<<<<<< HEAD
=======
>>>>>>> Stashed changes
>>>>>>> deba883b65849c9c8474a02205d85ed37aefcfcd
                            <form id="contact-form" method="post" action="php/functions.php?op=login">
                                <div class="messages"></div>
                                <div class="form-group">
                                  <input id="form_email" type="email" value="<?php if(isset($_COOKIE['email'])){
                                    echo $_COOKIE['email'];
                                  }; ?>" name="email" class="form-control" placeholder="Email" required="required" data-error="Email is required.">
                                  <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                  <input id="form_password" type="password" value="<?php if(isset($_COOKIE['pass'])){
                                    echo $_COOKIE['pass'];
                                  }; ?>" name="password" class="form-control" placeholder="Password" required="required" data-error="password is required.">
                                  <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group mt-4 mb-5">
                                  <div class="remember-checkbox d-flex align-items-center justify-content-between">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" <?php if(isset($_COOKIE['email'])){
                                    echo 'checked';
                                  }; ?> name="remember" id="check1">
                                      <label class="form-check-label" for="check1">Remember me</label>
                                    </div> <a href="forget_password.php">Forgot Password?</a>
                                  </div>
                                </div> <button type="submit" class="btn btn-primary">Login Now</button>
                              </form>
<<<<<<< HEAD
=======
<<<<<<< Updated upstream
=======
                                <form id="contact-form" method="post" action="php/functions.php?op=login">
                                    <div class="messages"></div>
                                    <div class="form-group">
                                        <input id="form_name" type="email" value="<?php if(isset($_COOKIE['email'])){
                                    echo $_COOKIE['email'];
                                  }; ?>" name="name" class="form-control" placeholder="Email" required="required"
                                            data-error="Username is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <input id="form_password" type="password" value="<?php if(isset($_COOKIE['pass'])){
                                    echo $_COOKIE['pass'];
                                  }; ?>" name="password" class="form-control" placeholder="Password"
                                            required="required" data-error="password is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group mt-4 mb-5">
                                        <div
                                            class="remember-checkbox d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" <?php
                                                    if(isset($_COOKIE['email'])){ echo 'checked' ; }; ?> name="remember"
                                                id="check1">
                                                <label class="form-check-label" for="check1">Remember me</label>
                                            </div> 
                                            <a href="forget_password.php">Forgot Password?</a>
                                        </div>
                                    </div> <button type="submit" class="btn btn-primary">Login Now</button>
                                </form>
>>>>>>> c9148a75ad5725725d4f23cd812dbdb9ddc9e60a
=======
>>>>>>> Stashed changes
>>>>>>> deba883b65849c9c8474a02205d85ed37aefcfcd
                                <div class="d-flex align-items-center text-center justify-content-center mt-4"> <span
                                        class="text-muted me-1">Don't have an account?</span>
                                    <a href="signup.php">Sign Up</a>
                                </div>
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