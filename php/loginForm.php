<?php
session_start();
include"connection.php";
?>

<html>
   <head>
      <link rel="stylesheet" type="text/css" media="all" href="../css/form-styles.css">
      <link rel="stylesheet" type="text/css" media="all" href="../css/styles.css">
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
				  <?php } ?>
               </ul>
            </div>
         </div>
		</header>
		 
		 	  <?php
	  if(!isset($_SESSION["username"])){
		  echo
		  "<div class=\"header\">
				<h2>Login</h2>
			</div>
			<form action=\"login.php\" method=\"post\">
			<div class=\"input-group\">
			Username <input type=\"text\" name=\"username\" placeholder=\"John123\" required>
			</div>
			<div class=\"input-group\">
		  <p>Password <input type=\"password\" name=\"password_1\" placeholder=\"1234\" required><p>
		  </div>
		  <div class=\"input-group\">
		  <button type=\"submit\" name=\"login\" class=\"btn\">Login</button>
		  </div>
		  <p>Not yet a member? <a href=\"registerForm.php\">Sign up</a></p>
		  </form>";
	  }
	  else {
			echo "You are logged in.";
		}		
		 ?>

      <div id="footer">
         <div class="wrap">
            <p>Last updated 17/01/19<br>&copy; 2018 - <a href="mailto:n0773065@my.ntu.ac.uk?subject=Your site is amazing">Brandon Brock</a></p>
         </div>
      </div>
   </body>
</html>
