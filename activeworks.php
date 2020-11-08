<?php
    include('session.php');
    $user_id = $_SESSION['id'];
    $errors = array();
    $success = "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel=" stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Navbar.css">
    <link rel="stylesheet" href="CSS/activeworks.css">

    <title>Active Works | WORKKOSH</title>
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
                            <a class="dropdown-item" href="activeworks.php">Active Works</a>
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
        <div class="heading">
            Active Works :
        </div>
        <?php
        $query = mysqli_query($db,"SELECT * from accepted LEFT JOIN work on accepted.`work_id` = work.`work_id` order by `accept_id` DESC");
    ?>
        <?php
                while($row = mysqli_fetch_array($query)) {
                    if($row['user_id2']==$user_id){
                        $workname = $row['name'];
                        $datevalue = $row['date'];
                        $montharr = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                        $year = substr($datevalue, 0,4);
                        $month = $montharr[substr($datevalue,5,2)-1];
                        $date = $month." ".substr($datevalue,8,2).", ".$year;
                        $work_id = $row['work_id'];
                    ?>
        <div class="row">
            <a href="#">
                <div class="active">
                    <span class="title">
                        <?php echo $workname; ?>
                    </span>
                    <span class="date">
                        <?php echo $date; ?>
                    </span>
                </div>
            </a>
        </div>
        <?php } ?>
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