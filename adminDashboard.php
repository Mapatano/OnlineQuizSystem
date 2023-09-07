<?php
    include_once 'database.php';
    session_start();
  
    if(!isset($_SESSION['email']))
    {
      header("location:login.php");
    }
    else
    {
      
        $email = $_SESSION['email'];
        $admin_id=mysqli_query($con,"SELECT admin_id FROM admin  WHERE email = '$email' " );
        
while ($row = $admin_id->fetch_assoc()) {
  $admin = $row['admin_id'];
}
        $_SESSION["name"] = 'Admin';
        $_SESSION["key"] ='admin';
       
     }
?>





<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">


  <!--CSS -->
 <style>

* {box-sizing: border-box}


body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
	background-color:black;
}

/* Style tab links */
.box-topic {
  background-color: #555;
  color: black;
  float: right;
  position:relative;
  right:30px;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 12px;
  width: 20%;
  top:-620px;
}

.box-topic:hover {
  background-color: #777;
}


.tabcontent {
  color: white;
  position:relative;
  right:30px;
  display: none;
  padding: 50px 50px;
  height: 100%;
  top:-619px;
}

#Home {
 
  background-color: silver;
  color:black;
  width: 80%;
  float: right;
  
}

#updat {
 
 background-color: black;
 width: 80%;
 float:right;
 
}


#modify {
 
  background-color: silver;
  width: 80%;
  float:right;
  color:black;
  
}

#quest {
 
 background-color: silver;
 color:black;
 width: 80%;
 float:right;
 
}

input[type=text], select, textarea {
  width: 50%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}


input[type=number], select, textarea {
  width: 50%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}


input[type=submit] {
  background-color: maroon;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;

}

input[type=submit]:hover {
  background-color: blue;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
 
  
}

.column{
  float: right;
  width: 75%;
  margin-top: 6px;

}

#question{
display:block;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}



#user  {
  background-color: silver;
  width: 80%;
  float:right;
  color:black;
  padding:30px;
  text-align:left;
  font-size: 18px;
  overflow:hidden;
}

.panel{
  background-color: silver;
  width: 80%;
  float:right;
  color:black;
  padding:30px;
  text-align:left;
  font-size: 18px;
  overflow:hidden;
}

#report{
  background-color: silver;
  width: 80%;
  float:right;
  color:black;
  padding:30px;
  text-align:left;
  font-size: 18px;
  overflow:hidden;
}

#column{
  position:relative;
  left:100px;

}

.tabconten{
position:relative;
top:-619px;
left:-28px;

}


.tabconten .form{
position:relative;
height: 65px;
left:50px;

}

.popup{
  height:60%;
  width:30%;
  background:khaki;
  top:135px;
  left:80px;
  display:none;
  justify-content:center;
  position: absolute;
  align-items:center;
  text-align:center;

}


.popup-content{
  height:350px;
  width:750px;
  background:white;
  padding:20px;
  border-radius:5px;
  border:solid black;
  position: relative;
  

}

.close{
   position:absolute;
   top:-15px;
   right:-15px;
   background:white;
   height:20px;
   width:20px;
   border-radius:50% ;

}
.admin{
   position:absolute;
   top:-8px;
   right:90px;
   background:white;
   height:30px;
   width:30px;
   border-radius:50% ;

}

.container{
   position:absolute;
   top:15%;
   right:40%;
   transform:translate(-20%, -20%);
   text-align:center;


}
.button{
   background: white;
   padding:10px 15px;
   color:blue;
   font-weight:bolder;
   margin-top:75px;
   
}

#button{
  position: relative;
   background: khaki;
   padding:8px 13px;
   color:black;
   top:11px;
   text-decoration:none;
}

#logout{
  position: relative;
   padding:8px 13px;
   color:red;
   top:-75px;
   text-decoration:none;
   left:170px;
}


.form1{
  position:relative;
   left:-18%;
   background-color: khaki;
}

.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 98%;
   background-color: darkgreen;
   color: white;
   text-align: center;
}

</style>
    <!-- CSS ends-->


<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
   <body>
  <div class="sidebar" style="background-color:white;width:240px;height:650px;position:relative;top:30px; border-radius:4px;border:solid black;">  
   
  <?php  
  echo'<b>ADMINISTRATOR</b>';
  echo '<b><img src="/project/admin.png" alt="user" class="admin" style="right:70px;"> </b>' .$email ; 
 

  ?>




