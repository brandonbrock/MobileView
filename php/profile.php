<?php
   session_start();
   include"connection.php"; 
   if(!isset($_SESSION['username'])){ 
  header("location: loginForm.php"); // Redirecting To Home Page 
}

	//variables 
	$username = "";
	$firstname = "";
	$surname = "";
	$password_1 = "";
	$password_2 = "";
	$level = "";
      
   //update users info
if(isset($_POST['update_profile'])){
	$id = $_POST['id'];
	$username = $_POST['username'];
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$password_1 = $_POST['password_1'];
	$password_2 = $_POST['password_2'];
	$level=$_POST["level"];
	
	mysqli_query($con,"UPDATE login SET username='$username',firstname='$firstname',surname='$surname',password_1='$password_1',password_2='$password_2', level='$level' WHERE id=$id");
	header('location: profile.php');
}
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>moblieView</title>
      <meta name="viewport" content="width=device-width, inital-scale=1.0">
      <link rel="stylesheet" type="text/css" media="all" href="../css/styles.css">
      <link rel="stylesheet" type="text/css" media="all" href="../css/form-styles.css">
   </head>
   <body>
      <header>
         <div class="nav-container">
            <div class="img-logo">
               <a href="../index.html">
               <img src="../images/logov2.jpg" alt="company logo" class="logo">
               </a>
            </div>
            <div class="nav">
               <ul>
                  <li><a href="../index.html">Home</a></li>
                  <?php 
                     if(isset($_SESSION['username'])){?>
                  <li><a href="logout.php">Logout</a></li>
                  <?php }else{ ?>
                  <li><a href="loginForm.php">Login</a></li>
                  <?php } 				  
				  if($level = "admin") {
				  ?>
				  <li><a href="admin.php">Admin</a></li>
				  <?php } ?>
               </ul>
            </div>
         </div>
      </header>
      <div class="header">
         <h2>User Details</h2>
      </div>
      <form name="profile" method="post">
         <input type="hidden" name="id" value="<?php echo $id; ?>">
         <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>">
         </div>
         <div class="input-group">
            <label>First Name</label>
            <input type="text" name="firstname" value="<?php echo $_SESSION['firstname']; ?>">
         </div>
         <div class="input-group">
            <label>Surname</label>
            <input type="text" name="surname" value="<?php echo $_SESSION['surname']; ?>">
         </div>
         <div class="input-group">		 
            <label>Password</label>
            <input type="password" name="password_1" value="<?php echo $_SESSION['password_1']; ?>">
         </div>
         <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="password_2" value="<?php echo $_SESSION['password_2']; ?>">
         </div>
		 <input type="hidden" name="level" value="<?php echo $level; ?>">
         <div class="input-group">
            <button type="submit" name="update_profile" class="btn">Update</button>
         </div>
      </form>
      <div id="footer">
         <div class="wrap">
            <p>Last updated 17/01/19<br>&copy; 2018 - <a href="mailto:n0773065@my.ntu.ac.uk?subject=Your site is amazing">Brandon Brock</a></p>
         </div>
      </div>
   </body>
</html>
