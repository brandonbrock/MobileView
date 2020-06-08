<?php
session_start();
include"connection.php";

if(isset($_POST["login"])){
	$username = $_POST["username"];
	$password_1 = $_POST["password_1"];
} else {
	$message = "Username and/or Password incorrect.\\nTry again.";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
	


$sql = "SELECT * FROM login WHERE username = '$username' and password_1 = '$password_1'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)==1){
	$_SESSION["username"] = $row["username"];
	$_SESSION["firstname"] = $row["firstname"];
	$_SESSION["surname"] = $row["surname"];
	$_SESSION["password_1"] = $row["password_1"];
	$_SESSION["password_2"] = $row["password_2"];
	$_SESSION["level"] = $row["level"];

	if($_SESSION["level"] == "admin"){
		header("Location: admin.php");
	}
	else{
		header("Location: profile.php");
	}
}
else {
	header("Location: loginForm.php");
}

?>