<a href="#" class="button" id="button">ADD</a>






<?php

if(isset($_POST['submit1']))
	{	

   
$email = test_input($_POST["email"]);
$password = test_input($_POST["password"]);
$password2 = test_input($_POST["password2"]);

      $uppercase = preg_match('@[A-Z]@', $password);
      $lowercase = preg_match('@[a-z]@', $password);
      $number    = preg_match('@[0-9]@', $password);
     
      
      if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase ) {//The strlen() function returns the length of a string.
      
          echo "<center><h3><script>alert('Password should be at least 8 characters in length  should include at least one upper case letter   one number.')";
      }


else{ 
      $password = md5($password);//hash password1
}
      $uppercase = preg_match('@[A-Z]@', $password2);
      $lowercase = preg_match('@[a-z]@', $password2);
      $number    = preg_match('@[0-9]@', $password2);
     
      if(strlen($password2) < 8 || !$number || !$uppercase || !$lowercase ) {
          echo "<center><h3><script>alert('Password should be at least 8 characters in length should include at least one upper case letter \n and At leat one number.');</script></h3></center>";
      }
else{

		  $password2 = md5($password2);//hash password2
    } 
      
                            

if($password != $password2){
	echo "<center><h3><script>alert('The two password do not match !');</script></h3></center>";
  
}

else {

		$str="SELECT email from admin WHERE email='$email'";
		$result=mysqli_query($con,$str);
		
		if((mysqli_num_rows($result))>0)	
		{
            echo "<center><h3><script>alert('Sorry.. This email is already registered !!');</script></h3></center>";
           
           
        }
		else
		{
            $str="insert into admin set email='$email',password='$password'";

		
		if((mysqli_query($con,$str))){	
	
			echo "<center><h3><script>alert('New Administrator Account has successfully been created !!');</script></h3></center>";
     
	
			
		  }
     }
 
	  }
  
  }
  function test_input($data) {
    $data = trim($data);//Strip(remove) unnecessary characters [extra space, tab, newline] from the user input data 
    $data = stripslashes($data);//This function Remove backslashes (\) from the user input data 
    $data = htmlspecialchars($data);   //This function converts special characters to HTML entities. This means that it will replace HTML characters like < and > with &lt; and &gt;. This prevents attackers from exploiting the code by injecting HTML or Javascript code (Cross-site Scripting attacks) in forms.
    return $data;
  }
  ?>






<form method="post" action="adminDashboard.php"> 
<div class="popup">
<div class="popup-content">
<img src="/project/close.png" alt="close" class="close">
<img src="/project/admin.png" alt="user" class="admin">
<input type="email" placeholder="email" class="email"  name="email" required>
<input type="password" placeholder="Password" class="password" name="password" style="position:absolute;top:65px;right:20px;" required>
<input type="password" placeholder="Confirm Password" class="password" name="password2" style="position:absolute;top:108px;right:20px;" required>
<button class="button" type="submit" name="submit1" style="position:absolute;background-color:khaki;color:black;top:100px;right:75px">ADD</button>
</div>
</div>
</form>

<p><a id="logout" href="login.php" >logout</a></p>


</div>

    <button class="box-topic" onclick="openPage('modify',this,'black')">MODIFY QUIZ</button>
    <button class="box-topic" onclick="openPage('user',this, 'black')">USERS</button>
    <button class="box-topic" onclick="openPage('report',this, 'black')">QUIZES REPORTS</button>
    <button class="box-topic" onclick="openPage('Home', this, 'black')">ADD QUIZ</button>

            



<!--CREATE QUIZ STARTS -->

<div id="Home" class="tabcontent">

 
 <?php   
          
echo '                 
<form name="form" action="dbConnection1.php?q=addquiz" method="POST">  
<div class="row"><center><span  style="position:absolute;float:right;right:520px;font-size: 18px;"><center><b>ENTER QUIZ DETAILS</b></center></span></center><br />
</div>

<div class="row">
  <div class="column">
  <input id="name" name="name" placeholder="Enter Quiz title" type="text"  required>
  </div>
</div>



