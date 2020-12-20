<?php
session_start();
if(isset($_SESSION['useremail']) !=""){
	header('location:dashboard.php');
	session_destroy();
	exit();
}

$err_msg = "";
//clean($_POST); // data cleaning  --> $_POST['sub']=""
if(isset($_POST['sub']) and $_POST['sub']){
	//print_r($_POST); // display values
	///////// validating at server side //////////////
	if(isset($_POST['useremail']) and $_POST['useremail']==""){
		$err_msg = $err_msg."Username not Provided<br />";
	}
	if(isset($_POST['pwd']) and $_POST['pwd']==""){
		$err_msg = $err_msg."Password not Provided<br />";
	}
filter_var($_POST['useremail'], FILTER_VALIDATE_EMAIL);

	//////// db connection ///////////////
	if(!$err_msg){
	require_once('C:\xampp\htdocs\demo\db\db.php');
		$user = mysqli_real_escape_string($con,$_POST['useremail']);
		$pwd = mysqli_real_escape_string($con,$_POST['pwd']);
		$usertype=mysqli_real_escape_string($con,$_POST['usertype']);

		$sql = "select * from user where useremail='$user' and usertype='$usertype'";
		//$sql = "select * from user where username='x' OR 'x'='x'";
		$res = mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0){
			while($data = mysqli_fetch_assoc($res)){
				//print_r($data);
				
				
				if($data['userpwd']!=$pwd){
				
					if(!isset($_SESSION['attempt']))
					{
						$_SESSION['attempt']=0;
					}
					$_SESSION['attempt']+=1;
					if(($_SESSION['attempt'])===3)
					{
						$_SESSION['msg']="disabled";
					}
				$err_msg .= "Wrong Password<br />";
				
				}else{
					
					session_start();
					$_SESSION['useremail'] = $user;
					$_SESSION['id'] = $data['id'];
					$_SESSION['username'] = $data['username'];
					$_SESSION['username'] = $user;
					
					$_SESSION['user'] = $data;
					if($data['usertype']=="admin")
				{
			echo "you are logged in as ".$data['usertype'];
			header('location:admin.php');
				}
				
				
				else{
					echo "you are logged in as ".$data['usertype'];
			header('location:dashboard.php');
					
				}
				}
			}
		
		
			
				echo '<hr />';
		}	
			
		else{
			$err_msg .= "No such user exists<br />";
		}
		}
}	


?>
<!-- login form -->
<html>
<head>
<link rel="stylesheet" href="style1.css" type="text/css" />
</head>
<body>
<div class="login">
<?php if($err_msg) echo '<div class="error">'.$err_msg.'</div>';?>
<form action="index1.php" method="post">
<table>
<tr>
<td>Email: </td>
<td><input type="email" name="useremail" placeholder="Enter your Email" required /></td>
</tr>
<tr>
<td>Password: </td>
<td><input type="password" name="pwd" placeholder="Enter your password" required /></td>
</tr>
<tr>
<td>Select user role :<select name ="usertype">
<option value="admin">admin</option>
<option value="user">user</option>
</select></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="sub" value="Login" <?php if(isset($_SESSION['msg'])){ echo $_SESSION ['msg'];} ?> /><a href ="reset.php">Reset</a></td>
</tr>
</table>
</form>
</div>
</body>
</html>