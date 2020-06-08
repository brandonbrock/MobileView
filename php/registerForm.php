<?php
session_start();
include"connection.php";
if(isset($_POST["username"])){
	$username=$_POST["username"];
	$firstname=$_POST["firstname"];
	$surname=$_POST["surname"];
	$password_1=$_POST["password_1"];
	$password_2=$_POST["password_2"];
	
	$sql = "INSERT INTO login(username, firstname, surname, password_1, password_2) VALUES ('$username','$firstname','$surname','$password_1','$password_2')";
	$result = mysqli_query($con,$sql);

	if($result){
		header("Location:../index.html");
	}else{
		echo "Error:".mysqli_error($con);
	}
}
?>
<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" type="text/css" media="all" href="../css/form-styles.css">
      <link rel="stylesheet" type="text/css" media="all" href="../css/styles.css">
   </head>
   <body>
      <header>
         <div class="nav-container">
            <div class="img-logo">
               <a href="index.html">
               <img src="../images/logov2.jpg" alt="company logo" class="logo">
               </a>
            </div>
            <div class="nav">
               <ul>
                  <li><a href="index.html">Home</a></li>
                  <li><a href="loginForm.php">Login</a></li>
               </ul>
            </div>
         </div>
      </header>
      <div class="header">
         <h2>Register</h2>
      </div>
      <form name="registerForm" method="post">
         <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Username" required>
         </div>
         <div class="input-group">
            <label>First Name</label>
            <input type="text" name="firstname" placeholder="First Name" required>
         </div>
         <div class="input-group">
            <label>Surname</label>
            <input type="text" name="surname" placeholder="Surname" required>
		</div>
         <div class="input-group">		 
            <label>Password</label>
            <input type="password" name="password_1" placeholder="Password" required>
         </div>
         <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="password_2" placeholder="Confirm Password" required>
			</div>
         <div class="input-group">
            <button type="submit" name="register" class="btn">Register</button>
         </div>
      </form>
      <div id="footer">
         <div class="wrap">
            <p>Last updated 17/01/19<br>&copy; 2018 - <a href="mailto:n0773065@my.ntu.ac.uk?subject=Your site is amazing">Brandon Brock</a></p>
         </div>
      </div>
   </body>
</html>