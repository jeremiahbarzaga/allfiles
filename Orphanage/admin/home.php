<?php

require_once("../admin/authchck.php");

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    echo  header("location:home.php");
}



?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    
</head>
<style>
.button{
    width:12%;
    height:10vh;
    margin-top:4%;
    margin-left:4%;
    border-radius:5px;
    background-color:#4b86b4;
    border:3px solid blue;
    font-size:15px;
    font-weight:bold;
    color:white;
    
    

    
}
button a{
    color:white;
   
}
body{
    
    
}
.logo{
    
}

</style>


<body>
<div class="logo" ><img src="IMG_6936.jpg" style="width:60%; height:65vh; margin-top:5%; margin-left:20%;"></div>
<form action="" method="post">
<button type="submit" class='button'><a href="schedule.php">VISITORS</a></button> 
<button type="submit" class='button'><a href="adminnews.php">NEWS</a></button>
<button type="submit" class='button'><a href="addnews.php">ADD NEWS</a></button>
<button type="submit" class='button' ><a href="livelihood.php"> Livelihood </a></button>
<button type="submit" class='button' ><a href="addlivelihood.php"> Add Livelihood </a></button>
<button type="submit" class='button' ><a href="settings.php"> Account Settings </a></button>

</form>



    
          
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
          
</body>


</html>