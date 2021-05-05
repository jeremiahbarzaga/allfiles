<?php
require_once("../admin/authchck.php");
function build_calendar($month, $year) {

    //paglagay ng Booked Date sa $bookings Array . 
    $mysqli = new mysqli('localhost', 'root', 'nakalimutanko', 'orphanage');
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
    $calendar .= "<center><h2>$monthName $year</h2> ";
    $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
    
    $calendar.= " <a class='btn btn-xs btn-primary' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
    
    $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a> <br> <h3 class='btn btn-danger btn-xs' >ABSENT </h3>  <h3 class='btn btn-primary btn-xs' >PRESENT </h3>  <h3 class='btn btn-info btn-xs' >DEFAULT </h3> </center><br>";
    
    
        
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
                $calendar .= "<td  ></td>"; 

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
                $id = $row1['Id'];
                $status1 = $row1['status'];
                
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
                $id = $row2['Id'];
                $status2 = $row2['status'];
            }
             
                
            
                
            
            
            $stmt2->close();
        }
    }


   
    
          
          
            $dayname = strtolower(date('l', strtotime($date)));
            $eventNum = 0;
            $today = $date==date('Y-m-d')? "today" : "";
        
            //pagsearch sa dates at already booked dates
         if(in_array($date, $bookings)){
            $calendar.="<td class='$today'><h4>$currentDay</h4>";
            //Kapag may nakabook sa Specific date (AM)
            if($time == $sched1)
            {
              if($status1 == "PRESENT")
              {
                $calendar.=" <a href=clientstatus.php?id=$id&name=$clientname1&date=$date class='btn btn-primary btn-xs' id = 'dngr'>AM <br>$clientname1<br>$contact1<br>$time</a><br><br>";
            
              }
              else if($status1 == "ABSENT")
              {
                $calendar.=" <a href=clientstatus.php?id=$id&name=$clientname1&date=$date class='btn btn-danger btn-xs' id = 'dngr'>AM <br>$clientname1<br>$contact1<br>$time</a><br><br>";
            
              }
              else{
                $calendar.=" <a href=clientstatus.php?id=$id&name=$clientname1&date=$date class='btn btn-info btn-xs' id = 'dngr'>AM <br>$clientname1<br>$contact1<br>$time</a><br><br>";
            

              }
            
             


            }
            // nakabook sa Specific date (AM)
            else{ $calendar.=" <a href=book.php?sched=$sched1&date=$date class='btn btn-success btn-xs'>AM<br>Available</a><br><br>";}
           
            //Kapag may nakabook sa Specific date (PM)
            if($time2 == $sched2)
            {
              if($status2 == "PRESENT")
              {
                $calendar.=" <a href=clientstatus.php?id=$id&name=$clientname2&contact=$contact2&date=$date class='btn btn-primary btn-xs' id = 'dngr'>AM <br>$clientname2<br>$contact2<br>$time2</a>";
            
              }
              else if($status2 == "ABSENT")
              {
                $calendar.=" <a href=clientstatus.php?id=$id&name=$clientname2&contact=$contact2&date=$date class='btn btn-danger btn-xs' id = 'dngr'>AM <br>$clientname2<br>$contact2<br>$time2</a>";
            
              }
              else{
                $calendar.=" <a href=clientstatus.php?id=$id&name=$clientname2&contact=$contact2&date=$date class='btn btn-info btn-xs' id = 'dngr'>AM <br>$clientname2<br>$contact2<br>$time2</a>";
            

              }
             
            }
            //Kapag walang nakabook sa Specific date (PM)
            else{ $calendar.= " <a href=book.php?sched=$sched2&date=$date class='btn btn-success btn-xs'>PM <br>Available</a> <br><br>";}



         
         }
         //kapag walang Naka Book . Magkakaroon ng button na AM and PM
         else{
             $calendar.="<td class='$today'><h4>$currentDay</h4> <a href=book.php?sched=$sched1&date=$date class='btn btn-success btn-xs'>AM <br>Available</a><br><br>"; 
             $calendar.= " <a href=book.php?sched=$sched2&date=$date class='btn btn-success btn-xs'>PM <br>Available</a><br><br>";
            
            
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

        

        .nav{
  background: #0082e6;
  height: 90px;
  width: 100%;
  float: right;
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
  background:whitesmoke;
     
  }
  
        
    </style>
</head>

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
          <li><a  href="../admin/addnews.php">Add News</a></li>
          <li><a class="active" href="../admin/schedule.php">Visitors</a></li>
       </ul>
      </nav>
    </div>

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
</body>

<script language="javascript">

let btnprimary = document.querySelector('#dngr');

btnprimary.addEventListener('click',() => btnprimary.style.backgroundColor = "#337ab7")

</script>

</html>
