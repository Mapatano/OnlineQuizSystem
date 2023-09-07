<html>  
<head>  
<title>login </title>
<h1><center>QUICK QUIZ</center></h1>  
 
<style>
body{

background-color: khaki;
}


#frm{  
width: 40%;
margin: 0px auto;
font-size: 20px;
padding: 20px;
border: 1px solid #B0C4DE;
background: white;
border-radius: 0px 0px 0px 0px;
}  
.input {
	margin: 10px 0px 10px 0px;
}


#btn{  
    
	padding: 10px;
	font-size: 20px;
	color: white;
	background: khaki;
	border: none;
	border-radius: 5px;

} 

#user{  
    position: relative;
width: 40%; 
font-size: 20px;
left:10px;
} 

#pass{  
    position: relative;
width: 40%; 
font-size: 20px;
left:-5px;
} 
</style>


</head>  
<body>  
<div id = "frm">  
<h2><center><b>USER LOGIN</b></center></h2>  


<form name="f1" action = "Authentification.php" onsubmit = "return validation()" method = "POST">  
 <p>  
<center>
<label> Email:</label>  
<input type = "text" id ="user" name  = "user" />  
</center>
</p>  
<p> 
<center> 
<label>Password:</label>  
<input type = "password" id ="pass" name  = "pass" />  
</center>
</p>  
<p>     
<center><input type =  "submit" id = "btn" value = "Login" /> </center> 
</p> 
<p>
  	Dont have an account? <a href="register.php">Sign up</a>
</p> 
</form>  

    </div>  


<script>  
function validation()  
    {  
var id=document.f1.user.value;  //document.formname.userinputname.value
var ps=document.f1.pass.value;  
            if(id.length=="" && ps.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("User Name is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
        </script>  
</body>     
</html> 