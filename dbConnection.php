<?php
  include_once 'database.php';
  session_start();
  $email=$_SESSION['email'];


  if(isset($_SESSION['key']))
  {
    if(@$_GET['Uemail'] && $_SESSION['key']=='admin') 
    {
      $Uemail=@$_GET['Uemail'];
     // $r1 = mysqli_query($con,"DELETE FROM rank WHERE email='$Uemail' ") or die('Error');
      $r2 = mysqli_query($con,"DELETE FROM history WHERE email='$Uemail' ") or die('Error');
      $result = mysqli_query($con,"DELETE FROM users WHERE email='$Uemail' ") or die('Error');
      header("location:adminDashboard.php");
    }
  }


if(isset($_SESSION['key']))
  {
     
    if(@$_GET['q']== 'adddquiz' && $_SESSION['key']=='admin') 
    
  {
      $admin_id= mysqli_query($con,"SELECT admin_id from admin WHERE email='$email'");//The mysqli_query() method returns an object resource to the $admin_id variable, not a string

      while ($row = $admin_id->fetch_assoc()) {
      $admin = $row['admin_id'];
    }
      $name = $_POST['name'];
      $total = $_POST['total'];
      $sahi = $_POST['right'];
      $branch = $_POST['branch'];
      $wrong = $_POST['wrong'];
      $duration = $_POST['duration'];
      $id=rand();

      
      /*$q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('$id','$name' , '$sahi' , '$wrong','$total','$duration', NOW())");*/
      //$q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('$id' ,'$name' , '$sahi' , '$wrong','$total','$duration', NOW())");
     $q3=mysqli_query($con,"INSERT INTO quiz VALUES ($admin , '$branch','$id' ,'$sahi' ,'$name', '$total' , '$wrong')");
     // header("location:adminDashboard.php? id=question&eid=$id&n=$total");
      header("location:adminDashboard.php?q=1&eid=$id&n=$total");
    }
  }

