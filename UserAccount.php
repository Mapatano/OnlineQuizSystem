<?php
    include_once 'database.php';
    session_start();//A session is a way to store information (in variables) to be used across multiple pages.
   if(!isset($_SESSION['email']))
    {
        header("location:indexLogin.php");
    }
    else
    {
       // $name = $_SESSION['admin_id'];
        $email = $_SESSION['email'];
        $_SESSION["name"] = 'User';
        $_SESSION["key"] ='user';
    }


    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- default character encoding for HTML5 used to display an HTML page perfectly-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome To Online Quiz System</title>
    
   
    <style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-color:white;
 
}

.container{
position:relative;/* positioned relative to its normal position.*/
    background-color: white;
    display:flex;
    padding:70px;
    text-align:center;
    border: 2px solid gray;
    width:900px;
    left:150px;
  
  /*font-weight:bold;*/
   
    font-size: 18px;
}

head{
    background-color: black;
    color:white;

}


table{
    
   border-collapse: separate;/* */
    border-spacing: 60px 0;
 
    
}

tr { 
  border: solid;
  border-width: 1px 0;
}

.topnav {
  overflow: hidden;
  background-color: #333;
 

}

.topnav a {
 
  color: white;
  text-align: center;
  padding: 10px 32px;
  text-decoration: none;
  font-size: 13px;
}

.topnav a:hover {
  background-color: none;
  color: black;
 
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
  
 
 
}


.navbar li {
  /*display: block;*/
  background-color: #333;
 width: 500px;
 height:35px;
 float:left;

}



.navbar li a{
color:gray;
text-decoration:none;
font-size:13px;
padding: 90px; 

}
a:hover {
  
  
}

.log-out{
  
  background-color: red; 

}
a{
    text-decoration:none;

}



ul{
display:flex;
list-style:none;
padding:0px;
color:white;



}
</style>

</head>
<body>
<b style="font-family:InriaSans-Bold">QUICK-QUIZ</b> 
           

<?php  echo '<div class="countdown" id="demo" style="color:black">  </div><br>';?>

<?php  echo '<b>USER:</b>' .$email;?>
  
<!--<div class="topnav">-->
        <ul class="navbar">
            <li <?php  if(@$_GET['q']==1) echo'class="active"'; ?> ><a href="UserAccount.php?q=1">HOME</a></li>
            <li <?php if(@$_GET['q']==2) ; ?>> <a href="UserAccount.php?q=2">HISTORY</a></li>
         
          
           <li <?php ?>><a href="logout.php?q=UserAccount.php"><span class="log-out"></span>&nbsp;LOG OUT</a></li>
       
        </ul>
       
      
 
        
            
           
       
       <!-- </div>-->
   
   
    <br><br>
    <div class="container">

        <div class="row">
            <div class="column"> 
    <?php if(@$_GET['q']==1) 
                {
              // $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
              $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY branch ASC , title ASC") or die('Error');
                    echo  '<div class="panel"  style="color:"color:black"><div class="tab"><table class="table" >
                    <tr style="color:darkgrey;padding:2px 53px;"><td><center><b>S.N.</b></center></td><td><center><b>BRANCH</b></center></td><td><center><b>TOPIC</b></center></td><td><center><b>TOTAL QUESTIONS</b></center></td><td><center><b>MARKS</center></b></td><td><center><b>ACTION</b></center></td></tr>';
                    $c=1;
                    while($row = mysqli_fetch_array($result))//Fetch a result row as a numeric array and as an associative array,Associative arrays are arrays that use named keys that you assign to them.:
                         {
                        $branch = $row['branch'];
                        $title = $row['title'];
                        $total = $row['total'];
                        $sahi = $row['sahi'];
                        $eid = $row['eid'];
                    $q12=mysqli_query($con,"SELECT percentage FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
                    $rowcount=mysqli_num_rows($q12);	
   
 if($rowcount == 0){
                     echo '<tr><td><center>'.$c++.'</center></td><td><b><center>'.$branch.'</center></b></td><td><center>'.$title.'</center></td><td><center>'.$total.'</center></td><td><center>'.$total.'</center></td><td><center><b><a href="UserAccount.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="btn sub1" style="color:black;margin:0px;background:#1de9b6"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></center></td></tr>';
                    }
 else
    {
echo '<tr style="color:black"><td><center>'.$c++.'</center></td><td><b><center>'.$branch.'</center></b></td><td><center>'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></center></td><td><center>'.$total.'</center></td><td><center>'.$sahi*$total.'</center></td><td><center><b><a href="dbConnection1.php?q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="color:black;margin:0px;background:red"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Restart</b></span></a></b></center></td></tr>';
                    }
                    }
                    $c=0;
echo '</table></div></div>';
                }?>

<?php
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) 
        {
            $eid=@$_GET['eid'];
            $sn=@$_GET['n'];
            $total=@$_GET['t'];
                      
                                        
 /*$r=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid'");
        while($row=mysqli_fetch_array($r) )
            {
                $dur=$row['duration'];
                echo '<b;>'.$dur.'</b>';
            
     
            }*/
?>

<?php  echo '<div class="first" id="first" style="background-color:black">   </div>';?>



<?php
                     
                       // $q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
        $q=mysqli_query($con,"SELECT * FROM question WHERE eid='$eid' AND sn='$sn' ");
        echo '<div class="panel" id="panel" style="margin:1%;padding:25px;background-color:white; font-family:courier;width:450px;text-align:left;font-size: 15px;overflow:hidden">';

                        while($row=mysqli_fetch_array($q) )
                        {
                            $qid=$row['qid'];
                            $qns=$row['question'];
                           
                            echo '<b><sup>Question &nbsp;'.$sn.'&nbsp;::</sup><br /><br />'.$qns.'</b><br /><br />';
                        }
                        $q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
                        echo '<form action="dbConnection1.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="forms" style="width:450px;">
                        <br />';

                        while($row=mysqli_fetch_array($q) )
                        {
                            /*$option=$row['option'];
                            $optionid=$row['optionid'];*/
                            $option=$row['options'];
                            $optionid=$row['option_id'];
                            echo'<input type="radio" name="ans" value="'.$optionid.'">&nbsp;'.$option.'<br /><br />';
                        }
                        echo'<br /><button type="submit" id="click" class="button"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
                       
                    }

