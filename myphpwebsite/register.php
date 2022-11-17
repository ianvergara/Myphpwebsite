<!DOCTYPE html>
<html>
 <head>
 <title>My first PHP Website</title>

 </head>
 <body>
 <h2>Registration Page</h2>
 <a href="index.php">Click here to go back</a><br><br>
 <form action="register.php" method="POST">
 Enter Username: <input type="text" name="username"
required="required" /> <br/>
 Enter password: <input type="password" name="password"
required="required" /> <br/>
 <input type="submit" value="Register"/>
 </form>
 </body>
</html>

<?php
 $servername = "localhost";
 $username_db = "root";
 $password_db = "";
 $db_name = "first_db";

 $conn = mysqli_connect($servername, $username_db, $password_db,$db_name);


 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
 }
 echo "Connected successfully<br>";

 if($_SERVER["REQUEST_METHOD"] == "POST"){
 $username=mysqli_real_escape_string($conn, $_POST['username']);
 $password=mysqli_real_escape_string($conn, $_POST['password']);
 $bool=true;

 $query = mysqli_query($conn, "Select * from users_tbl"); 

 while($row=mysqli_fetch_array($query)) 
 {
 $table_users=$row['username']; 
 if($username==$table_users)
 {
 $bool=false; 
 Print '<script>alert("Username is not available!");</script>';
 Print '<script>window.location.assign("register.php");</script>';
 }
 }
 if($bool){
 mysqli_query($conn,"INSERT INTO users_tbl (username, password) VALUES('$username','$password')"); 
 Print '<script>alert("Successfully Registered");</script>'; 
 Print '<script>window.location.assign("register.php");</script>';

 }
}?>