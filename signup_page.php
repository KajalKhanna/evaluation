<?php
$errMsg= "";
if(isset($_POST['submit']))

{

if (empty($_POST["name"])) {  
    $errMsg = "Error! You didn't enter the Name.";  
             echo $errMsg; 			 
} else {  
    $name = $_POST["name"];  
 

if (!preg_match ("/^[a-zA-z]*$/", $name) ) {  
    $errMsg = "Only alphabets and whitespace are allowed in name.";  
             echo $errMsg;  
} }
if (empty($_POST["contact"])) {  
    $errMsg = "Error! You didn't enter the contact number.";  
             echo $errMsg;  
} else { 
$contact = $_POST ["contact"];
 
     
if (!preg_match ("/^[0-9]*$/", $contact) ){  
    $errMsg = "Only numeric value is allowed in contact number.";  
    echo $errMsg;  
}
if (strlen ($contact) != 10) {  
            $errMsg = "Mobile no must contain 10 digits.";  
          echo $errMsg;  }    }
if (empty($_POST["email"])) {  
    $errMsg = "Error! You didn't enter the email.";  
             echo $errMsg;  
} else { 
$email = $_POST ["email"];  
$pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
if (!preg_match ($pattern, $email) ){  
    $errMsg = "Email is not valid.";  
            echo $errMsg;  
} 
}
 $date = $_POST["date"]; 
if (time() < strtotime('+18 years', strtotime($date))) {
   echo 'Client is not under 18 years of age.';
 
}


  if (empty($_POST["gender"])) {  
            $errMsg = "Gender is required"; 
echo $errMsg;			
    } else {  
            $gender = $_POST["gender"];  
    }
	 if (($_POST['password'])!=($_POST['password_confirm'])){  
            $errMsg = "Passwords do not match";
			echo $errMsg;
	 }			
	
    if (!isset($_POST['agree'])){  
            $errMsg = "Accept terms of services before submit."; 
echo $errMsg;			
    } else {  
            $agree = $_POST["agree"];  
    }	
}



?>

<!DOCTYPE HTML>  
<html>
<head>
<title>Signup form</title>
<style>
.error {color: #FF0001;} 
font-family: 'Bradley Hand'
</style>
</head>
<body>  
<h2><i>Signup Form</i></h2>  
<span class = "error">* required field </span>  
<br><br> 
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" placeholder="Enter full name" /><span class="error" <style>* </span>
  <br><br>
  Date of Birth: <input type="date" name="date" required /><span class="error">* </span>
  <br><br>
   Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male

  <br><br>
  Contact No.: <input type="text" name="contact" placeholder="Enter contact number" required />  <span class="error">* </span>
  <br><br>
  E-mail: <input type="text" name="email" placeholder="Enter email" required />  <span class="error">* </span>
  <br><br>
 Password: <input type="password" name="password" placeholder="enter password" required />  <span class="error">* </span>
  <br><br>
  Confirm password: <input type="password" name="password_confirm" placeholder="confirm password" required  />  <span class="error">* </span>
   <br><br>
   Agree to Terms of Service:  
    <input type="checkbox" name="agree" />    <span class="error">* </span>
  <input type="submit" name="submit" value="Submit">  
</form>


</body>
</html>