if(@$_GET['q']== 'result' && @$_GET['eid']) 
                    {
                        $eid=@$_GET['eid'];
                        $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
                        echo  '<div class="panel">
                   <h1 class="title" style="color:Black">RESULT</h1><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

                        while($row=mysqli_fetch_array($q) )
                        {
                           // $s=$row['score'];
                           $s=$row['percentage'];
                            $w=$row['wrong'];
                            $r=$row['sahi'];
                            $qa=$row['level'];
                            echo '<tr style="color:black"><td>TOTAL QUESTIONS</td><td>'.$qa.'</td></tr>
                                <tr style="color:black"><td>RIGHT ANSWER&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
                                <tr style="color:black"><td>WRONG ANSWER&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
                                <tr style="color:black"><td>SCORE&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.ceil($s).'%</td></tr>';
                        }
                    //    $q=mysqli_query($con,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');

                       /* while($row=mysqli_fetch_array($q) )
                        {
                            $s=$row['score'];
                            echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
                        }*/

                        echo '</table></div>';
                    }
                ?>

                <?php
                    if(@$_GET['q']== 2) 
                    {
                        $q=mysqli_query($con,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
                        echo  '<div class="panel title">
                        <table class="table table-striped title1" >
                        <tr style="color:grey;"><td><center><b>S.N.</b></center></td><td><center><b>Quiz</b></center></td><td><center><b>Total Questions</b></center></td><td><center><b>Right</b></center></td><td><center><b>Wrong<b></center></td><td><center><b>Percentage</b></center></td>';
                        $c=0;
                        while($row=mysqli_fetch_array($q) )
                        {
                        $eid=$row['eid'];
                        $w=$row['wrong'];
                        $r=$row['sahi'];
                        $p=$row['percentage'];
                        $qa=$row['level'];
                        $q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');

                        while($row=mysqli_fetch_array($q23) )
                        {  $title=$row['title'];  }
                        $c++;
                        echo '<tr><td><center>'.$c.'</center></td><td><center>'.$title.'</center></td><td><center>'.$qa.'</center></td><td><center>'.$r.'</center></td><td><center>'.$w.'</center></td><td><center>'.$p.'.%</center></td></tr>';
                        }
                        echo'</table></div>';
                    }

if(@$_GET['q']== 3) 
                {
                     /*  $q=mysqli_query($con,"SELECT * FROM rank ORDER BY eid DESC " )or die('Error223');
                       

                        echo  '<div class="panel title"><div class="table-responsive">
                        <table class="table table-striped title1" >
                        <tr style="color:BLACK"><td><center><b>Rank</b></center></td><td><center><b>Title</b></center></td><td><center><b>Email</b></center></td><td><center><b>Percentage</b></center></td></tr>';
                        $c=0;

                        while($row=mysqli_fetch_array($q) )
                        {
                            $e=$row['email'];
                            $s=$row['score'];
                             $id=$row['eid'];


                            $q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
                            while($row=mysqli_fetch_array($q12) )
                            {
                                $name=$row['name'];
                                $user=$row['email'];
                            }
                            $c++;
                            echo '<tr><td style="color:black"><center><b>'.$c.'</b></center></td><td><center>'.$id.'</center></td><td><center>'.$e.'</center></td><td><center>'.$s.'</center></td></tr>';
                        }
                        echo '</table></div></div>';*/
                    }
                ?>


<script>

var simple = '<?php echo '<b;>'.$dur.'</b>' ?>'; 




</script>


</body>
</html>