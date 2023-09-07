<?php
	include("database.php");
	session_start();
	
	if(isset($_POST['submit']))
	{	

		$name = test_input($_POST['name']);
		$email = test_input($_POST['email']);
		$password = test_input($_POST['password']);
		$password = md5($password);
		$password2 = test_input($_POST['password2']);
		$password2 = md5($password2);


$q="SELECT email from students WHERE email='$email'";
		$results=mysqli_query($con,$q);

if((mysqli_num_rows($results))<1)	
		{
            echo "<center><h3><script>alert('Sorry...Your email is not registered !!');</script></h3></center>";
            header("refresh:0;url=register.php");
        }
else
		{


if($password != $password2){
	echo "<center><h3><script>alert('The two password do not match !');</script></h3></center>";
	header("refresh:0;url=register.php");

}

else {

	$str="SELECT email FROM users WHERE email='$email'";
		$result=mysqli_query($con,$str);
		
		if((mysqli_num_rows($result))==0)

		{
            $str="insert into users set email='$email',name='$name',password='$password'";
		
			if((mysqli_query($con,$str))){	
	
			echo "<center><h3><script>alert('$name , Your Account has successfully been registered !!');</script></h3></center>";
			header("refresh:0;url=indexLogin.php");
			//header('location:indexLogin.php?');
	  }
    }
  }
}
	
}
	
    function test_input($data) {
      
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    } 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>USER REGISTER</title>

<style>

* { margin: 0px; padding: 0px; }
body {
	font-size: 120%;
	background-color:khaki;
}

form, .content {
	width: 40%;
	margin: 0px auto;
	padding: 20px;
	border: 1px solid #B0C4DE;
	background: white;
	border-radius: 0px 0px 0px 0px;
}

.input {
	margin: 10px 0px 10px 0px;
}
.input label {
	display: block;
	text-align: left;
	margin: 3px;
}
.input input {
	height: 30px;
	width: 93%;
	padding: 5px 10px;
	font-size: 16px;

	border: 1px solid gray;
}









     </style>   
	</head>

	<body>
		<section class="login first grey">
			<div class="container">
			<center><h3>QUICK_QUIZ</h3>	
			<h2>USER_REGISTER </h2></center><br>
							<form method="post" action="register.php" enctype="multipart/form-data">
                                <div class="input">
									<label>Enter Your name:</label>
									<input type="text" name="name" class="form" required />
								</div>
								<div class="input">
									<label>Enter Your Email Id:</label>
									<input type="email" name="email" class="form" required />
								</div>
								<div class="input">
									<label>Enter Your Password:</label>
									<input type="password" name="password" class="form" required />
                                </div>
								<div class="input">
									<label>Confirm Your Password:</label>
									<input type="password" name="password2" class="form" required />
                                </div>
							
                                
								<div class="input ">
									<button class="btn" name="submit">Register</button>
								</div>
								<div class="input">
									<span class="text-muted">Already have an account! </span> <a href="indexLogin.php">Login </a> Here..
								</div>
							</form>
					
			</div>
		</section>

	
	</body>
</html>