<div class="row">
  <div class="column">

  <select id="branch" name="branch" >
    <option value="">Select quiz branch</option>
    <option value="Mathematics">Mathematics</option>
    <option value="Computer Science">Computer Science</option>
    <option value="Physics">Physics</option>
    <option value="Biology">Biology</option>
    <option value="General knowlrdge">Chemistry</option>
    <option value="General knowlrdge">General knowlrdge</option>
  </select>

</div>
</div>

<div class="row">
  <div class="column" >
  <input id="total" name="total" placeholder="Enter total number of questions"  type="number"  required>
  </div>
</div>

<div class="row">
  <div class="column">
  <input id="right" name="right" placeholder="Enter marks on right answer"  min="0" type="number"  required>
  </div>
</div>
<div class="row">

  <div class="column">
  <input id="wrong" name="wrong" placeholder="Enter minus marks on wrong answer without  min="0" type="number" required>
  </div>
  </div>


<br> ';


?>


<div class="row">
  <button  type="submit" value="AddQuiz" style="position:absolute;float:right;right:580px;font-size: 18px;border-radius: 8px;"><b>CREATE</b></button>
  </div>


<?php
echo '
</form>';
?>
</div>

<!--CREATE QUIZ ENDS -->



<?php
if(@$_GET['id']=='answer') //Error Control Operator

?>




<!--CREATE QUESTION STARTS -->
<?php 

if(@$_GET['q']=='1') 
 {

echo '<div id="quest" class="tabconten">';
  
echo ' 
                        <div class="row">
                        <span class="title1" style="position:relative;margin-left:40%;font-size:30px;top:-619px;"><b>Enter Question Details</b></span><br /><br />
                        <div class="column"></div><div class="column"><form class="form1" name="form" action="dbConnection1.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4 "  method="POST">
                        <fieldset>
                        ';
                
                        for($i=1;$i<=@$_GET['n'];$i++)
                        {
                            echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
                                    <div class="form">
                                        <label class="label" for="qns'.$i.' "></label>  
                                        <div class="column">
                                            <textarea rows="3" cols="8"  name="question'.$i.'" class="forme" placeholder="Write question number '.$i.' here..."></textarea>  
                                        </div>
                                    </div>
                                    <div class="form">
                                        <label class="label" for="'.$i.'1"></label>  
                                        <div class="column">
                                            <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="forme" type="text">
                                        </div>
                                    </div>
                                    <div class="form">
                                        <label class="label" for="'.$i.'2"></label>  
                                        <div class="column">
                                            <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="forme" type="text">
                                        </div>
                                    </div>
                                    <div class="form">
                                        <label class="label" for="'.$i.'3"></label>  
                                        <div class="column">
                                            <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="forme" type="text">
                                        </div>
                                    </div>
                                    <div class="form">
                                        <label class="label" for="'.$i.'4"></label>  
                                        <div class="column">
                                            <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="forme" type="text">
                                        </div>
                                    </div>
                                    <br />
                                    <b>Correct answer</b>:<br />
                                    <select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="forme" >
                                    <option value="a">Select answer for question '.$i.'</option>
                                    <option value="a"> option a</option>
                                    <option value="b"> option b</option>
                                    <option value="c"> option c</option>
                                    <option value="d"> option d</option> </select><br /><br />'; 
                        }
                        echo '<div class="form">
                                <label class="label" for=""></label>
                                <div class="col"> 
                                    <input  type="submit" style="margin-left:45%"; bakground-color:green; class="button" value="Submit" class="btn btn-primary"/>
                                   
                                </div>
                              </div>

                        </fieldset>
                        </form></div>';
                      } 
                ?>
            
 <!--CREATE QUESTION ENDS -->
  




  <!--QUIZ REPORT-->
