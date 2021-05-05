<?php

function build_calendar($month, $year) {

    //paglagay ng Booked Date sa $bookings Array .
     $mysqli = new mysqli('sql304.epizy.com', 'epiz_28533395', '1lvYCSK4WKh93M', 'epiz_28533395_Orphanage');
    $stmt = $mysqli->prepare("select * from bookings where MONTH(date) = ? AND YEAR(date) = ?");
    $stmt->bind_param('ss', $month, $year);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['date'];
                

                
            }
            
            $stmt->close();
        }
    }

    
    
    
    
    
     // Create array containing abbreviations of days of week.
     $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

     // What is the first day of the month in question?
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

     // How many days does this month contain?
     $numberDays = date('t',$firstDayOfMonth);

     // Retrieve some information about the first day of the
     // month in question.
     $dateComponents = getdate($firstDayOfMonth);

     // What is the name of the month in question?
     $monthName = $dateComponents['month'];

     // What is the index value (0-6) of the first day of the
     // month in question.
     $dayOfWeek = $dateComponents['wday'];

     // Create the table tag opener and day headers
     
    $datetoday = date('Y-m-d');
    
    
    
    $calendar = "<table >";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
    
    $calendar.= " <a class='btn btn-xs btn-primary' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
    
    $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></center><br>";
    
    
        
      $calendar .= "<tr>";

     // Create the calendar headers

     foreach($daysOfWeek as $day) {
          $calendar .= "<th  >$day</th>";
     } 

     // Create the rest of the calendar

     // Initiate the day counter, starting with the 1st.

     $currentDay = 1;

     $calendar .= "</tr><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

     if ($dayOfWeek > 0) { 
         for($k=0;$k<$dayOfWeek;$k++){
                $calendar .= "<td ></td>"; 

         }
     }
    
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while ($currentDay <= $numberDays) {
            
          // Seventh column (Saturday) reached. Start a new row.

          if ($dayOfWeek == 7) {

               $dayOfWeek = 0;
               $calendar .= "</tr><tr>";

          }
          $year = date('Y');
          $months = date('m');
          $datatime = $year."-".$months."-".$currentDay;
          
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          $date = "$year-$month-$currentDayRel";
          $sched1 = "9:30am-12:00pm";
          $sched2 = "3:00pm-5:00pm";
          $time = "";
          $time2 = "";

        
            $clientname1 = "";
            $clientname2="";
            $contact1="";
            $contact2="";
            $name="firstsched";
            $name2="secondsched";
          $stmt1 = $mysqli->prepare("select * from bookings where date = ? and timeframe = ? ");
    $stmt1->bind_param('ss',$datatime,$name);
    
    if($stmt1->execute()){
        $result1 = $stmt1->get_result();
        if($result1->num_rows>0){
            
            while($row1 = $result1->fetch_assoc()){
                $time = $sched1;
                $clientname1 = $row1['name'];
                $contact1 = $row1['contact'];
                
            }
             
                
            
                
            
            
            $stmt1->close();
        }
    }

    $stmt2 = $mysqli->prepare("select * from bookings where date = ? and timeframe = ? ");
    $stmt2->bind_param('ss',$datatime,$name2);
    
    if($stmt2->execute()){
        $result2 = $stmt2->get_result();
        if($result2->num_rows>0){
            
            while($row2 = $result2->fetch_assoc()){
                $time2 = $sched2;
                $clientname2 = $row2['name'];
                $contact2 = $row2['contact'];
            }
             
                
            
                
            
            
            $stmt2->close();
        }
    }


   
    
          
          
            $dayname = strtolower(date('l', strtotime($date)));
            $eventNum = 0;
            $today = $date==date('Y-m-d')? "today" : "";

            //Kapag Lower than the date today
            if($date<date('Y-m-d')){
              $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>N/A</button>";
          }
            //pagsearch sa dates at already booked dates
         else if(in_array($date, $bookings)){
            $calendar.="<td class='$today'><h4>$currentDay</h4>";
            //Kapag may nakabook sa Specific date (AM)
            if($time == $sched1)
            {
             $calendar.=" <button class='btn btn-danger btn-xs' >AM <br>Not Available</button> <br><br>";
             


            }
            //walang nakabook sa Specific date (AM)
            else{ $calendar.=" <a href='../Lingap-Bata-Patag/contact/contactpage.html' class='btn btn-success btn-xs'>AM <br> Available</a><br><br>";}
           
            //Kapag may nakabook sa Specific date (PM)
            if($time2 == $sched2)
            {
             $calendar.="<button class='btn btn-danger btn-xs'>PM <br>Not Available</button> <br><br>";
             
            }
            //Kapag walang nakabook sa Specific date (PM)
            else{ $calendar.= " <a href='../Lingap-Bata-Patag/contact/contactpage.html' class='btn btn-success btn-xs'>PM <br> Available</a> ";}



         
         }
         //kapag walang Naka Book . Magkakaroon ng button na AM and PM
         else{
             $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='../Lingap-Bata-Patag/contact/contactpage.html'  class='btn btn-success btn-xs'>AM <br> Available </a>"; 
             $calendar.= "<br><br> <a href='../Lingap-Bata-Patag/contact/contactpage.html' class='btn btn-success btn-xs'>PM <br>Available</a>";
            
            
         }
            
            
           
            
          $calendar .="</td>";
          // Increment counters
          
          $currentDay++;
          $dayOfWeek++;
          

     }
     
     

     // Complete the row of the last week in month, if necessary

     if ($dayOfWeek != 7) { 
     
          $remainingDays = 7 - $dayOfWeek;
            for($l=0;$l<$remainingDays;$l++){
                $calendar .= "<td class='empty'></td>"; 

         }

     }
     
     $calendar .= "</tr>";

     $calendar .= "</table>";

     echo $calendar;

}
    
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
       
        tr{
            height:auto;
            border:2px solid black;
            
        }

        table{
          width:100%;
          
        }
        th{
          border:2px solid black;
          text-align:center;
        }
        td{
            height:100px;
            width:3%;
            border:2px solid black;
            
            
        }
       
        td a{
            display:block;
            
            
        }

       

