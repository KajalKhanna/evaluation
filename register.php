<?php
$errorMsg= "";
//clean($_POST); // data cleaning  --> $_POST['sub']=""
//////////validation///////////
if(isset($_POST['reg'])){

  $username=trim($_POST["username"]);
  $useremail=trim($_POST["useremail"]);
$usercontact = $_POST["usercontact"];
  if($username =="") {
    $errorMsg=  "error : You did not enter a name.";
  }
  elseif($usercontact == "") {
    $errorMsg=  "error : Please enter number.";
 
  }
  //check if the number field is numeric
  elseif(is_numeric($usercontact) == false){
    $errorMsg=  "error : Please enter numeric value.";
  }
  elseif(strlen($usercontact)<10){
    $errorMsg=  "error : Number should be ten digits.";
  
  }
  //check if email field is empty
  elseif($useremail == ""){
    $errorMsg=  "error : You did not enter a email.";
  
} //check for valid email 
elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $useremail)){
  $errorMsg= 'error : You did not enter a valid email.';
}
else{
  echo "Success";
  header('location:index1.php');
  
 
}






	//////// db connection ///////////////
	if(!$errorMsg)
	{
		$con = mysqli_connect("localhost","root","") or die("DB not connected");
		mysqli_select_db($con,"pimcore") or die("DB not found");
		$username = mysqli_real_escape_string($con,$_POST['username']);
		$pwd = mysqli_real_escape_string($con,$_POST['pwd']);
		$useremail = mysqli_real_escape_string($con,$_POST['useremail']);
		$usercontact = mysqli_real_escape_string($con,$_POST['usercontact']);

		
		$sql = "INSERT INTO user(id,username, useremail,userpwd,usercontact) VALUES (NULL,'$username', '$useremail','$pwd', '$usercontact')";
		//$sql = "select * from user where username='x' OR 'x'='x'";
		$res = mysqli_query($con,$sql);

		if(mysqli_affected_rows($con)>0){
		echo "record inserted";
		}else
		{
			echo mysqli_error($con);
			//$err_msg .= "No such user exists<br />";
		}
	}
}
	


?>
<!-- registraction form  -->
<html>
<head>
<link rel="stylesheet" href="style1.css" type="text/css" />
</head>
<body>
<div class="login">
<?php if($errorMsg) echo '<div class="error">'.$errorMsg.'</div>';?>
<form action="register.php" method="post">
<table>
	<tr>
<td>Username: </td>
<td><input type="text" name="username" placeholder="Enter your Username" required /></td>
</tr>
<tr>
<td>Email: </td>
<td><input type="email" name="useremail" placeholder="Enter your Email" required /></td>
</tr>
<tr>
<td>Password: </td>
<td><input type="password" name="pwd" placeholder="Enter your password" required /></td>
</tr>
<tr>
	<tr>
<td>Contact: </td>
<td><input type="text" name="usercontact" placeholder="Enter your contact number" minlength="10" required /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="Submit" name="reg" value="Register"/></td>
</tr>
</table>
</form>
</div>
</body>
</html>