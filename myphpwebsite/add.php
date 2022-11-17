<?php
 session_start();
 if($_SESSION['user']){
 }
 else{
 header("location:index.php");
 }
 $servername = "localhost";
 $username_db = "root";
 $password_db = "";
 $db_name = "first_db";
 
 $conn = mysqli_connect($servername, $username_db, $password_db, $db_name);
 
 if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
 }
 if($_SERVER['REQUEST_METHOD'] == "POST")
 {
 $details = mysqli_real_escape_string($conn,$_POST['details']);
 $time = strftime("%X"); 
 $date = strftime("%B %d, %Y"); 
 $decision = "no";

 foreach($_POST['public'] as &$each_check) 
 {
 if($each_check != null){ 
 $decision = "yes"; 
 }
 }

 mysqli_query($conn,"INSERT INTO list_tbl(details, date_posted, time_posted,
public) VALUES ('$details','$date','$time','$decision')"); 
 header("location:home.php");
 }
 else
 {
 header("location:home.php");
 }
?>
