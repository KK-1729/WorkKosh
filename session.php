<?php 
  session_start(); 

  if (!isset($_SESSION['id'])) {
  	header('location: signin.php');
  }
  $db = mysqli_connect('localhost', 'root', '','workkosh') or die ("Connection to database could not be established.");
  
?>