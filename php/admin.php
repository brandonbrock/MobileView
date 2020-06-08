<?php
session_start();
include"connection.php";	

if (!isset($_SESSION['level']) || ($_SESSION['level'] != "admin")) {
    header('Location: ../index.html');
    exit;
}

//variables 
$username = "";
$firstname = "";
$surname = "";
$password_1 = "";
$password_2 = "";
$level = "";
$id = 0;
$update_state = false;

//if save button is clicked
if(isset($_POST["save"])){
	$username=$_POST["username"];
	$firstname=$_POST["firstname"];
	$surname=$_POST["surname"];
	$password_1=$_POST["password_1"];
	$password_2=$_POST["password_2"];
	$level=$_POST["level"];
	
	$sql = "INSERT INTO login(username, firstname, surname, password_1, password_2, level) VALUES ('$username','$firstname','$surname','$password_1','$password_2','$level')";
	mysqli_query($con,$sql);
	header("Location:admin.php");
}

//displaying users
$results = mysqli_query($con,"SELECT * FROM login");

//update users info
if(isset($_POST['update'])){
	$id = $_POST['id'];
	$username = $_POST['username'];
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$password_1 = $_POST['password_1'];
	$password_2 = $_POST['password_2'];
	$level=$_POST["level"];
	
	mysqli_query($con,"UPDATE login SET username='$username',firstname='$firstname',surname='$surname',password_1='$password_1',password_2='$password_2',level='$level' WHERE id=$id");
	header('location: admin.php');
}

//get the record to update
if(isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update_state = true;
	$rec = mysqli_query($con, "SELECT * FROM login WHERE id=$id");
	$record = mysqli_fetch_array($rec);
	$username=$record["username"];
	$firstname=$record["firstname"];
	$surname=$record["surname"];
	$password_1=$record["password_1"];
	$password_2=$record["password_2"];
	$level=$record["level"];
	$id=$record['id'];
}

//delete records
if(isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($con, "DELETE FROM login WHERE id=$id");
	header('location: admin.php');
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
<br>
	<table>
		<thead>
			<tr>
				<th>Username</th>
				<th>First Name</th>
				<th>Surname</th>
				<th>Password</th>
				<th>Confirm Password</th>
				<th>Account Type</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			while($row = mysqli_fetch_array($results)){ ?>
			<tr>
				<td><?php echo $row['username'];?></td>
				<td><?php echo $row['firstname'];?></td>
				<td><?php echo $row['surname'];?></td>
				<td><?php echo $row['password_1'];?></td>
				<td><?php echo $row['password_2'];?></td>
				<td><?php echo $row['level'];?></td>
				<td>
					<a href="admin.php?edit=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
				</td>
				<td>
					<a href="admin.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
				</td>
			</tr>
			<?php }
			?>
		</tbody>
	</table>
	<div class="header">
				<h2>Admin Panel</h2>
			</div>
	      <form name="admin" method="post">
		  <input type="hidden" name="id" value="<?php echo $id; ?>">
         <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
         </div>
         <div class="input-group">
            <label>First Name</label>
            <input type="text" name="firstname" value="<?php echo $firstname; ?>">
         </div>
         <div class="input-group">
            <label>Surname</label>
            <input type="text" name="surname" value="<?php echo $surname; ?>">
		</div>
         <div class="input-group">		 
            <label>Password</label>
            <input type="password" name="password_1" value="<?php echo $password_1; ?>">
         </div>
         <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="password_2" value="<?php echo $password_2; ?>">
			</div>
         <div class="input-group">
            <label>Account Type</label>
            <input type="text" name="level" value="<?php echo $level; ?>">
			</div>
         <div class="input-group">
		 <?php if ($update_state == false): ?>
		 <button type="submit" name="save" class="btn">Save</button>
		 <?php else: ?>
		 <button type="submit" name="update" class="btn">Update</button>
		 <?php endif ?>
         </div>
      </form>
	        <div id="footer">
      <div class="wrap">
      <p>Last updated 17/01/19<br>&copy; 2018 - <a href="mailto:n0773065@my.ntu.ac.uk?subject=Your site is amazing">Brandon Brock</a></p>
      </div>
      </div>
</body>
</html>