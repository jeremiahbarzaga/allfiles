<?php
require_once("../admin/authchck.php");

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    echo  header("location:home.php");
}
$host = "localhost";
$username="root";
$password="nakalimutanko";
$database="orphanage";
$con = new mysqli($host,$username,$password,$database);




if(isset($_POST['submit'])){
    
    $cpassword = $_POST['password'];
    $repassword = $_POST["repassword"];
    if($cpassword != $repassword){
        echo header("location:settings.php?msg=notmatch");

    }
    else
    {
	
	
	$username1 = "admintita";
	$password1 = $_POST['currentpass'];
	

	$checkinguser = "select * from login where username = '$username1' and password = '$password1'";
	$data = $con->query($checkinguser) or die ($con->error);
	$rows = $data->fetch_assoc();
	
	

	if(mysqli_num_rows($data) > 0)
	{
		
		
		$insertingnewpass = "Update login set password = '$cpassword' where id= 1";
	$data = $con->query($insertingnewpass) or die ($con->error);
	
	echo header("location:settings.php?msg=changesucceed");
		

		
	}    
	else{
	echo header("location:settings.php?msg=currentpass");
	}
    }


}



?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
</head>
<style>
.changepass{
    float:right;
    
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%,-50%);
	width: 350px;
	height: auto;
	padding: 80px 40px;
	box-sizing: border-box;
	background: rgba(0,0,0,.5);
}
button{
    width:20%;
    height:10vh;
    margin-top:4%;
    margin-left:2%;
    border-radius:5px;
    background-color:#4b86b4;
    border:3px solid blue;
    font-size:15px;
    font-weight:bold;
    color:white;
}
button a{
	color: white;
	
}
.LogInBox
{
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
.changepass p
{
	margin: 0;
	padding: 0;
	font-weight: bold; 
	color: #fff;
}
.changepass input
{
	width: 100%;
	margin-bottom: 20px;
}

.changepass input[type="text"],
.changepass input[type="Password"]
{
	border: none;
	border-bottom: 1px solid #fff;
	background: transparent;
	outline: none;
	height: 40px;
	color: #fff;
	font-size: 16px;
}
 
.changepass input[type="submit"]
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
.changepass input[type="submit"]:hover
{
	background: #FFFF00;
	color: #262626;
}
.changepass a
{
	color: #fff;
	font-size: 14px;
	font-weight: bold;
	text-decoration: none;
}

</style>
<body>

<form action="" method="post" autocomplete="off">


<div class="changepass">
		<img src="../admin/User_Icon.png" class="user">
		<h2> Changepass Here</h2>

		
		
            
        <p>Current Password</p>
			<input type="Password"  placeholder="Enter Password" name="currentpass" required>
            
			<p>New Password</p>
			<input type="Password"  placeholder="Enter Password" name="password" required>
            <p>Retype-Password</p>
			<input type="Password"  placeholder="Enter Password" name="repassword" required>

			<input type="submit"  value="Submit" name="submit">
			<?php if(isset($_GET['msg']) AND $_GET['msg'] == "currentpass")
		{
			echo "<h4 style=color:red>Current Password Not Match</h4>";
        }
        
        ?>
        	<?php if(isset($_GET['msg']) AND $_GET['msg'] == "notmatch")
		{
			echo "<h4 style=color:red>Password not match</h4>";
        }?>
        	<?php if(isset($_GET['msg']) AND $_GET['msg'] == "changesucceed")
		{
			echo "<h4 style=color:green>Changepass Success</h4>";
		}?>
			
			

		
    </div>
    
    </form>
    <form action="" method="post">

    <button type="submit" name="logout">LOGOUT</button>
	<br>
    <button type="submit" name="back"><a href="home.php">BACK</a> </button>
    </form>
    
</body>
</html>