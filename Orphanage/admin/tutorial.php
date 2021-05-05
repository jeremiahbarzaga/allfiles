
<?php 
$host = "localhost";
$username="root";
$password="nakalimutanko";
$database="tutorial";
$con = new mysqli($host,$username,$password,$database);


if(isset($_POST['add'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $insertingtittles = "insert into students_info(name , age , address) values('$name','$age','$address') ";
    $data = $con->query($insertingtittles) or die ($con->error);


    echo header("location:tutorial.php");
}


?>



<style>
table , tr , td , th{
    border: 1px solid;
    border-collapse:collapse;
    padding:3px;
}


</style>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
<th>Id</th>
<th>Name</th>
<th>Age</th>
<th>Address</th>

<?php

$checkingdata = "select * from students_info ";
$data = $con->query($checkingdata) or die ($con->error);
while($rows = $data->fetch_assoc()){
    $name = $rows['Name'];
    $id = $rows['Id'];
    $age = $rows['age'];
    $address = $rows['address'];
    echo "<tr>";
  
    echo "<td> $id</td>";
    echo "<td> $name</td>";
    echo "<td> $age</td>";
    echo "<td> $address</td>";
    echo "</tr>";

    
}


?>




</table>

<form action="" method="post">


<div class="addborder">

<input type="text" name="name" id="name" placeholder="Name" required>
<input type="text" name="age" id="age" placeholder="age" required>
<input type="text" name="address"  id="address" placeholder="address" required>

<input type="submit" value="ADD New" name="add">
</form>


</div>

    
</body>
</html>