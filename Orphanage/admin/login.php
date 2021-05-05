 <?php

session_start();
require_once("../admin/connectiondb.php");



if(isset($_POST['submit'])){
	
	
	
	$username1 = $_POST['username'];
	$password1 = $_POST['password'];
	$username1 = stripcslashes($username1);
	$password1 = stripcslashes($password1);
	

	$checkinguser = "select * from login where username = '$username1' and password = '$password1'";
	$data = $con->query($checkinguser) or die ($con->error);
	$rows = $data->fetch_assoc();
	
	

	if(mysqli_num_rows($data) > 0)
	{
		$_SESSION['userid'] = TRUE;
		
		echo  header("location:home.php");
		

		
	}    
	else{
	echo header("location:login.php?msg=loginfailed");
	}



}

if(isset($_POST['abc'])){
	echo header("location:login.php?msg=forgotpassword");

}




?> 


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Login Page</title>
<style>
	
.logo img{
	margin-right:20%;
}
.LogInBox
{
	position: absolute;
	top: 15%;
	left: 60%;
	width: 350px;
	background-color:green;
	padding: 50px 10px;
	border-radius:5px;
	border:1px solid;
}
.user 
{ 
	width: 100px;
	height: 100px; 
	border-radius: 50%;
	overflow: hidden;
	position: absolute;
	top: calc(-100px/2);
	left:  calc(50% - 50px);

}
h2
{ 
	margin: 0;
	padding: 0 0 20px;
	color: #efed40;
	text-align: center;
}

.LogInBox p
{
	margin: 0;
	padding: 0;
	font-weight: bold; 
	color: #fff;
}
.LogInBox input
{
	width: 100%;
	margin-bottom: 20px;
}

.LogInBox input[type="text"],
.LogInBox input[type="Password"]
{
	border: none;
	border-bottom: 1px solid #fff;
	
	outline: none;
	height: 40px;
	
	font-size: 16px;
}
 
.LogInBox input[type="submit"]
{
	border: none;
	outline: none;
	height:  40px;
	color: #fff;
	font-size: 16px;
	background: #008080;
	cursor: pointer;
	border-radius: 20px;
}
.LogInBox input[type="submit"]:hover
{
	background: #FFFF00;
	color: #262626;
}
.LogInBox a
{
	color: #fff;
	font-size: 14px;
	font-weight: bold;
	text-decoration: none;
}

	</style>
</head>

<body>
<div class="logo">
	<img src="../admin/mainlogo2.jpg" alt="">
</div>
	<div class="LogInBox">
		
		<img src="../admin/User_Icon.png" class="user">
		<h2> Log In Here</h2>

		
		<form action="" method="post" autocomplete="off">
			<p>Username</p>
			
			<input type="text"   placeholder="Enter Username" name="username" required>

			<p>Password</p>
			<input type="Password"  placeholder="Enter Password" name="password" required>

			<input type="submit"  value="Log In" name="submit">
			
			<?php if(isset($_GET['msg']) AND $_GET['msg'] == "loginfailed")
		{
			echo "<h4 style=color:red>Login Failed</h4>";
		}
		?>

	
			
			</form>

		
	</div>


	

</body>

</html>