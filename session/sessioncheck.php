<?php
session_start();
if(!(isset($_SESSION['useremail']) and $_SESSION['useremail'])){
	
	exit();
}
?>