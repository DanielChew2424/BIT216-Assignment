<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
                    <h1 class="my-5 text-center">Login</h1>
                </div>
            </section>
        <div class="page-content">
            <section class="register">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-10 ms-auto me-auto">
                            <div class="register-form text-center">
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