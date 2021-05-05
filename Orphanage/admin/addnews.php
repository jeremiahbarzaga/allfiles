<?php
require_once("../admin/authchck.php");
require_once("../admin/connectiondb.php");


if(isset($_GET['id'])){
  $ID = $_GET['id'];
  
}
if(isset($_GET['tittles'])){
  $newstittle = $_GET['tittles'];
}
if(isset($_GET['descriptions'])){
  $newsdes = $_GET['descriptions'];
}
if(isset($_GET['status'])){
  $status = $_GET['status'];
}



    if(isset($_POST['submit']))
    {   $tittle = $_POST['tittle'];
      $description = $_POST['description'];
         
        
        

        
          $tittle = $_POST['tittle'];
          $description = $_POST['description'];
             
                $checkingtittles = "select * from newsdata where tittle = '$tittle' ";
                $data = $con->query($checkingtittles) or die ($con->error);
                $rows = $data->fetch_assoc();

                if(mysqli_num_rows($data) > 0)
                {
                    echo  header("location:addnews.php?msg=error");
                }    
                else{
                $query = "INSERT INTO `newsdata`( `tittle`, `description`) VALUES ('$tittle','$description')";
                $data = $con->query($query) or die ($con->error);
            
                

            $imagecount = count($_FILES['image']['name']);
                
            for($i = 0;$i<$imagecount;$i++)
            {
                $imagename = $_FILES['image']['name'][$i];
                $imagetempname = $_FILES['image']['tmp_name'][$i];
                $targetpath = "../admin/images/".$imagename;
                if(move_uploaded_file($imagetempname,$targetpath))
                {
                    $query = "INSERT INTO `newsimage`(`tittle`, `img_dir`) VALUES ('$tittle','$targetpath')";
                    $data = $con->query($query) or die ($con->error);
              
                $result = mysqli_query($con,$insertingimagequery);
                }
                
            }
            
                    echo  header("location:addnews.php?msg=success");
                
            


            }
        
        
          
    }
       


?>


<!Doctype html>
<html lang="eng">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   
</head>
<style type="text/css">
   .formdesign{

       border:2px solid;
       height:auto;
       width:60%;
       margin-left:20%;
      
       

       
       
   }
   h2{
       text-align:center;
   }
   
   #tittle{
        margin-top:5%;
       width:80%;
       margin-left:10%;
   }
   #description{
       height:auto;
       width:80%;
       margin-top:5%;
       margin-left:10%;
   }
   #file{
       margin-left:5%;
       margin-top:10%;
       
   }
   
   
   #submit{
       width:30%;
       margin-left:30%;
       margin-top:3%;
       height:5vh;
       margin-bottom:5%;
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
#news{
   
    margin-left:45%;
    
}
body{
     background: whitesmoke;
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

    
    
    <div class="formdesign">
       <div >
           <h2 >AddNews</h2>
       <?php if(isset($_GET['msg']) AND $_GET['msg'] == "success"){
               echo '<h4 style=color:green>Upload Successful<h4>';

           }
           if(isset($_GET['msg']) AND $_GET['msg'] == "error"){
            echo '<h4 style=color:red>Tittle Is Not Available<h4>';

        }


            ?>
       <form action="" method="post" enctype="multipart/form-data">
           
            
            <div>
            <input type="text" name="tittle" id="tittle" placeholder="Tittle :" value="" required>
            
            <textarea name="description" placeholder="Description:" id="description"  ></textarea>
            
            </div>

           
            <input type="file" name="image[]"  multiple accept=".jpg, .png" id="file"> 
            <br>
            <input type="submit" name="submit"  value="Upload TO NEWS" id="submit"> 
            
            </form>
           
        </div>
    
    
    </div>
</body>

</html>