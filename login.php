<?php
	require('database.php');
	session_start();
	if(isset($_SESSION["email"]))
	{
		session_destroy();
	}

	//$ref=@$_GET['q'];		
if(isset($_POST['submit']))
	{	
$emailErr =$passwordErr ="";
$email = $_POST['email'];
$pass = $_POST['password'];


if (empty($_POST["email"])) {

	echo "<center><h3><script>alert('Email is required');</script></h3></center>";
  }
  else {
	$email = test_input($_POST["email"]);
	// check if e-mail address is well-formed
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<center><h3><script>alert('invalid email format');</script></h3></center>";
	}
  }

  if (empty($_POST["password"])) {
	echo "<center><h3><script>alert('Password is required');</script></h3></center>";
  }else {
	$password = test_input($_POST["password"]);
	
  }


$password = md5($password);

$str = "SELECT * FROM admin WHERE email='$email' and password='$password'";
$result = mysqli_query($con,$str);
		if((mysqli_num_rows($result))!=1) 
		{
			echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
			header("refresh:0;url=login.php");
		}
		else
		{
			$_SESSION["name"] = 'Admin';
            $_SESSION["key"] ='admin';
            $_SESSION["email"] = $email;	
			header('location: adminDashboard.php');
		}
			
/*$email = stripslashes($email);
$email = addslashes($email);
$pass = stripslashes($pass); 
$pass = addslashes($pass);
$email = mysqli_real_escape_string($con,$email);
$pass = mysqli_real_escape_string($con,$pass);					
$str = "SELECT * FROM admin WHERE email='$email' and password='$pass'";
$result = mysqli_query($con,$str);
		if((mysqli_num_rows($result))!=1) 
		{
			echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
			header("refresh:0;url=login.php");
		}
		else
		{
			$_SESSION['logged']=$email;
			$row=mysqli_fetch_array($result);
			$_SESSION['name']=$row[1];
			$_SESSION['id']=$row[0];
			$_SESSION['email']=$row[2];
			$_SESSION['password']=$row[3];
			header('location: adminDashboard.php'); 	
			$_SESSION["name"] = 'Admin';
            $_SESSION["key"] ='admin';
            $_SESSION["email"] = $email;	
			header('location: adminDashboard.php');		
		}*/
	}

	function test_input($data) {
		$data = trim($data);//Strip(remove) unnecessary characters [extra space, tab, newline] from the user input data 
		$data = stripslashes($data);//This function Remove backslashes (\) from the user input data 
		$data = htmlspecialchars($data);   //This function converts special characters to HTML entities. This means that it will replace HTML characters like < and > with &lt; and &gt;. This prevents attackers from exploiting the code by injecting HTML or Javascript code (Cross-site Scripting attacks) in forms.
		return $data;
	  }
?>


<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="AdminCss.css">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>QUICK QUIZ System</title>
		<center><h2><b>ADMINISTRATOR</b></h2></center>
	
		
       
	</head>

	<body>
		<section class="login first grey">
			<div class="container">
			
<center><h5 style="font-family: Noto Sans;">LOGIN TO </h5><h4 style="font-family: Noto Sans;">QUICK QUIZ</h4></center><br>
<form method="post" action="login.php" enctype="multipart/form-data">
<div class="input-group">
<label><b>Enter Your Email:</b></label>
<input type="email" name="email" class="form-control">
		</div>
<div class="input-group">
<label class="fw"><b>Enter Your Password:</b>
		</label>
<input type="password" name="password" class="form-control">
		</div> 
<div class="input-group text-right">
<button class="button" name="submit">Login</button>
		</div>
<div class="input-group text-center">
<a href="javascript:void(0)" class="pull-right">Forgot Password?</a>
		</div>
</form>
					
		</div>
		</section>

</body>
</html>