<div id="report" class="tabcontent"> 
      <?php           
           
                    echo  '<div class=" panell" style="background-color:white">
                    <center>
                    <table >
                    <tr style="color:black"><td><center><b>NUM</b></center></td><td><center><b>EMAIL</b></center></td><td><center><b>TITLE</b></center></td><td><center><b>SCORE(%)</b></center></td></tr><hr>';
                    $c=0;
                  
                       // $q12=mysqli_query($con,"SELECT * FROM users WHERE email='$e' " )or die('Error231');
               $q12=mysqli_query($con,"SELECT history.email, quiz.title, history.percentage
                        FROM history INNER join quiz ON history.eid=quiz.eid  WHERE admin_id=$admin ORDER BY title ASC;" )or die('Error231');


                       while($row=mysqli_fetch_array($q12) )
                        {
                           
                            $e=$row['title'];
                            $name=$row['email'];
                            $s=$row['percentage'];

                        $c++;
      echo '<tr><td style="padding:0 25px 0 25px;"><center><b>'.$c.'</b></center></td><td style="padding:0 25px 0 25px;"><center>'.$name.'</center></td><td style="padding:0 25px 0 25px;"><center><b>'.$e.'</b></center></td><td style="padding:0 25px 0 25px;"><center>'.ceil($s).'</center></td>';
                      }
      echo '</table></center></div>';
            ?>
  </div>
 <!--QUIZ REPORT ENDS-->






  <!--USER INFORMATION-->
<div id="user" class="tabcontent">
  <?php 
                   
                     
                      $result = mysqli_query($con,"SELECT * FROM users") or die('Error');
                      
                        echo  '<div class="panell" style="position:relative;right:-50px;width:850px;background-color:white;"><center><table ">
                        <tr><td style="padding:0 25px 0 25px;"><center><b>S.N.</b></center></td><td style="padding:0 25px 0 25px;"><center><b>Name</b></center></td><td style="padding:0 25px 0 25px;"><center><b>Email</b></center></td><td style="padding:0 25px 0 25px;"><center><b>Action</b></center></td></tr>';

                        $c=1;
                        
                        while($row = mysqli_fetch_array($result)) 
                        {
                            $name = $row['name'];
                            $email = $row['email'];
                         
                            echo '<tr><td style="padding:0 25px 0 25px;"><center>'.$c++.'</center></td><td style="padding:0 25px 0 25px;"><center>'.$name.'</center></td><td style="padding:0 25px 0 25px;"><center>'.$email.'</center></td><td style="padding:0 35px 0 35px;"><center><a href="dbConnection1.php?Uemail='.$email.'"><b>DELETE</b></button></center></td></tr>';
                        }
                        $c=0;
                        echo '</table></center></div>';
                    
     ?>
</div>
 <!--USER ENDS-->




<!--EDIT QUIZ STARTS-->

<div id="modify" class="tabcontent"> 
 <?php

          $result = mysqli_query($con,"SELECT * FROM quiz WHERE admin_id='$admin'") or die('Error');
                        echo  '<center><div class="panel" id="delete" style="position:relative;right:35px;width:850px;background-color:white;">
                        <table>
                        <tr>
                        <td ><center><b>S.N.</b></center></td>
                        <td><center><b>TOPIC</b></center></td>
                        <td><center><b>QUESTIONS</b></center></td>
                        <td><center><b>MARKS</b></center></td>
                        <td><center><b>ACTION</b></center></td>
                    
                        </tr>';
                        $c=1;
                        while($row = mysqli_fetch_array($result)) {
                            $title = $row['title'];
                            $total = $row['total'];
                            $sahi = $row['sahi'];
                            $eid = $row['eid'];
                            echo '<tr><td><center>'.$c++.'</center></td><td><center>'.$title.'</center></td><td><center>'.$total.'</center></td><td><center>'.$sahi*$total.'</center></td>

          <td><center><b><a href="dbConnection1.php?q=rmquiz&eid='.$eid.'" class="pull-right btn sub1" style="margin:0px;color:black;"><button style="background-color:red;"><b>DELETE</b></button>
         </a></b><b><a href="editQuiz.php?q=edit&eid='.$eid.'"> <button style="background-color:blue;">ADD QUESTION</button></a></b><b><a href="reportQuiz.php?q=report&eid='.$eid.'"> <button style="background-color:khaki;">REPORT</button></a></b></center></td></tr>';
                        }
                        $c=0;
                        echo '</table>
                        </div>
                        </div></center>';

               
       ?>

</div>

<!--EDIT quiz ENDS-->





  <!--</section>-->

<script>

document.getElementById("button").addEventListener("click", function(){
document.querySelector(".popup").style.display = "flex";
})
document.querySelector(".close").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "none";
})


function openPage(pageName, elmnt, color) {
  // Hide all elements with class="tabcontent" by default */
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("box-topic");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";

  // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = 'white';
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

function myFunction1() {
document.getElementByClassName("tabcontent").visibility= "hidden";
}
function myFunctions() {
document.getElementByClassName("form").display= "none";

}

 </script>






</body>

</html>



