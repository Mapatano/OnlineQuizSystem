<?php 
 include_once 'database.php';
$email =  $password = "";
$FnameErr = $passwordErr = "";  


if (isset($_POST['login_user'])) {
  
    $email = $_POST['email'];
    $password = $_POST['password'];
    $encrypted_pwd = md5($password);
  
    if (empty($email)) {
        $FnameErr = "Email is required";
    }
    if (empty($password)) {
        $passwordErr = "Password is required";
    }
}

    if (!empty($_POST["email"]) AND  !empty($_POST["password"])) {
        
        $query = "SELECT email FROM user WHERE email='$email' AND password ='  $encrypted_pwd'";
        

  $results = mysqli_query($con, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['email'] = $email;
          $_SESSION['success'] = "You are now logged in";
          header('location: UserAccount.php');
       }else
        {
          echo "<b>Wrong email/password</b></br>";

        }
        
    }

    


  
?>


<html>
<head>
  <title>UserLogin</title>
  <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
  <div class="header">
  	<h2>User_Login</h2>
  </div>
	 
  <form method="post" action="project1login.php">
  
  	<div class="input-group">
  		<label>Email</label>
  		<input type="text" name="email" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Dont have an account? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>