<?php

require_once("../admin/authchck.php");
require_once("../admin/connectiondb.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

}


if(isset($_GET['name']))
{
    $name = $_GET['name'];

}


if(isset($_GET['date']))
{
    $date = $_GET['date'];

}






if(isset($_POST['submit'])){
  $status = $_POST['status'];
  if($status== "REMOVE")
  {
    $query1 = "Delete from bookings  where Id = '$id'";
    $data1 = $con->query($query1) or die ($con->error);

    echo header("location:schedule.php");

  }
  else
  {
    
    $query1 = "Update bookings set status = '$status' where Id = '$id'";
    $data1 = $con->query($query1) or die ($con->error);

    echo header("location:schedule.php");

  }

}
 



?>





<!doctype html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    
  </head>
  <style>


#news{
   
    margin-left:45%;
    
}

  .nav{
  background: #0082e6;
  height: 90px;
  width: 100%;
  margin-bottom:10%;

}

nav ul{
  float: right;
  margin-right: 20px;
}
nav ul li{
  display: inline-block;
  line-height: 80px;
  margin: 0 5px;
}
nav ul li a{
  color: white;
  font-size: 17px;
  padding: 7px 13px;
  border-radius: 3px;
  text-transform: uppercase;
}
a.active,a:hover{
  background: #1b9bff;
  transition: .5s;
}
.checkbtn{
  font-size: 30px;
  color: white;
  float: right;
  line-height: 80px;
  margin-right: 40px;
  cursor: pointer;
  display: none;
}
#check{
  display: none;
}
@media (max-width: 952px){
  label.logo{
   
    margin-top:5%;
    margin-left:5px;
    width:10px;
  }
  
  nav ul li a{
    font-size: 13px;
  }
  .content-wrapper p{
    width: 100%;
    font-size: auto;
  }
}
@media (max-width: 858px){
  .checkbtn{
    display: block;
  }
  
  ul{
    position: fixed;
    width: 100%;
    height: 100vh;
    background: #2c3e50;
    top: 80px;
    left: -100%;
    text-align: center;
    transition: all .5s;
  }
  nav ul li{
    display: block;
    margin: 50px 0;
    line-height: 30px;
  }
  nav ul li a{
    font-size: 15px;
  }
  a:hover,a.active{
    background: none;
    color: #0082e6;
  }
  #check:checked ~ ul{
    left: 0;
    
  }
}
  </style>
  

  <body>

  
  <div class="nav">
      <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
          <i class="fas fa-bars"></i>
        </label>
        <label class="logo"> <img src="../Lingap-Bata-Patag/home/LatestLogo.jpg" style="width: 38vh; height: 11vh;  margin-left:0;" id="logo"></label>
        <ul>
        <li><a  href="../admin/home.php" target="_self">Home</a></li>
        <li><a class="" href="adminnews.php">News</a></li>
          <li><a class="active" href="../admin/addnews.php">Add News</a></li>
          <li><a  href="../admin/schedule.php">Visitors</a></li>
        </ul>
      </nav>
    </div>  
                 
            
    <div class="container">
        <h1 class="text-center">Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1><hr>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
               <?php echo isset($msg)?$msg:''; ?>
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $name;?>" readonly>
                    </div>
                    <div class="form-group">
                                         </div>
                    <div class="form-group">
                        
                    </div>
                    <div class="time">
                        <select class="form-control" name = "status" id ="status">
                            <option>PRESENT</option>
                            
                            <option>ABSENT</option>
                            <option>REMOVE</option>
                           
                        </select>
                        <br>
                    </div>
                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                   
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>

</html>