<?php 
    include('server.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=" stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/User.css">
    <title>Signup | WORKKOSH</title>
</head>

<body>
    <!-- NAVIGATION BAR -->
    <nav class="nav-section navbar navbar-expand-lg fixed-top">
        <a class="site-logo navbar-brand" href="#"><img src="logo.png" alt="site logo"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="bars"><i class="fa fa-bars"></i></span>
        </button>
        <div class="nav-right collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link login" href="signin.php">Login</a></li>
                <li class="nav-item"><a class="nav-link register" href="signup.php">Create an account</a></li>
            </ul>
        </div>
    </nav>

    <!-- The main body of the website -->
    <div id="login-body">
        <div class="container">
            <div class="row">
                <div class="mr-auto ml-auto col-lg-4 col-md-6 col-sm-12">
                    <form class="login-content" action="signup.php" method="post">
                        <?php include('errors.php'); ?>
                        <h2 class="title">New User</h2>
                        <div class="input-div type">
                            <div class="div">
                                <label for="type">Account Type </label>
                                <select name="type" class="input">
                                    <option value= 0>Select Account Type</option>
                                    <option value= 1>Employer</option>
                                    <option value= 2>Employee</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-div one">
                            <div class="div">
                                <label for="email">Email</label>
                                <input type="text" class="input" name="email">
                            </div>
                        </div>
                        <div class="input-div pass">
                            <div class="div">
                                <label for="password1">Password</label>
                                <input type="password" class="input" name="password1">
                            </div>
                        </div>
                        <div class="input-div conpass">
                            <div class="div">
                                <label for="password2">Confirm Password</label>
                                <input type="password" class="input" name="password2">
                            </div>
                        </div>
                        <a href="signin.php">Already Registered? Sign In.</a>
                        <button type="submit" name="signup" class="btn login-btn">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>

</body>

</html>