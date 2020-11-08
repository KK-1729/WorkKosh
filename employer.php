<?php
    include('session.php');
    $user_id = $_SESSION['id'];
    $errors = array();
    $success = "";

    if(isset($_POST['new_work'])){
        $name = $_POST['name'];
        $strength = $_POST['strength'];
        $hours = $_POST['hours'];
        $wages = $_POST['wages'];
        $address = $_POST['address'];
        $date = $_POST['date'];

        if(empty($name)){array_push($errors, "The work could not be added. Please provide all the details.");}
        if(empty($strength)){array_push($errors, "The work could not be added. Please provide all the details.");}
        if(empty($hours)){array_push($errors, "The work could not be added. Please provide all the details.");}
        if(empty($wages)){array_push($errors, "The work could not be added. Please provide all the details.");}
        if(empty($address)){array_push($errors, "The work could not be added. Please provide all the details.");}
        if(empty($date)){array_push($errors, "The work could not be added. Please provide all the details.");}
        
        if(count($errors) == 0){
            $query = mysqli_query($db, "INSERT into work(`user_id`, `name`, `strength`, `work_hours`, `wages`, `address`, `date`) VALUES('$user_id', '$name', '$strength', '$hours', '$wages', '$address', '$date')") or die ("Query could not be executed.");
            $success = "New work has been added! It will be available in the employee feed for them to join in.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel=" stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Navbar.css">
    <link rel="stylesheet" href="CSS/Employer_body.css">

    <title>Homepage | WORKKOSH</title>
</head>

<body>
    <nav class="nav-section navbar navbar-expand-lg fixed-top">
        <a class="site-logo navbar-brand" href="employer.php"><img src="logo.png" alt="site logo"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="bars"><i class="fa fa-bars"></i></span>
        </button>
        <div class="nav-right collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="main-menu navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link home" href="employer.php">Home</a></li>
                <li class="nav-item">
                    <div class="dropdown account">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            My Account
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <a class="dropdown-item" href="allworks.php">All Works</a>
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
        <div class="row">
            <?php include('errors.php'); ?>
            <?php include('success.php'); ?>
        </div>
        <div class="row">
            <button type="button" class="btn btn-new ml-auto" data-toggle="modal" data-target="#addwork">
                Add New Work
            </button>

            <div class="modal fade" id="addwork" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">New Work Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="employer.php" method="post">
                            <div class="modal-body">
                                <label for="name"> Work Name : </label>
                                <input type="text" name="name"><br>
                                <label for="strength"> No. of people req. : </label>
                                <input type="number" name="strength"><br>
                                <label for="hours"> Daily working hours : </label>
                                <input type="number" name="hours"><br>
                                <label for="wages"> Daily wages (in Rs/day) : </label>
                                <input type="number" name="wages"><br>
                                <label for="address"> Address : </label>
                                <textarea name="address" rows="3" id="address"></textarea><br>
                                <label for="date">Date : </label>
                                <input type="date" name="date">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type='submit' class="btn" value='Add' name='new_work'>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <p class="works">Latest Entries : </p>
        </div>
        <?php
            $query = mysqli_query($db,"SELECT * from work where `user_id` = $user_id order by `work_id` DESC") or die(mysqli_error($db));
        ?>
        <div class="row">
            <?php
                while($row = mysqli_fetch_array($query)) {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
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
                        <a href="view_work.php<?php echo '?id='.$row['work_id']; ?>" class="btn btn-new">View Details</a>
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