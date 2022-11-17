<?php
 session_start();

 $servername = "localhost";
 $username_db = "root";
 $password_db = "";
 $db_name = "first_db";

 $conn = mysqli_connect($servername, $username_db, $password_db,
$db_name);
 
 if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
 }
 if($_SERVER["REQUEST_METHOD"] == "POST"){
 $username=mysqli_real_escape_string($conn, $_POST['username']);
 $password=mysqli_real_escape_string($conn, $_POST['password']);
 $bool=true;

 $query = mysqli_query($conn,"Select * from users_tbl WHERE
username='$username'"); 
 $exists = mysqli_num_rows($query); 
 $table_users = "";
 $table_password = "";
 if($exists > 0) 
 {
 while($row = mysqli_fetch_assoc($query)) 
 {
 $table_users = $row['username']; 
 $table_password = $row['password']; 
 }
 if(($username == $table_users) && ($password == $table_password))
 {
 if($password == $table_password)
 {
 $_SESSION['user'] = $username; 

 header("location: home.php"); 
 }
 }
 else
 {
 Print '<script>alert("Incorrect Password!");</script>'; 
 Print '<script>window.location.assign("login.php");</script>'; 
 }
 }
 else
 {
 Print '<script>alert("Incorrect username!");</script>'; 

 Print '<script>window.location.assign("login.php");</script>';

 }
 }
?>