<?php

$con= new mysqli('localhost','root','','quiz')or die("Could not connect to mysql".mysqli_error($con));

?>

<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->

<head>
<style>
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
  
}

head{
background-color:khaki;
width:100%;

}

.tabcontent {
  color: black;
  position:relative;
right:30px;
 padding: 100px 20px;
  height: 50%;
}


.home {
 background-Color:darkgray;
 padding: 100px 20px;

 
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





<?php       

/*if(isset($_SESSION['key']))
  {*/
 
if(@$_GET['q']== 'report') 
  {
    $eid=@$_GET['eid'];
   // $result1 = mysqli_query($con,"SELECT * FROM quiz where eid= '$eid'") or die('Error');
    $result1= mysqli_query($con,"SELECT * from question WHERE eid=$eid");

echo'<div class="home"><center><table style="position:relative;right:35px;width:950px;top:-100px;background-color:white;height:100px;">
    <tr>
    <td><center><b>N</b></center></td>
    <td><center><b>QUESTION</b></center></td>
    <td><center><b>SUCCESS%</b></center></td>
    <td><center><b>DIFFICULTY</b></center></td>
   
    </tr></div>
    ';
$a=1;

while($row = mysqli_fetch_array($result1)) {

  $question = $row['question'];
  $id = $row['qid'];

$result00= mysqli_query($con,"SELECT answer from report WHERE qid=$id");
$result0= mysqli_num_rows($result00);// number of answers rows 

$sum= mysqli_query($con," SELECT SUM(answer) from report WHERE qid=$id");
 while($row = mysqli_fetch_array($sum)){
    $sums = $row['SUM(answer)'];//addition answers

 }
 if($result0==0){

 $result0=$result0+1;
 }

 $total = ($sums * 100)/$result0;






  echo '    



<div class="row">
  <div class="col-75">
';
  if($total<=100 && $total>=70){

  echo'
   <tr><td style="padding:0 25px 0 25px;"><center>'.$a++.'</center></td><td  style="padding:10px 40px 10x 40px;"><b><center>'.$question.'</center></b></td><td style="padding:0 25px 0 25px;"><b><center>'.$total.'</center></b></td><td  style="color:green"><b><center>EASY</center></b></td>  </tr>';
  }
  

  else if($total<=69 && $total>=50){
  echo'
   <tr><td style="padding:0 25px 0 25px;"><center>'.$a++.'</center></td><td  style="padding:10px 40px 10px 40px;"><b><center>'.$question.'</center></b></td><td  style="padding:0 25px 0 25px;"><b><center>'.ceil($total).'</center></b></td><td  style="color:darkgray"><b><center>MEDIUM</center></b></td>  </tr>
 ';
  }

else{
  echo'
   <tr><td style="padding:0 25px 0 25px;"><center>'.$a++.'</center></td><td style="padding:10px 40px 10px 40px;"><b><center>'.$question.'</center></b></td><td style="padding:0 25px 0 25px;"><b><center>'.$total.'</center></b></td><td  style="color:red"><b><center>HARD</center></b></td>  </tr>
   ';
}



}
echo'</div></div></table></center>
  

 <br>';

  }


?>


</footer>




</body>
</html>