center h2{
  width:80%;
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
      width: 80%;
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
      margin: 50px 0;
      line-height: 30px;
      color: white;
    }
    nav ul li a{
      font-size: 20px;
    }
    a:hover,a.active{
      background: none;
      color: #0082e6;
    }
    #check:checked ~ ul{
      left: 0;
      
    }
    
  }

* a {
    color: white;
    font-size:100%;

}
.selected a {
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    float: right;
    margin-right: 2%;
    color:yellow;
    font-size: large;
    margin-top: 2.5vh;
    
    
}
* a:hover {
    color: #fde26c;
    cursor: pointer;
}


body{
     background:whitesmoke;
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
</head>

<body>

            
          
            
<nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
          <i class="fas fa-bars"></i>
        </label>
        <label class="logo"> <img src="../Lingap-Bata-Patag/home/LatestLogo.jpg" style="width: 38vh; height: 11vh;  margin-left:0;" id="logo"></label>
        
        <ul>
        <li><a  href="../Lingap-Bata-Patag/home/home1.html" target="_self">Home</a></li>
        <li><a href="../Lingap-Bata-Patag/news.php">News & Events</a></li>
        <li><a href="../Lingap-Bata-Patag/contact/contactpage.html">Get Involve</a></li>
        <li><a href="../Lingap-Bata-Patag/aboutuspage/about.html">About Us</a></li>
        <li><a class="active" href="../Lingap-Bata-Patag/clientschedule.php">Book A Visit</a></li>
        <li><a href="../Lingap-Bata-Patag/clientlivelihood.php" target="_self">Livelihood</a></li>
      </ul>
      </nav>
               
               

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                     $dateComponents = getdate();
                     if(isset($_GET['month']) && isset($_GET['year'])){
                         $month = $_GET['month']; 			     
                         $year = $_GET['year'];
                     }
                     else{
                         $month = $dateComponents['mon']; 			     
                         $year = $dateComponents['year'];
                     }
                    echo build_calendar($month,$year);
                ?>
            </div>
        </div>
    </div>
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
