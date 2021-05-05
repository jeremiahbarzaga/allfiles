<?php
error_reporting(0);
require_once("../admin/connectiondb.php");

if(isset($_GET['id']))
{
    $ID = $_GET['id'];
}
if(isset($_GET['tittles']))
{
    $tittle = $_GET['tittles'];
}

$query = "delete from liveimage where tittle = '$tittle'  ";
 $data = $con->query($query) or die ($con->error);
           
 $query1 = "delete from livelihooddata where id = '$ID'  ";
 $data1 = $con->query($query1) or die ($con->error);


 
if($data1){
   
    echo header("location:livelihood.php");
 
}
else{
    echo "Deleting Failed";
}
 
        
            
?>