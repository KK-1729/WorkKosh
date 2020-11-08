<?php
    include('session.php');
    $user_id = $_SESSION['id'];
    $errors = array();
    $success = "";
    $work_id = $_GET['id'];

    if(isset($_POST['accept'])){
        $query1 = mysqli_query($db, "INSERT into accepted(`user_id2`, `work_id`) VALUES('$user_id', '$work_id')");
        $query2 = mysqli_query($db, "SELECT * from accepted where work_id = $work_id");
        $n = mysqli_num_rows($query2);
        $query3 = mysqli_query($db, "UPDATE work SET applied = ($n) where work_id = $work_id");
        header('location:employee.php');
        $success = "Congratulations! The work has been successfully accepted.";
    }
?>