<?php
    include('session.php');
    $user_id = $_SESSION['id'];
    $query = mysqli_query($db,"SELECT * from users where `id` = $user_id ") or die(mysqli_error($db));
    $row = mysqli_fetch_array($query);
    $type = $row['type'];
    $email = $row['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel=" stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Navbar.css">
    <link rel="stylesheet" href="CSS/profile.css">

    <title>Profile | WORKKOSH</title>
</head>

<body>
    <nav class="nav-section navbar navbar-expand-lg fixed-top">
        <a class="site-logo navbar-brand" href="<?php if($type==1){echo "employer.php"; } if($type==2){echo "employee.php";} ?>"><img src="logo.png" alt="site logo"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="bars"><i class="fa fa-bars"></i></span>
        </button>
        <div class="nav-right collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="main-menu navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link home" href="<?php if($type==1){echo "employer.php"; } if($type==2){echo "employee.php";} ?>">Home</a></li>
                <li class="nav-item">
                    <div class="dropdown account">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            My Account
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <a class="dropdown-item" href="<?php if($type==1){echo "allworks.php"; } if($type==2){echo "activeworks.php";} ?>"><?php if($type==1){echo "All Works"; } if($type==2){echo "Active Works";} ?></a>
                            <hr>
                            <a href="logout.php" class="dropdown-item logout"><i class="fas fa-sign-out-alt"></i>
                                Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <?php
        $query = mysqli_query($db, "SELECT * from profile where `user_id` = $user_id");
        $row = mysqli_fetch_array($query);
    ?>
    <div class="container">
        <?php if($type == 1){ 
            if(isset($_POST['update1'])){
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $company = $_POST['lname'];
                $phone = $_POST['phone'];
                $query = mysqli_query($db, "UPDATE profile SET fname = '$fname', lname = '$lname', company = '$company', phone = '$phone' where `user_id` = '$user_id'");
                header('location:profile.php');
            }
        ?>
        <div class="profile">
            <div class="profile-title">My Account</div>
            <div class="profile-text">View and edit your profile.</div>
            <hr>
            <div class="label">Login Email : <span class="email"><?php echo $email; ?></span></div>
            <div class="row">
                <div class="label col-lg-6 col-md-12 col-sm-12">First Name
                    <div class="value"><?php echo $row['fname']; ?></div>
                </div>
                <div class="label col-lg-6 col-md-12 col-sm-12">Last Name
                    <div class="value"><?php echo $row['lname']; ?></div>
                </div>
            </div>
            <div class="label">Company Name (Optional)
                <div class="value"><?php 
                $company = $row['company'];
                if($company != "Not entered" || $company != ""){
                    echo $company;
                }else{
                    echo $row['fname']." ".$row['lname'];
                } 
                ?></div>
            </div>
            <div class="row">
                <div class="label col-lg-6 col-md-12 col-sm-12">Phone
                    <div class="phone">+91</div>
                    <div class="phone"><?php echo $row['phone']; ?></div>
                </div>
            </div>
            <div class="options">
                <button type="button" class="btn btn-update" data-toggle="modal" data-target="#exampleModal">
                    Update Profile
                </button>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="profile-title" id="exampleModalLabel">Update Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="profile.php" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="label col-lg-6 col-md-12 col-sm-12">First Name<input class="value" type="text" name="fname">
                                    </div>
                                    <div class="label col-lg-6 col-md-12 col-sm-12">Last Name<input class="value" type="text" name="lname">
                                    </div>
                                </div>
                                <div class="label">Company Name (Optional)
                                    <input class="value" type="text" name="company">
                                </div>
                                <div class="row">
                                    <div class="label col-lg-6 col-md-12 col-sm-12">Phone <input class="value" type="text" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input name="update1" value="Save changes" type="submit" class="btn btn-update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } 
            if($type == 2){ 
                if(isset($_POST['update2'])){
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $minwages = $_POST['min_wages'];
                    $maxhours = $_POST['max_hours'];
                    $phone = $_POST['phone'];
                    $query = mysqli_query($db, "UPDATE profile SET fname = '$fname', lname = '$lname', min_wages = '$minwages',max_hours = '$maxhours', phone = '$phone' where `user_id` = '$user_id'");
                    header('location:profile.php');
                }
            ?>
            <div class="profile">
                <div class="profile-title">My Account</div>
                <div class="profile-text">View and edit your profile.</div>
                <hr>
                <div class="label">Login Email : <span class="email"><?php echo $email; ?></span></div>
                <div class="row">
                    <div class="label col-lg-6 col-md-12 col-sm-12">First Name
                        <div class="value"><?php echo $row['fname']; ?></div>
                    </div>
                    <div class="label col-lg-6 col-md-12 col-sm-12">Last Name
                        <div class="value"><?php echo $row['lname']; ?></div>
                    </div>
                </div>
                <div class="label heading">Filters: </div>
                <div class="row">
                    <div class="label col-lg-6 col-md-12 col-sm-12">Minimun Wages
                        <div class="value">Rs. <?php echo $row['min_wages']; ?>/day</div>
                    </div>
                    <div class="label col-lg-6 col-md-12 col-sm-12">Maximum Working Hours
                        <div class="value"><?php echo $row['max_hours']; ?> hrs/day</div>
                    </div>
                </div>
                <div class="row">
                    <div class="label col-lg-6 col-md-12 col-sm-12">Phone
                        <div class="phone">+91</div>
                        <div class="phone"><?php echo $row['phone']; ?></div>
                    </div>
                </div>
                <div class="options">
                    <button type="button" class="btn btn-update" data-toggle="modal" data-target="#exampleModal">
                        Update Profile
                    </button>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="profile-title" id="exampleModalLabel">Update Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="profile.php" method="post">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="label col-lg-6 col-md-12 col-sm-12">First Name<input class="value" value="<?php echo $row['fname']; ?>" type="text" name="fname">
                                        </div>
                                        <div class="label col-lg-6 col-md-12 col-sm-12">Last Name<input class="value" value="<?php echo $row['lname']; ?>" type="text" name="lname">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-lg-6 col-md-12 col-sm-12">Minimun Wages<input class="value" type="number" name="min_wages">
                                        </div>
                                        <div class="label col-lg-6 col-md-12 col-sm-12">Max Working Hours<input class="value" type="text" name="max_hours">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-lg-6 col-md-12 col-sm-12">Phone <input class="value" value="<?php echo $row['phone']; ?>" type="text" name="phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input name="update2" value="Save changes" type="submit" class="btn btn-update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
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