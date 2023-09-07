<?php

$servername = "localhost";
$database = "database";
$root = "root";

// Create connection
$conn = new mysqli($servername, $root,"", $database);



// Check connection
// if ($conn->connect_error) {
  // die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";


// define variables and set to empty values
$Fname = $name = $password =  $cpassword = $email = "";
$FnameErr = $nameErr = $passwordErr = $cpasswordErr = $emailErr = "";  
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["Fname"])) {
            $FnameErr = "First Name is required";
         
          }else {
        $Fname = test_input($_POST["Fname"]);
    }

if (empty($_POST["name"])) {
            $nameErr = "Name is required";
          }else {
        $name = test_input($_POST["name"]);
    }

if (empty($_POST["password"])) {
            $passwordErr = "password is required";
          }else {
        $password = test_input($_POST["password"]);
        $encrypted_pwd = md5($password);
    }

    if (empty($_POST["cpassword"])) {
      $cpasswordErr = "confirm password ";
    }else {
      $cpassword = test_input($_POST["cpassword"]);
      $encrypted_pwd2 = md5($cpassword);

  } 

    if (empty($_POST["email"])) {
        $emailErr = "Name is required";
      }else {
        $email = test_input($_POST["email"]);
    } 


if (!empty($_POST["Fname"]) AND  !empty($_POST["name"])  AND  !empty($_POST["password"]) AND !empty($_POST["cpassword"]) AND !empty($_POST["email"])   ) {
    $sql = "INSERT INTO user (First_name,Last_name,email,password) VALUES ('$Fname', '$name','$email',' $encrypted_pwd ')";
 
    
    $user_check_query = "SELECT * FROM user WHERE First_name='$Fname' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    $sql1 = 'First_name or Email already exists ';
    
    if ($password != $cpassword) {
      echo "<b>The two password do not match</b></br>";
      header("refresh:10 ");
  
      }
   
        if ($user['First_name'] === $Fname OR $user['email'] === $email) {
              echo "<b> ". $sql1 ."</b>" . $conn->error;
   
         }  
        else if(mysqli_query($conn, $sql))  {
     
              // Display the alert box   
              echo "<script>alert('Data saved succesfully')</script>";

         }  
 
  } else{

  echo "<h4>fill all sections of the form</h4>";
  
} 
 
} 
      function test_input($data) {
      
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      
  }
 
?>


<html lang="en">
    <head>
      <meta charset ="UTF-8">
     <meta name="viewport" content="width=device-width,initial-scale=1.0">

       <title>Document</title>
      <link rel="stylesheet" href="css.css" media="all">
        
</head>

<body>


<div class="container">
<form action="project1.php" method="POST" class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <div class="form-group">
    <label for="name" class="form-label">First Name</label>
    <input type = "text" class="form-control" id="Fname" name="Fname"  >
</div>

<div class="form-group">
    <label for="name" class="form-label">Last Name</label>
    <input type = "text" class="form-control" id="name" name="name"  >
</div>

<div class="form-group">
    <label for="email" class="form-label"> Email </label>
    <input type = "email" class="form-control" id="email" name="email">
</div>

<div class="form-group">
    <label for="subject" class="form-label">Password(min 8 characters)</label>
    <input type = "password" class="form-control" id="password" name="password">
</div>

<div class="form-group">
    <label for="subject" class="form-label">Confirm password</label>
    <input type = "password" class="form-control" id="cpassword" name="cpassword">
</div>
<input type="submit" name="submit" value="Submit" class="registerbtn">

     </form>
</div>


   </body>
</html>