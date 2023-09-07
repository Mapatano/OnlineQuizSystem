

<?php

/*$con= new mysqli('localhost','root','','quiz')or die("Could not connect to mysql".mysqli_error($con));
session_start();
if(isset($_POST['submit'])){  


      $n=@$_GET['total'];
      $eid=@$_GET['eid'];
      $number=$n+1;
                   //option == OPTIONS  Table user == table USERS
        $qid=rand();//uniqid();
        $qns=$_POST['question'.$number];
       // $q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
       $q3=mysqli_query($con,"INSERT INTO question VALUES  ('$qid','$eid','$qns','$number')");
        $oaid=rand();      //uniqid();//generates a unique ID based on the microtime (the current time in microseconds).
        $obid= rand();     //uniqid();
        $ocid= rand();//uniqid();
        $odid= rand();//uniqid();
        $a=$_POST[$number.'1'];
        $b=$_POST[$number.'2'];
        $c=$_POST[$number.'3'];
        $d=$_POST[$number.'4'];
      //  $qa=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die('Error61');
        $qa=mysqli_query($con,"INSERT INTO options VALUES  ('$oaid','$a','$qid')") or die('Error61');
        $qb=mysqli_query($con,"INSERT INTO options VALUES  ('$obid','$b','$qid')") or die('Error62');
        $qc=mysqli_query($con,"INSERT INTO options VALUES  ('$ocid','$c','$qid')") or die('Error63');
        $qd=mysqli_query($con,"INSERT INTO options VALUES  ('$odid','$d','$qid')") or die('Error64');
        $e=$_POST['ans'.$number];
        switch($e)
        {
          case 'a': $ansid=$oaid; break;
          case 'b': $ansid=$obid; break;
          case 'c': $ansid=$ocid; break;
          case 'd': $ansid=$odid; break;
          default: $ansid=$oaid;
        }
        //$qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");
        $qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$ansid','$qid')");




      }







	
?>

<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->

  <head>
<style>
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
  background-color: white;
}
.tabcontent {
  color: white;
  position:relative;
right:30px;
 
  padding: 100px 20px;
  height: 50%;
}

#Homee {
 
 background-color: silver;
 color:black;
 width: 80%;
 float: right;
 height: 100%;
}
.span{
    position:absolute;
    float:right;
    right:520px;
    font-size: 18px;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: right;
  width: 75%;
  margin-top: 6px;
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

.email{
  margin:20px auto;
  display:block;
  width:8px;
  border: 1px solid gray;

}
.password{
  margin:20px auto;
  display:block;
  width:8px;
  border: 1px solid gray;

}



.popup{
  height:60%;
  width:30%;
  background:white;
  top:75px;
  left:400px;
  display:none;
  justify-content:center;
  position: absolute;
  align-items:center;
  text-align:center;

}


.popup-content{
  height:250px;
  width:350px;
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

.container{
   position:absolute;
   top:50%;
   right:50%;
   transform:translate(-50%, -50%);
   text-align:center;


}
.button{
   background: white;
   padding:10px 15px;
   color:blue;
   font-weight:bolder;
   margin-top:75px;


}





</style>

<head>
  <body>
<div id="Homee" class="tabcontent">
<?php       

/*if(isset($_SESSION['key']))
  {*/
 
/*if(@$_GET['q']== 'edit') 
   {
  $eid=@$_GET['eid'];
    $result1 = mysqli_query($con,"SELECT * FROM quiz where eid= '$eid'") or die('Error');
 
 
echo '                 
<form name="form" action="editQuiz.php&eid='.@$_GET['eid'].'"  method="POST">  
<div class="row"><center><span  style="position:absolute;float:right;right:400px;font-size:18px;top:30px"><center><b>ENTER QUESTION DETAILS</b></center></span></center><br />
</div>

  <div class="form">
  <label class="label" for="qns"></label>  
  <div class="column" id="column">
  <textarea style="position:absolute;float:right;right:400px;top:55px;" name="qns" class="forme" placeholder="Write question here..." required></textarea>  
   </div>
</div>

<div class="row">
  <div class="col-75" >
  <input id="total" name="total" placeholder=" Enter option a"  type="text">
  </div>
</div>

<div class="row">
  <div class="col-75">
  <input id="right" name="right" placeholder=" Enter option b "  min="0" type="text">
  </div>
</div>
<div class="row">

  <div class="col-75">
  <input id="wrong" name="wrong" placeholder=" Enter option c"  min="0" type="text">
  </div>
  </div>

<div class="row">
  <div class="col-75">
  <input id="name" name="duration" placeholder=" Enter option d" type="text">
  </div>
</div>

<b>Correct answer</b>:<br />
<select id="ans" name="ans" placeholder="Choose correct answer " class="form" required>
<option value="a">Select answer for question </option>
<option value="a"> option a</option>
<option value="b"> option b</option>
<option value="c"> option c</option>
<option value="d"> option d</option> </select><br /><br />'; 
}
echo '<div class="form">
<label class="label" for=""></label>
<div class="column"> 
<input  type="submit" style="margin-left:45%" class="button" value="Submit" />
</div>
</div>

</fieldset>
</form></div></div>;
<br> ';


?>





  

  </div>






<script>


</script>
</body>
</html>*/

?>




