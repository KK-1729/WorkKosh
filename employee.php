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
    <link rel="stylesheet" href="CSS/employee_body.css">

    <title>Homepage | WORKKOSH</title>
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
        <?php
        $query = mysqli_query($db,"SELECT * from work LEFT JOIN profile on profile.`user_id` = work.`user_id` order by `work_id` DESC") or die(mysqli_error($db));
    ?>
        <div class="row">
            <?php
                while($row = mysqli_fetch_array($query)) {
                    $workid = $row['work_id'];
                    $query2 = mysqli_query($db, "SELECT * from accepted where work_id = $workid and `user_id2` = $user_id");
                    $n = mysqli_num_rows($query2);
                    $available = mysqli_query($db, "SELECT * from work where work_id = $workid");
                    $spots = mysqli_fetch_array($available);
                    $m = $spots['strength']-$spots['applied'];
                    $preference = mysqli_query($db, "SELECT * from profile where `user_id` = $user_id"); 
                    $filter = mysqli_fetch_array($preference);
                    if($n==0 and $m>0 and $row['work_hours']<=$filter['max_hours'] and $row['wages']>=$filter['min_wages']){
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header text-center">
                        <?php 
                        $company = $row['company'];
                        if($company == "Not entered" || $company == ""){
                            echo $row['fname']." ".$row['lname'];
                        }else{
                            echo $company;
                        } 
                    ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p class="card-text">
                            <?php echo $row['strength']; ?> workers needed
                        </p>
                        <hr class="text-center">
                        <p class="card-text">
                            <?php echo $row['work_hours']; ?> hrs/day
                        </p>
                        <p class="card-text">
                            Rs. <?php echo $row['wages']; ?>/day
                        </p>
                        <a href="view_details.php<?php echo '?id='.$row['work_id']; ?>" class="btn btn-new">View
                            Details</a>
                    </div>
                    <div class="card-footer text-center text-muted">
                        Available Spots :
                        <?php 
                            $available = $row['strength']-$row['applied'];
                            if($available>0){
                                echo $available;
                            }else{
                                echo 0;
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php } ?>
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