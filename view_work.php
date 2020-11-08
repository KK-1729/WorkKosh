<?php
    include('session.php');
    $user_id = $_SESSION['id'];
    $errors = array();
    $success = "";
    $work_id = $_GET['id'];
    $query = mysqli_query($db, "SELECT * from work where work_id = $work_id");
    $row = mysqli_fetch_array($query);
    $workname = $row['name'];
    $applied = $row['applied'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel=" stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Navbar.css">
    <link rel="stylesheet" href="CSS/view_work.css">

    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>

    <title>Works Info | WORKKOSH</title>
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
                            <a class="dropdown-item" href="allworks.php">Active Works</a>
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
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="title">
                                    <?php echo $workname; ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 info">
                                <div class="applied">No. of people : <span><?php echo $applied ?></span></div>
                                <a href="#" class="btn btn-new">Attendence</a>
                            </div>
                        </div>
                                      
                        <div class="text">Workers List : </div>
                        <?php
                        $sql = "SELECT * FROM accepted LEFT JOIN profile on accepted.`user_id2`=profile.`user_id` order by accept_id DESC";
                        if($result = mysqli_query($db, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Name</th>";
                                            echo "<th>Phone</th>";
                                            echo "<th>Action</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    $i = 1;
                                    while($row = mysqli_fetch_array($result)){
                                        if($row['work_id']==$work_id){
                                        echo "<tr>";
                                            echo "<td>" . $i . "</td>";
                                            echo "<td>" . $row['fname']." ".$row['lname'] . "</td>";
                                            echo "<td>" . $row['phone'] . "</td>";
                                            echo "<td>";
                                                echo "View details";
                                            echo "</td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                }
                                    echo "</tbody>";                            
                                echo "</table>";
                            } 
                        }
                        ?>
                    </div>
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