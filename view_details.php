<?php
    include('session.php');
    $user_id = $_SESSION['id'];
    $errors = array();
    $success = "";
    $work_id = $_GET['id'];
    $query = "SELECT * FROM work WHERE work_id = '$work_id'" or die(mysql_error());
    $results = mysqli_query($db, $query);
    $row = mysqli_fetch_array($results);
    $workname = $row['name'];
    $hours = $row['work_hours'];
    $wages = $row['wages'];
    $address = $row['address'];
    $datevalue = $row['date'];
    $montharr = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    $year = substr($datevalue, 0,4);
    $month = $montharr[substr($datevalue,5,2)-1];
    $date = $month." ".substr($datevalue,8,2).", ".$year;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel=" stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Navbar.css">
    <link rel="stylesheet" href="CSS/view_details.css">

    <title><?php echo $workname ?> | WORKKOSH</title>
</head>

<body>
    <nav class="nav-section navbar navbar-expand-lg fixed-top">
        <a class="site-logo navbar-brand" href="employee.php"><img src="logo.png" alt="site logo"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="bars"><i class="fa fa-bars"></i></span>
        </button>
        <div class="nav-right collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="main-menu navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link home" href="employee.php">Home</a></li>
                <li class="nav-item">
                    <div class="dropdown account">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            My Account
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <a class="dropdown-item" href="#">Active Works</a>
                            <hr>
                            <a href="logout.php" class="dropdown-item logout"><i class="fas fa-sign-out-alt"></i>
                                Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="details">
            <div class="back"><a href="employee.php">< Back</a></div>
            <div class="title">Work details</div>
            <div class="workname"><?php echo $workname; ?></div>
            <div class="info"><?php echo $hours." hrs/day <span> | </span> Rs. ".$wages."/day" ?></div>
            <div class="date"><?php echo $date; ?></div>
            <div class="address"><?php echo $address; ?></div>
            <div class="accept">
                <form action="accept.php<?php echo '?id='.$work_id; ?>" method="post">
                    <input type="submit" value="Accept Work" name="accept" class="btn btn-new">
                </form>
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