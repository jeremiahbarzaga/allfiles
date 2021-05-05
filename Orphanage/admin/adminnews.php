




<!Doctype html>
<html lang="eng">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
   
</head>

    <style>
    .description{
        
        margin:auto;
        height:auto;
        border:.5px solid;
        width:50%;
        padding:10px;
        border-radius: 10px;
        background:#0082e6;
        color: white;
        font-size: 25px;
        font-weight: 500
       
    }
    
   


nav{
    background: #0082e6;
    height: 90px;
    width: 100%;
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
  a{
      color:white;
    }
  #check{
    display: none;
  }
  @media (max-width: 952px){
    label.logo{
     
      margin-top:5%;
      margin-left:0;
      width:10px;
      
      
      
    }
    
   
    
    nav ul li a{
      font-size: 16px;
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
      background-color:#0082e6 ;
      top: 80px;
      left: -110%;
      text-align: center;
      transition: all .5s;
      z-index: 10;
    }
    nav ul li{
      display: block;
      margin: 40px 0;
      line-height: 30px;
      color: white;
    }
    nav ul li a{
      font-size: 20px;
      
    }
    a:hover,a.active{
      background: none;
      
    }
    #check:checked ~ ul{
      left: 0;
      
    }
  }

.news{
    
    margin-left:45%;
    
}
.nomorenews{
    margin-left:38%;
    color:blue;
}

  h2{
    color: black;
    font-weight:bold;
  }
  footer{
    margin-top: 100px;
    bottom: 0px;
    width: 100%;
    float: left;
  }
  .main-content{
    display: flex;
    background: #2a4d69;
  }
  .content p{
    font-size: 15px;

  }
  .main-content .box{
    flex-basis: 50%;
    padding: 10px 20px;
  }
  .box h2{
    font-size: 20px;
    font-weight: 600;
    text-transform: uppercase;
    color: #d9d9d9;
  }
  .box .content{
    margin: 20px 0 0 0;
    position: relative;
  }
  .box .content:before{
    position: absolute;
    content: '';
    top: -10px;
    height: 2px;
    width: 100%;
    background: rgb(14, 204, 230);
  }
  .box .content:after{
    position: absolute;
    content: '';
    height: 2px;
    width: 15%;
    background: blue;
    top: -10px;
  }
  .left .content p{
    text-align: justify;
  }
  .left .content .social{
    margin: 20px 0 0 0;
  }
  .left .content .social a{
    padding: 0 2px;
  }
  .left .content .social a span{
    height: 40px;
    width: 40px;
    background: #1a1a1a;
    line-height: 40px;
    text-align: center;
    font-size: 18px;
    border-radius: 5px;
    transition: 0.3s;
  }
  .left .content .social a span:hover{
    background: rgb(201, 201, 110);
  }
  .center .content .fas{
    font-size: 15px;
    background: #1a1a1a;
    height: 45px;
    width: 45px;
    line-height: 45px;
    text-align: center;
    border-radius: 50%;
    transition: 0.3s;
    cursor: pointer;
  }
  .center .content .fas:hover{
    background: rgb(226, 226, 70);
  }
  .center .content .text{
    font-size: 15px;
    font-weight: 500;
    padding-left: 10px;
  }
  .center .content .phone{
    margin: 15px 0;
  }
  .content{
    margin-top: 10px;
    color: #d9d9d9;
    
  }
  .box ul{
    
    font-weight: bold;
    margin-top: 5px;
    color: #d9d9d9;
    font-size: 18px;
   
   
  }
  .content .box li a{
    color: #d9d9d9;
    margin-top: 5px;
  }
  .content .box li a:hover{
   color: #656565;
   cursor: pointer;
   transition-duration: 1s;
  
   
   
  }
  
  
  .bottom center{
    padding: 5px;
    font-size: 0.9375rem;
    background: #151515;
  }
  .bottom center span{
    color: #656565;
  }
  .bottom center a{
    color: #f12020;
    text-decoration: none;
  }
  .bottom center a:hover{
    text-decoration: underline;
  }
  @media screen and (max-width: 900px) {
    footer{
      position: relative;
      bottom: 0px;
    }
    .main-content{
      flex-wrap: wrap;
      flex-direction: column;
    }
    .main-content .box{
      margin: 5px 0;
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
      <li><a  href="home.php" target="_self">Home</a></li>
        <li><a class="active" href="adminnews.php">News</a></li>
        <li><a class="" href="addnews.php">Add News</a></li>
        <li><a href="schedule.php">Visitors</a></li>
         </ul>
    </nav>
  </div>
               
                 


    <h1 class="news">News</h1>
    <form action="" method="post">
          <?php 
            require_once("../admin/connectiondb.php");

              $checkingtittles = "select * from newsdata ORDER BY Id DESC  ";
              $data = $con->query($checkingtittles) or die ($con->error);
              
            
              while($rows = $data->fetch_assoc())
              {
                  
                  $tittle = $rows['tittle'];
                  $description = $rows['description'];
                  $ID = $rows['Id'];
                  $newstittle = $rows['tittle'];
                  $newsdesc = $rows['description'];
                  
                  ?>
                  <div class ="description">
                  <h2><?php echo $tittle; ?></h2>
                  <h3 style="color:white"><?php echo $description;?></h3>

                  
                  
                  
                  <div class="image">
                  <?php
                  $checkingimagetittles = "select * from newsimage where tittle = '$tittle' ";
                  $imagetittledata = $con->query($checkingimagetittles) or die ($con->error);
                  while($rows1 = $imagetittledata->fetch_assoc())
                  {
                      $imagedirectory = $rows1['img_dir'];
                      

                      echo "<img src='$imagedirectory' width='20%' height='20%'>";
                      
                  }
                  $status = "EDIT";
                  ?> 
                  
                    
                    
                    <h5><?php echo " <a href=editnews.php?id=$ID&tittles=$tittle&descriptions=$description >Edit</a>"?></h5>
                    <h5><?php echo " <a href=delete.php?id=$ID&tittles=$tittle >Delete</a>"?></h5>
                    
                    
                  
                  

                    
                  </div>
                  </div>
                

                  <br>
                  <br>
                
                  <?php

            
              
              }?>
    </form>

    <?php
               if(isset($_POST['delete'])){
                 echo "sasdasdsad";
               }
              
              
              
              ?>
    
    <h1 class="nomorenews">No More Available News</h1>
    
    <footer>
          <div class="main-content">
            <div class="left box">
              <h2>About us</h2>
              <div class="content">
                <p>Lingap Bata Center is located in Sta. Maria, Bulacan. It is an all boys orphanage maintained and supported by the Immaculate Parish and some volunteers. The children are aged 4 and older. They are sent to school and are taught by volunteers of extra curricular activities. </p>
                <div class="social">
                  <a href="https://facebook.com"><span class="fab fa-facebook-f"></span></a>
                  <a href="https://instagram.com"><span class="fab fa-instagram"></span></a>
                  
                </div>
              </div>
            </div>
    
            <div class="center box">
              <h2>Contact Info</h2>
              <div class="content">
                <div class="place">
                  <span class="fas fa-map-marker-alt"></span>
                  <span class="text">San jose patag.Sta.maria.Bulacan</span>
                </div>
                <div class="phone">
                  <span class="fas fa-phone-alt"></span>
                  <span class="text">09285637282</span>
                </div>
                <div class="email">
                  <span class="fas fa-envelope"></span>
                  <span class="text">lingapbatacenter@gmail.com</span>
                </div>
              </div>
            </div>
    
            <div class="right box">
              <h2>Useful Link</h2>
              <div class="content">
                <ul class="box">
                  <li><a href="../home/home1.html">Home</a></li>
                  <li><a href="../aboutuspage/about.html">About</a</li>
                  <li><a href="../contact/contactpage.html">Contact</a></li>
                  <li><a href="../livelihood/livelihoodpage.html">Livelihood</a></li>
                </ul>
                
              </div>
            </div>
          </div>
          <div class="bottom">
            <center>
              <span class="credit">Created By <a href="https://www.facebook.com">JJAMS</a> | </span>
              <span class="far fa-copyright"></span><span> 2020 All rights reserved.</span>
            </center>
          </div>
        </footer>

</body>

</html>