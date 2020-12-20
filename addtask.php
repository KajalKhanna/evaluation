<?php require_once('session\sessioncheck.php');?>
<?php

$err_msg = "";
//clean($_POST); // data cleaning  --> $_POST['sub']=""
//print_r($_POST);
//print_r($_FILES['desc_file']);
if(isset($_POST['sub']) and $_POST['sub']){
	//print_r($_POST); // display values
	///////// validating at server side //////////////
	if(isset($_POST['title']) and $_POST['title']==""){
		$err_msg = $err_msg."Title not Provided<br />";
	}
	if(isset($_POST['description']) and $_POST['description']==""){
		$err_msg = $err_msg."Description not Provided<br />";
	}
	if(isset($_POST['timeline']) and $_POST['timeline']==""){
		$err_msg = $err_msg."Timeline not Provided<br />";
		
	}

	$allowedExts = array(
  "pdf", 
  "doc", 
  "docx"
); 

$allowedMimeTypes = array( 
  'application/msword',
  'application/pdf'
);

$temp = explode(".", $_FILES["desc_file"]["name"]);
$extension =end($temp);

if ( ! ( in_array($extension, $allowedExts ) ) ) {
	$err_msg = $err_msg."Please provide doc or pdf only<br />";
	echo $err_msg;



}

if ( in_array( $_FILES["desc_file"]["type"], $allowedMimeTypes ) ) 
{      
 move_uploaded_file($_FILES["desc_file"]["tmp_name"], "uploads/" . $_FILES["desc_file"]["name"]); 
}


	//////// db connection ///////////////
	if(!$err_msg){
		require_once('db/db.php');
		$title = mysqli_real_escape_string($con,$_POST['title']);
		$description = mysqli_real_escape_string($con,$_POST['description']);
		$timeline = mysqli_real_escape_string($con,$_POST['timeline']);
		$file_desc_url = 'uploads/'.$_FILES['desc_file']['name'];
		////////// file uploading part is here //////////////

	//////////// db query part /////////////////////////
		$sql = "INSERT INTO `task` (`userid`,`title`, `description`, `timeline`, `desc_file`,`status`) VALUES ('$_SESSION[id]','$title', '$description', '$timeline', '$file_desc_url','A')";
		//$sql = "select * from user where username='x' OR 'x'='x'";
		$res = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con)>0){
			echo 'Record Inserted';
		}else{
			echo 'Record Not Inserted';
		}
		
	}
	}


?>
<!-- login form -->
<?php require_once('header.php');?>
<?php require_once('navigation.php');?>
<?php require_once('sidebar1.php');?>
	<div class="content">
	
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
<table>
<tr>
<td>Title</td>
<td><input type="text" name="title" placeholder="Enter title" required /></td>
</tr>
<tr>
<td>Description </td>
<td><input type="text" name="description" placeholder="Enter your Description" required /></td>
</tr>
<tr>
<td>Timeline</td>
<td><input type="date" name="timeline" id ="input" placeholder="Enter timeline" required /></td>
</tr>
<tr>
<td>Attach File</td>
<td><input type="file" name="desc_file" placeholder="load your file" required /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="sub" value="Add Task"/></td>
</tr>
</table>
</form>
	
	</div>
<?php require_once('footer.php');?>