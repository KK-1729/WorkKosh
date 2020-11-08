<?php
    session_start();

    $errors = array();

    // Connecting to database
    $db = mysqli_connect('localhost', 'root', '','workkosh') or die ("Connection to database could not be established.");

    // Registering Users
    if (isset($_POST['signup'])) {
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $password1 = mysqli_real_escape_string($db,$_POST['password1']);
        $password2 = mysqli_real_escape_string($db,$_POST['password2']);
        $type = $_POST['type'];

        // Checking for errors in form
        if($type == 0){array_push($errors, "Please select an account type.");}
        if(empty($email)){array_push($errors, "Email is required");}
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalid Email Format");
        }
        if(empty($password1)){array_push($errors, "Password is required");}
        if (strlen($password1) < '8') {
            array_push($errors, "Password Must Contain At Least 8 Characters!");
        }
        if(!preg_match("#[0-9]+#",$password1)) {
            array_push($errors, "Password Must Contain At Least 1 Number!");
        }
        if(!preg_match("#[A-Z]+#",$password1)) {
            array_push($errors, "Password Must Contain At Least 1 Capital Letter!");
        }
        if(!preg_match("#[a-z]+#",$password1)) {
            array_push($errors, "Password Must Contain At Least 1 Lowercase Letter!");
        }
        if(empty($password2)){array_push($errors, "Please Confirm the Password");}
        if ($password1 != $password2){array_push($errors, "The Passwords do not match");}
        // Making Email unique
        $user_check = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $results = mysqli_query($db, $user_check);
        $user = mysqli_fetch_assoc($results);

        if ($user){
            if($user['email'] === $email){array_push($errors, "Email already exits!");}
        }

        // Register the user if there are no errors
        if(count($errors) == 0){
            $password = md5($password1);  //To encrypt the password
            $query1 = "INSERT INTO users (email, password, type) VALUES ('$email', '$password', '$type')";
            $result = mysqli_query($db, $query1);
            if($result){
                $query1 = "SELECT * FROM users WHERE email='$email' AND password='$password'";
                $results = mysqli_query($db, $query1);
                $row = mysqli_fetch_array($results);
                $user_id = $row['id'];
                if($type==1){
                    $query2 = "INSERT INTO profile (`user_id`) VALUES ('$user_id')";
                    mysqli_query($db, $query2);
                }
                if($type==2){
                    $query2 = "INSERT INTO profile (`user_id`, min_wages, max_hours) VALUES ('$user_id', 100, 10)";
                    mysqli_query($db, $query2);
                }
            }
            $_SESSION['success'] = "You are now registered";
            header('location: signin.php');
        }
    }

    // To Log into the website
    if (isset($_POST['signin'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
    
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
    
        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $results = mysqli_query($db, $query);
            $row = mysqli_fetch_array($results);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['success'] = "You are now logged in";
                $account = $row['type'];
                if($account == 1){
                    header('location: employer.php');
                }
                if($account == 2){
                    header('location: employee.php');
                }
            }else {
                array_push($errors, "Invalid Credentials");
            }
        }
    }
?>