if(isset($_SESSION['key']))
{

    if(@$_GET['q']== 'addqns' && $_SESSION['key']=='admin') 
    {
      $n=@$_GET['n'];
      $eid=@$_GET['eid'];
      $ch=@$_GET['ch'];
for($i=1;$i<=$n;$i++)
      {                      //option == OPTIONS  Table user == table USERS
        $qid=rand();//uniqid();
        $qns=$_POST['question'.$i];
       // $q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
       $q3=mysqli_query($con,"INSERT INTO question VALUES  ('$qid','$eid','$qns','$i')");
        $oaid=rand();      //uniqid();//generates a unique ID based on the microtime (the current time in microseconds).
        $obid= rand();     //uniqid();
        $ocid= rand();//uniqid();
        $odid= rand();//uniqid();
        $a=$_POST[$i.'1'];
        $b=$_POST[$i.'2'];
        $c=$_POST[$i.'3'];
        $d=$_POST[$i.'4'];
      //  $qa=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die('Error61');
        $qa=mysqli_query($con,"INSERT INTO options VALUES  ('$oaid','$a','$qid')") or die('Error61');
        $qb=mysqli_query($con,"INSERT INTO options VALUES  ('$obid','$b','$qid')") or die('Error62');
        $qc=mysqli_query($con,"INSERT INTO options VALUES  ('$ocid','$c','$qid')") or die('Error63');
        $qd=mysqli_query($con,"INSERT INTO options VALUES  ('$odid','$d','$qid')") or die('Error64');
        $e=$_POST['ans'.$i];
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
    
      header("location:adminDashboard.php");
    }

}




/*if(isset($_SESSION['key']))
{
  if(@$_GET['q']== 'Editquiz' && $_SESSION['key']=='admin') 
  {
   /* $eid=@$_GET['eid'];
    $result = mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' ") or die('Error');
    while($row = mysqli_fetch_array($result)) 
    {
      $qtitle = $row['title'];
      $right = $row['sahi'];
      $wrong = $row['wrong'];
      $qtotal = $row['total'];
      $r1 = mysqli_query($con,"UPDATE quiz SET title='$qtitle',sahi='$righ',wrong='$wrong',total='$qtotal' WHERE eid=@$_GET['eid'];") or die('Error');
  
    }
  
    header("location:dashboard.php?q=5");
  }
}*/

if(isset($_SESSION['key']))
  {
    if(@$_GET['q']== 'rmquiz' && $_SESSION['key']=='admin') 
    {
    $eid=@$_GET['eid'];
    $qid=@$_GET['qid'];
      $admin_id= mysqli_query($con,"SELECT admin_id from quiz WHERE eid='$eid'");//The mysqli_query() method returns an object resource to the $admin_id variable, not a string

while ($row = $admin_id->fetch_assoc()) {
      $admin = $row['admin_id'];
     
     

  $result = mysqli_query($con,"SELECT eid FROM quiz WHERE admin_id='$admin'AND eid=$eid") or die('Error');
      while($row = mysqli_fetch_array($result)) 
           {
      $eid = $row['eid'];

        }
 
  }

               
     /* $eid=@$_GET['eid'];*/
     // $result = mysqli_query($con,"SELECT * FROM question WHERE eid='$eid' ") or die('Error');

     $result0 = mysqli_query($con,"SELECT * FROM report WHERE eid='$eid' AND qid='$qid'") or die('Error');
     $r0 = mysqli_query($con,"DELETE FROM report WHERE eid='$eid' AND qid='$qid' ") or die('Error');
   
   



  $result = mysqli_query($con,"SELECT * FROM history WHERE eid='$eid'") or die('Error');
  $r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');



  $result2 = mysqli_query($con,"SELECT * FROM question WHERE eid='$eid' ") or die('Error');
  while($row = mysqli_fetch_array($result2)) 
{
  $qid = $row['qid'];
  $r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
  $r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid' ") or die('Error');

}
$r0 = mysqli_query($con,"DELETE FROM report WHERE eid='$eid'  ") or die('Error');
  $r3 = mysqli_query($con,"DELETE FROM question WHERE eid='$eid'   ") or die('Error');
 
 // $r5 = mysqli_query($con,"DELETE FROM rank WHERE eid='$eid' ") or die('Error');

  $r = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');


  echo "<center><h3><script>alert('.$title quiz has been deleted succesfully');</script></h3></center>";
  header("refresh:0;url=adminDashboard.php?id=delete.php");


    /*  while($row = mysqli_fetch_array($result)) 
      {
       /* $qid = $row['qid'];
        $r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
        $r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
      }*/
     
   
     /* $r3 = mysqli_query($con,"DELETE FROM question WHERE eid='$eid' ") or die('Error');
      $r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
      $r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error'); */
     
    }
  }







  ///START WITH USER

if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) 
  {
    $eid=@$_GET['eid'];
    $sn=@$_GET['n'];
    $total=@$_GET['t'];
    $ans=$_POST['ans'];
    $duration=@$_GET['duration'];
    $qid=@$_GET['qid'];
    $q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
    while($row=mysqli_fetch_array($q) )
    { 
      // $ansid=$row['ansid']; 
      $ansid=$row['anid']; 
    
    }






    

  if($ans == $ansid)
    {
$q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
      while($row=mysqli_fetch_array($q) )
      {
        $sahi=$row['sahi'];
      }
if($sn == 1)
      {
        $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0','0',NOW(),'0')")or die('Error');
                         // $report=mysqli_query($con,"INSERT INTO report VALUES('$email','$eid' ,'$qid','0','false',NOW())")or die('Error');
      }
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');
      while($row=mysqli_fetch_array($q))
      {
        $ss=$row['percentage'];
        $s=$row['score'];
        $r=$row['sahi'];
        $level =$row['level'];
      }
      $r++;  
      $s=$s+$sahi;

      /**/
     
 $q=mysqli_query($con," SELECT quiz.total, history.percentage
 FROM quiz
 INNER JOIN history ON quiz.eid = history.eid;")or die('Error115');

 while($row=mysqli_fetch_array($q) )
      {
        $total=$row['total'];
        $perce=$row['percentage'];
      }

      $sumQuestion= $sahi*$total;//total points At exam
      $percentagee =($sahi * 100)/$sumQuestion ;//percentage on one right question 
      $ss =  $ss + $percentagee;
   
      
    
$q=mysqli_query($con,"UPDATE history SET score='$s',level='$sn',sahi='$r',percentage='$ss', date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124'); 
      
$k1=mysqli_query($con,"SELECT * FROM report WHERE email = '$email' AND qid='$qid' " );
     while($row=mysqli_fetch_array($k1) )
              {
                $report2=$row['email'];
                $report3=$row['qid'];
              }
 
if($report2 == $email AND $report3 == $qid){
              $report1=mysqli_query($con,"UPDATE report SET answer='1', result='true', date= NOW()  WHERE  email = '$email' AND qid = '$qid'")or die('Error124');
              }
           else{
                     $report1=mysqli_query($con,"INSERT INTO report VALUES('$email','$eid' ,'$qid','1','true',NOW())")or die('Error');
              }
    
    
  } 








    else
    {
      $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');
      while($row=mysqli_fetch_array($q) )
      {
        $wrong=$row['wrong'];
      }
      if($sn == 1)
      {
        $attempt=0;
        $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0','0',NOW(),'$attempt' )")or die('Error137');
      }
      $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
      while($row=mysqli_fetch_array($q) )
      {
        $s=$row['score'];
        $w=$row['wrong'];
        $level =$row['level'];
      }
      $w++;
      $s=$s-$wrong;



  




 /* $q=mysqli_query($con,"SELECT quiz.total, history.percentage, quiz.wrong
 FROM quiz
 INNER JOIN history ON quiz.eid = history.eid;")or die('Error115');

 while($row=mysqli_fetch_array($q) )
      {
        $total=$row['total'];
        $wrg=$row['wrong'];
        $perc=$row['percentage'];
      }
    

        $sumQuestion= $wrg * $total;//total des point A l exam
        $percentag = ($wrg * 100)/$sumQuestion; //percentage on one wrong question   
        $perc = $perc - $percentag;

        if($perc<0){
     
          $perc=-$perc * 0;
          $perce = ceil($perce) ;

        }*/
           
      
      /*'percentage'=$percentt,     , percentage='$perc', */

$q=mysqli_query($con,"UPDATE history SET score='$s', level='$sn',wrong='$w',date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
                



                 $k1=mysqli_query($con,"SELECT * FROM report WHERE email = '$email' AND qid='$qid' " );
                 while($row=mysqli_fetch_array($k1) )
                          {
                            $report4=$row['email'];
                            $report5=$row['qid'];
                          }
             
            if($report4 == $email AND $report5 == $qid){
                          $report00=mysqli_query($con,"UPDATE report SET answer='0', result='false', date= NOW()  WHERE  email = '$email' AND qid = '$qid'")or die('Error124');
                          }
                       else{
                                 $report00=mysqli_query($con,"INSERT INTO report VALUES('$email','$eid' ,'$qid','0','false',NOW())")or die('Error');
                          }
                
                
        /*} */



$q10=mysqli_query($con,"SELECT attempts from history WHERE email='$email' AND eid ='$eid'");
while($row=mysqli_fetch_array($q10) )
      {
        $attempt=$row['attempts'];
      }
$attempt++;
$q0=mysqli_query($con,"UPDATE history SET attempts='$attempt' WHERE  email = '$email' AND eid = '$eid'");
    }





    if($sn != $total)
    {
      $sn++;
      header("location:UserAccount.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
    }
    else if( $_SESSION['key']!='admin')
    //else if( $sn == $total)
    {
      
      $q=mysqli_query($con,"SELECT percentage FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
      while($row=mysqli_fetch_array($q) )
      {
       $s=$row['score'];
    
        $s=$row['percentage'];
       
      }
 



//$q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
//$q1=mysqli_query($con,"SELECT eid FROM rank WHERE email='$email'" )or die('Error161');


   //  $rowcount1=mysqli_num_rows($q1);

 $rowcount=mysqli_num_rows($q);
    if($rowcount == 0)
      {
       $q2=mysqli_query($con,"INSERT INTO rank VALUES('$email','$perce',NOW(),'$eid')")or die('Error165');
      }

else if ($rowcount1 == 0){

  $q2=mysqli_query($con,"INSERT INTO rank VALUES('$email','$s',NOW(),'$eid')")or die('Error165');
}
     
    else {
        while($row=mysqli_fetch_array($q) )
       {
         $sun=$row['score'];
        }
        $sun=$sun+$s;
        $q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email' AND eid='$eid'")or die('Error174');


      
        if($eid=eid){
   $q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');

        }
        else{
           $q=mysqli_query($con,"INSERT INTO rank VALUES('$email','$s',NOW(),'$eid')")or die('Error165');
        }
        
        
   }
     header("location:UserAccount.php?q=result&eid=$eid");
    
 }
    else
   {
      header("location:UserAccount.php?q=result&eid=$eid");
}
  

  }










if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) 
{
  $eid=@$_GET['eid'];
  $n=@$_GET['n'];
  $t=@$_GET['t'];
  $q=mysqli_query($con,"SELECT percentage FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
  while($row=mysqli_fetch_array($q) )
  {
    $s=$row['percentage'];
  }
  $q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
  //$q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
  //while($row=mysqli_fetch_array($q) )
  //{
  //  $sun=$row['score'];
  //}
  //$sun=$sun-$s;
  //$q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
  header("location:userAccount.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
}






  


?>